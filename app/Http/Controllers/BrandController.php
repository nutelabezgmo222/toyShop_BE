<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Brand;

class BrandController extends Controller
{
    public function _GET(Request $request) {
        $brands = Brand::with('country');

        if ($request->has('subCategoryId')) {
            $brands = Brand::with(['country', 'toys.subCategories']);

            $brands->whereHas('toys.subCategories', function($q) use ($request) {
                $q->where('id', '=' , $request['subCategoryId']);
            });
        }

        return [
            'list' => $brands->get()
        ];
    }


    public function _POST(Request $request) {
        $errors = $this->validateBrand($request);

        if($errors) {
          return response($errors, 422);
        }

        return Brand::create([
            'title' => $request['title'],
            'description' => $request['description'] || '',
            'Country_id' => $request['country_id']
        ]);
    }

    public function _DELETE($id) {
        $brandToDelete = Brand::find(intval($id));

        if(!$brandToDelete) {
            return response('Item not found', 422);
        }

        return $brandToDelete->delete();
    }

    public function validateBrand(Request $request) {
        $validationRules = [
            'title' => ['required', 'unique:brands', 'max:255'],
            'country_id' => ['required', 'exists:countries,id']
        ];
        
        return $this->validateRequest($request, $validationRules);
    }
}
