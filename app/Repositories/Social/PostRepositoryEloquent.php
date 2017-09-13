<?php

namespace App\Repositories\Social;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Post;

/**
 * Class PostRepositoryEloquent
 * @package namespace App\Repositories\Social;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    public function getOrdered()
    {
        $res = $this->orderBy('created_at', 'DESC')->all();

        $returned = [];
        foreach ($res as $post) {
            $returned[] = [
                'id' => $post->id,
                'fullname' => $post->user->name,
                'text' => $post->text,
                'postDate' => $post->created_at->toDatetimeString(),
                'image' => 'storage/' . $post->photo,
            ];
        }

        return $returned;
    }

    public function getMyPostsOrdered()
    {
        $user = \JWTAuth::parseToken()->authenticate();

        $res = $this->orderBy('created_at', 'DESC')
            ->findWhere([
                'user_id' => $user->id
            ])->all();

        $returned = [];
        foreach ($res as $post) {
            $returned[] = [
                'id' => $post->id,
                'fullname' => $post->user->name,
                'text' => $post->text,
                'postDate' => $post->created_at->toDatetimeString(),
                'image' => 'storage/' . $post->photo,
            ];
        }

        return $returned;
    }

    public function create(array $attributes)
    {
        if (!empty($attributes['photo'])) {
            $extension = $attributes['photo']->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image

            $res = $attributes['photo']->move(storage_path('app/public/images/post/'), $fileName);
            $attributes['photo'] = 'images/post/' . $res->getBasename();
        }

        $res = parent::create($attributes);

        return [
            'id' => $res->id,
            'fullname' => $res->user->name,
            'text' => $res->text,
            'postDate' => $res->created_at->toDatetimeString(),
            'image' => 'storage/' . $res->photo,
        ];
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
