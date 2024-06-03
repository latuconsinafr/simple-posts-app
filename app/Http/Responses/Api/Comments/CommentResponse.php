<?php

namespace App\Http\Responses\Api\Comments;

use App\Models\Comment;

class CommentResponse
{
    /**
     * The id for the comment.
     *
     * @var int
     */
    public $id;

    /**
     * The content for the comment.
     *
     * @var string
     */
    public $content;

    /**
     * The post id for the comment.
     *
     * @var string
     */
    public $post_id;

    /**
     * The created_at for the comment.
     *
     * @var DateTime
     */
    public $created_at;

    /**
     * The updated_at for the comment.
     *
     * @var DateTime
     */
    public $updated_at;

    /**
     * Comment response DTO instance.
     *
     * @param Comment $comment The comment.
     */
    public function __construct(Comment $comment)
    {
        $this->id = $comment['id'];
        $this->content = $comment['content'];
        $this->post_id = $comment['post_id'];
        $this->created_at = $comment['created_at'];
        $this->updated_at = $comment['updated_at'];
    }
}
