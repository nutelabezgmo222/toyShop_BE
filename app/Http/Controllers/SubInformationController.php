<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Country;
use App\Models\AgeLimit;
use App\Models\GenderCategory;

class SubInformationController extends Controller
{
    public function _GET_countries() {
        $items = Country::all();

        return [
            'list' => $items
        ];
    }

    public function _GET_age_limits() {
        $items = AgeLimit::all();

        return [
            'list' => $items
        ];
    }

    public function _GET_genders() {
        $items = GenderCategory::all();

        return [
            'list' => $items
        ];
    }
}
