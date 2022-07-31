<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Filters\PostsFilter;

class PostController extends Controller
{
    public function index(Request $request): JsonResponse {
        $limit = 5;

        if ($request->page) {
            $skip = $request->page === 1 ? 0 : ($limit * $request->page) - $limit;
        }

        $posts = Post::skip($skip)->take($limit)->get();
        return response()->json($posts);
    }

    public function filter(PostsFilter $request): JsonResponse {
        return response()->json(Post::filter($request)->get());
    }

    public function search(Request $request): JsonResponse {

    }
}
