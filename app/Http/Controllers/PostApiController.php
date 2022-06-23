<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PostApiController extends Controller
{
    public function index() {
        return [
            'posts' => Post::all()
        ];
    }

    public function createPost(Request $request) {
        try {
            $request->validate([
                'title' => ['required', 'unique:posts', 'max:255'],
                'content' => ['required'],
            ]);
        } catch (ValidationException $e){
            return response([
                'response' => $e->errors(),
                'status' => $e->status,
                'errorBag' => $e->errorBag,
            ], 422);
        }

        return Post::create([
            'title' => $request['title'],
            'content' => $request['content']
        ]);
    }
}


