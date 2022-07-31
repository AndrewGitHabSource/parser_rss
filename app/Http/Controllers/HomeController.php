<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(): JsonResponse {
        return response()->json(Post::all());
    }
}
