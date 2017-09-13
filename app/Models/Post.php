<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'text',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * @param $data
     * @param Model $creator
     * @param Model|null $parent
     *
     * @return static
     */
    public function comment($data, Model $creator, Model $parent = null)
    {
        $commentableModel = Comment::class;
        $comment = (new $commentableModel())->createComment($this, $data, $creator);
        if (!empty($parent)) {
            $parent->appendNode($comment);
        }
        return $comment;
    }

    /**
     * @param $id
     * @param $data
     * @param Model|null $parent
     *
     * @return mixed
     */
    public function updateComment($id, $data, Model $parent = null)
    {
        $commentableModel = Comment::class;
        $comment = (new $commentableModel())->updateComment($id, $data);
        if (!empty($parent)) {
            $parent->appendNode($comment);
        }
        return $comment;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function deleteComment($id)
    {
        $commentableModel = Comment::class;
        return (bool)(new $commentableModel())->deleteComment($id);
    }

    /**
     * @return mixed
     */
    public function commentCount()
    {
        return $this->comments->count();
    }
}
