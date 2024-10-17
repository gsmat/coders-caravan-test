<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function user()
    {
        $user = User::find(\auth()->id());
        return response()->json([
            'data' => $user,
            "status" => true
        ]);
    }
}
