<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function _GET(Request $request) {
        $users = User::all();

        return [
            'list' => $users
        ];
    }
}
