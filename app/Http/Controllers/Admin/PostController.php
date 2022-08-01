<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Filters\PostsFilter;
use App\Traits\Searchable;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use Searchable;

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
        return response()->json($this->fullSearch($request->search, ['author', 'title', 'description'], 'App\Models\Post'));
    }

    public function getPost(Request $request): JsonResponse {
        return response()->json(Post::find($request->id));
    }

    public function uploadImage(ImageRequest $request): JsonResponse {
        $name = time() . $request->file('image')->getClientOriginalName();

        $request->image->storeAs('/public', $name);
        $url = Storage::url($name);

        return response()->json(['path' => $url]);
    }

    public function updatePost(Request $request): JsonResponse {

    }

    public function savePost() {

    }
}
