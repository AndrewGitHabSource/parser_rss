<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

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
}
