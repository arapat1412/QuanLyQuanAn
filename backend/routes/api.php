<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    $user = User::where('u_username', $username)->first();

    // kiểm tra password đã mã hóa bằng bcrypt
    if ($user && Hash::check($password, $user->u_pass)) {
        return response()->json([
            'result' => 1,
            'user' => [
                'u_id' => $user->u_id,
                'u_username' => $user->u_username,
                'u_name' => $user->u_name,
                'u_role' => $user->u_role,
            ]
        ]);
    } else {
        return response()->json(['result' => 0]);
    }
});

