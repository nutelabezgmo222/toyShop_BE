<?php

namespace App\Http\Controllers;

use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class ToyApiController extends Controller
{
    public function _GET(Request $request) {
        $toys = Toy::with(['genderCategory', 'brand.country', 'ageLimit', 'subCategories']);

        if ($request->has('subCategoryId')) {
            $toys->whereHas('subCategories', function($q) use ($request) {
                $q->where('id', '=' , $request['subCategoryId']);
            });
        }

        return [
            'list' => $toys->orderByDesc('rating')->get()
        ];
    }


    public function _POST(Request $request) {
        $errors = $this->validateToy($request);

        if($errors) {
          return response($errors, 422);
        }
        $description = '';
        $image = '';

        if($request['description']) {
            $description = $request['description'];
        }
        if($request['image']) {
            $image = $request['image'];
        }

        $newToy = Toy::create([
            'title' => $request['title'],
            'description' => $description,
            'price' => $request['price'],
            'rating' => 0,
            'number' => $request['number'],
            'image' => $image,
            'Brand_id' => $request['brand_id'],
            'GenderCategory_id' => $request['gender_id'],
            'AgeLimit_id' => $request['age_limit_id']
        ]);

        return $this->findWith($newToy->id);
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

    public function findWith($id) {
        return Toy::with(['genderCategory', 'brand.country', 'ageLimit', 'subCategories'])->find($id);
    }
}
