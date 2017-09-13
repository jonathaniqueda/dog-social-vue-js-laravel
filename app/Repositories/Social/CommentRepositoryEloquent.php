<?php

namespace App\Repositories\Social;

use App\Models\Post;
use App\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Comment;

/**
 * Class CommentRepositoryEloquent
 * @package namespace App\Repositories\Social;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    public function findByPost($postId)
    {
        $post = Post::find($postId);
        return $post->comments()->with('creator', 'children', 'children.creator')->whereNull('parent_id')->get();
    }

    public function create(array $attributes)
    {
        if (empty($attributes['comment_parent'])) {
            $post = Post::find($attributes['post_id']);
            $user = User::find($attributes['user_id']);

            $post->comment([
                'body' => $attributes['body'],
            ], $user);
        } else {
            $post = Post::find($attributes['post_id']);
            $user = User::find($attributes['user_id']);
            $parent = $this->find($attributes['comment_parent']);

            $post->comment([
                'body' => $attributes['body'],
            ], $user, $parent);
        }

        return $post->comments()->with('creator', 'children', 'children.creator')->whereNull('parent_id')->get();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
