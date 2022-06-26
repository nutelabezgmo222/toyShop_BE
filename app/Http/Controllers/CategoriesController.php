<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Category;
use App\Models\SubCategory;

class CategoriesController extends Controller
{
    public function _GET() {
        $categories = Category::with('subCategories')->get();

        return [
            'list' => $categories
        ];
    }

    public function _POST_category(Request $request) {
        $errors = $this->validateCategory($request);

        if($errors) {
          return response($errors, 422);
        }

        return Category::create([
            'title' => $request['title']
        ]);
    }

    public function _POST_subcategory(Request $request) {
        $errors = $this->validateSubCategory($request);

        if($errors) {
          return response($errors, 422);
        }

        return SubCategory::create([
            'title' => $request['title'],
            'Category_id' => $request['category_id']
        ]);
    }

    public function _DELETE_category($id) {
        $categoryToDelete = Category::find(intval($id));

        if(!$categoryToDelete) {
            return response('Item not found', 401);
        }

        return $categoryToDelete->delete();
    }

    public function _DELETE_subcategory($id) {
        $subCategoryToDelete = SubCategory::find(intval($id));

        if(!$subCategoryToDelete) {
            return response('Item not found', 401);
        }

        return $subCategoryToDelete->delete();
    }

    public function validateCategory(Request $request) {
        $validationRules = [
            'title' => ['required', 'unique:categories', 'max:45'],
        ];
        
        return $this->validateRequest($request, $validationRules);
    }

    public function validateSubCategory(Request $request) {
        $validationRules = [
            'title' => ['required', 'unique:sub_categories', 'max:45'],
            'category_id' => ['required', 'exists:categories,id']
        ];
        
        return $this->validateRequest($request, $validationRules);
    }
}
