<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function _POST_login(Request $request) {
        $errors = $this->validateLogin($request);

        if($errors) {
          return response($errors, 422);
        }
        $user = User::where('email', $request['email'])->where('password', $request['password'])->first();
        
        if(!$user) {
            return response('User not found', 404);
        }
        
        $user->remember_token = Str::random(10);
        $user->save();

        return [
            'user' => $user
        ];
    }

    public function _POST_tokenLogin(Request $request) {
        if(!$request['remember_token']) {
            return response('Token is required', 422);
        }

        $user = User::where('remember_token', $request['remember_token'])->first();
        
        if(!$user) {
            return response('User not found', 404);
        }

        return [
            'user' => $user
        ];
    }

    public function _GET_logout(Request $request) {
        $token = $request->header('Authorization');
        
        if(!$token) {
            return response('Token is required', 422);
        }

        $user = User::where('remember_token', $token)->first();
        $user->remember_token = '';
        $user->save();

        return response('OK', 200);
    }

    public function _POST_registration(Request $request) {
        $errors = $this->validateRegistration($request);

        if($errors) {
          return response($errors, 422);
        }

        $newUser = User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => $request['password'],
            'phone_number' => $request['phone_number'],
            'registration_date' => date("Y-m-d H:i:s"),
            'last_log_time' => date("Y-m-d H:i:s"),
            'is_admin' => 0,
            'remember_token' => Str::random(10)
        ]);

        $newUser = $newUser->fresh();

        return [
            'user' => $newUser
        ];
    }

    public function validateRegistration(Request $request) {
        $validationRules = [
            'name' => ['required', 'max:45'],
            'surname' => ['required', 'max:45'],
            'email' => ['required', 'unique:users', 'max:45'],
            'phone_number' => ['required', 'unique:users'],
            'password' => ['required', 'min:8', 'max:45']
        ];
        
        return $this->validateRequest($request, $validationRules);
    }

    public function validateLogin(Request $request) {
        $validationRules = [
            'email' => ['required', 'exists:users'],
            'password' => ['required']
        ];
        
        return $this->validateRequest($request, $validationRules);
    }

    public function findById($id) {
        return User::where('id', '=', $id);
    }
}
