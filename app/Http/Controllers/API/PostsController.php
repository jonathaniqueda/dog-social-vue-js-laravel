<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Social\PostCreateRequest;
use App\Http\Requests\Social\PostUpdateRequest;
use App\Models\Post;
use App\Repositories\Social\PostRepositoryEloquent;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * @var PostRepositoryEloquent
     */
    protected $repository;

    public function __construct(PostRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['status' => 'success', 'posts' => $this->repository->getOrdered()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        return response()->json(['status' => 'success', 'post' => $this->repository->create($request->all())]);
    }

    /**
     * Show resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['status' => 'success', 'post' => $this->repository->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PostUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        return response()->json(['status' => 'success', 'post' => $this->repository->update($request->all(), $id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return response()->json(['status' => 'success']);
    }

    /**
     * Retrive the posts for logged users
     *
     * @return \Illuminate\Http\Response
     */
    public function myPosts()
    {
        return response()->json(['status' => 'success', 'posts' => $this->repository->getMyPostsOrdered()]);
    }
}
