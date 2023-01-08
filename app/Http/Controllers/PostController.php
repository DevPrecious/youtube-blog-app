<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store()
    {
        return response([
            'admin' => auth()->guard('admins')->user()->email,
        ], 200);
    }
}
