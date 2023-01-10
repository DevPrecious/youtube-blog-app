<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('categories')->latest()->get();

        return response([
            'message' => 'success',
            'posts' => $posts
        ], 200);
    }


    public function store(PostRequest $postRequest)
    {
        $postRequest->validated();


        $image = $postRequest->file('image');
        $imageName = uniqid() . $image->getClientOriginalName();
        $image->move(public_path('postImages'), $imageName);

        $res = auth()->guard('admins')->user()->posts()->create([
            'title' => $postRequest->title,
            'body' => $postRequest->body,
            'image' => $imageName,
        ]);

        if ($res) {
            foreach ($postRequest->category as $cat) {
                $cat = Category::create([
                    'post_id' => $res->id,
                    'cat_name' => $cat,
                ]);
            }
        } else {
            return response([
                'message' => 'Error making post'
            ], 500);
        }

        if ($cat) {
            return response([
                'message' => 'success'
            ], 500);
        } else {
            return response([
                'message' => 'Error making post'
            ], 500);
        }
    }
}
