<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class ToyApiController extends Controller
{
    public function index() {
        return [
            'list' => Toy::all()
        ];
    }


    public function _POST(Request $request) {
      $validationRules = [
          'title' => ['required', 'unique:toys', 'max:255'],
      ];
      $errors = $this->validateRequest($request, $validationRules);

      if($errors) {
         return response($errors, 422);
      }

      return Toy::create([
          'title' => $request['title'],
          'description' => $request['description'] || '',
          'price' => $request['price'] || 0,
          'image' => $request['image'] || ''
      ]);
    }
}
