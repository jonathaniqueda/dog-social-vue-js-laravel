<?php

namespace App\Repositories;

use App\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function create(array $attributes)
    {
        if (!empty($attributes['profile_pic'])) {
            $extension = $attributes['profile_pic']->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image

            $res = $attributes['profile_pic']->move(storage_path('app/public/images/profile/'), $fileName);
            $attributes['profile_pic'] = 'images/profile/' . $res->getBasename();
        }

        $attributes['password'] = \Hash::make(123123);

        return parent::create($attributes);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
