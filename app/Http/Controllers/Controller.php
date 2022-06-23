<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function validateRequest($request, $rules) {
        try {
            $request->validate($rules);
        } catch (ValidationException $e){
            return [
                'response' => $e->errors(),
                'status' => $e->status,
                'errorBag' => $e->errorBag,
            ];
        }

        return false;
    }
}
