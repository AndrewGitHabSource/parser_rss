<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Filters\PostsFilter;
use App\Traits\Searchable;
use App\Http\Requests\ImageRequest;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use Searchable;

    public function index(Request $request): JsonResponse {
        $limit = 5;

        if ($request->page) {
            $skip = $request->page === 1 ? 0 : ($limit * $request->page) - $limit;
        }

        $order = $request->sort ?? "DESC";

        $posts = Post::skip($skip)->take($limit)->orderBy('title', $order)->get();
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

    public function updatePost(PostRequest $request): void {
        $post = $request->except(['id', 'image']);

        Post::where('id', '=', $request->id)->update($post);
    }

    public function uploadImage(ImageRequest $request): JsonResponse {
        $filename = time() . $request->file('image')->getClientOriginalName();
        Storage::disk('public')->put($filename, file_get_contents($request->image));

        Post::where('id', '=', $request->id)->update([
            'image' => asset('storage/' . $filename),
        ]);

        return response()->json(['path' => storage_path($filename)]);
    }

    public function savePost(PostRequest $request): void {
        if ($request->file('image')){
            $filename = time() . $request->file('image')->getClientOriginalName();
            Storage::disk('public')->put($filename, file_get_contents($request->file('image')));
        } else {
            $filename = '';
        }

        Post::Create([
            'title' => $request->title,
            'description' => $request->description,
            'author' => $request->author,
            'image' => $filename,
            'link' => $request->link
        ]);
    }

}
