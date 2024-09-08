<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index()
    {
        $order_column = request('order_column', 'created_at');
        if (! in_array($order_column, ['id', 'title', 'created_at'])) {
            $order_column = 'created_at';
        }
        $order_direction = request('order_direction', 'desc');

        return PostResource::collection(
            Post::with('category')
                ->when(request('search_category'), function (Builder $query) {
                    $query->where('category_id', request('search_category'));
                })
                ->when(request('search_id'), function (Builder $query) {
                    $query->where('id', request('search_id'));
                })
                ->when(request('search_title'), function (Builder $query) {
                    $query->where('title', 'like', '%' . request('search_title') . '%');
                })
                ->when(request('search_content'), function (Builder $query) {
                    $query->where('content', 'like', '%' . request('search_content') . '%');
                })
                ->when(request('search_global'), function (Builder $query) {
                    $query->whereAny([
                                         'id',
                                         'title',
                                         'content',
                                     ], 'LIKE', '%' . request('search_global') . '%');
                })
                ->orderBy($order_column, $order_direction)
                ->paginate(10)
        );
    }

    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->validated());
        return new PostResource($post);
    }

    public function update(PostCreateRequest $request, Post $post)
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
