<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Social\CommentCreateRequest;
use App\Http\Requests\Social\CommentUpdateRequest;
use App\Repositories\Social\CommentRepositoryEloquent;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * @var CommentRepositoryEloquent
     */
    protected $repository;

    public function __construct(CommentRepositoryEloquent $repository)
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
        return response()->json(['status' => 'success', 'comments' => $this->repository->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CommentCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentCreateRequest $request)
    {
        return response()->json(['status' => 'success', 'comments' => $this->repository->create($request->all())]);
    }

    /**
     * Show resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['status' => 'success', 'comments' => $this->repository->findByPost($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CommentUpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, $id)
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
}
