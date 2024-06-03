<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comments\StoreCommentRequest;
use App\Http\Requests\Api\Comments\UpdateCommentRequest;
use App\Http\Responses\Api\Comments\CommentResponse;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        $response = $comments->map(function ($comment) {
            return new CommentResponse($comment);
        });

        return $this->successResponse($response, 'Comments retrieved successfully');
    }

    /**
     * Display a listing of the resource by a specified post id.
     * 
     * @param int $postId 
     * @return \Illuminate\Http\Response
     */
    public function indexByPostId($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->get();

        $response = $comments->map(function ($comment) {
            return new CommentResponse($comment);
        });

        return $this->successResponse($response, 'Comments retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Comments\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->validated());
        $response = new CommentResponse($comment);

        return $this->successResponse($response, 'Comment created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        $response = new CommentResponse($comment);

        return $this->successResponse($response, 'Comment retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Comments\UpdateCommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->validated());

        $response = new CommentResponse($comment);

        return $this->successResponse($response, 'Comment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return $this->successResponse(null, 'Comment deleted successfully', 204);
    }

    /**
     * Remove resource from storage by a specified post id.
     *
     * @param  int  $postId
     * @return \Illuminate\Http\Response
     */
    public function destroyByPostId($postId)
    {
        $post = Post::findOrFail($postId);
        $post->comments()->delete();

        return $this->successResponse(null, 'Comments deleted successfully', 204);
    }
}
