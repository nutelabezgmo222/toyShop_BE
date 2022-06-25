<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;

class ToyApiController extends Controller
{
    public function _GET() {
        $toys = Toy::with(['genderCategory', 'brand.country', 'ageLimit', 'subCategories'])->get();

        return [
            'list' => $toys
        ];
    }


    public function _POST(Request $request) {
      $errors = $this->validateToy($request, $validationRules);

      if($errors) {
         return response($errors, 422);
      }

      return Toy::create([
          'title' => $request['title'],
          'description' => $request['description'] || '',
          'price' => $request['price'] || 0,
          'image' => $request['image'] || '',
          'Brand_id' => $request['brand_id'],
          'Gender_id' => $request['gender_id'],
          'AgeLimit_id' => $request['age_limit_id']
      ]);
    }

    public function _PATCH($id, Request $request) {
        $errors = $this->validateToy($request);

        if($errors) {
            return response($errors, 422);
        }

        $toyToPatch = Toy::find(intval($id));

        if(!$toyToPatch) {
            return response('Item not found', 422);
        }
        $requestData = $request->all();

        $toyToPatch->fill($requestData)->save();

        return $toyToPatch;
    }

    public function _DELETE($id) {
        $toyToDelete = Toy::find(intval($id));

        if(!$toyToPatch) {
            return response('Item not found', 422);
        }

        return $toyToDelete->delete();
    }

    public function validateToy(Request $request) {
        $validationRules = [
            'title' => ['required', 'unique:toys', 'max:255'],
        ];
        
        return $this->validateRequest($request, $validationRules);
    }
}
