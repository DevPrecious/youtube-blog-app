<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(AdminLoginRequest $adminLoginRequest)
    {
        $adminLoginRequest->validated();

        $admin = Admin::whereEmail($adminLoginRequest->email)->first();

        if (!$admin || !Hash::check($adminLoginRequest->password, $admin->password)) {
            return response([
                'message' => 'Invalid Admin Credentials'
            ], 400);
        }

        
        $token = $admin->createToken('adminLogin')->plainTextToken;

        return response([
            'message' => 'success',
            'admin' => $admin,
            'token' => $token,
        ]);
    }
}
