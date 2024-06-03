<?php

namespace App\Http\Responses\Api\Posts;

use App\Models\Post;

class PostResponse
{
    /**
     * The id for the post.
     *
     * @var int
     */
    public $id;

    /**
     * The title for the post.
     *
     * @var string
     */
    public $title;

    /**
     * The content for the post.
     *
     * @var string
     */
    public $content;

    /**
     * The created_at for the post.
     *
     * @var DateTime
     */
    public $created_at;

    /**
     * The updated_at for the post.
     *
     * @var DateTime
     */
    public $updated_at;

    /**
     * Post response DTO instance.
     *
     * @param Post $post The post.
     */
    public function __construct(Post $post)
    {
        $this->id = $post['id'];
        $this->title = $post['title'];
        $this->content = $post['content'];
        $this->created_at = $post['created_at'];
        $this->updated_at = $post['updated_at'];
    }
}
