<?php

namespace App\Http\Controllers;

use App\Models\CakeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CakeCategoryController extends Controller
{
    //
    public function cakeCategoryList() {
        $cakeCategoryList = CakeCategory::all();

        if (!count($cakeCategoryList) > 0) {
            return response([
                'message' => 'Cake Category List is empty!'
            ], 401);
        }

        $response = [
            'cakeCategoryList' => $cakeCategoryList
        ];

        return response($response, 201);
    }

    public function cakeCategoryDetail(Request $request) {
        $id = $request->route('id');

        if (!is_numeric($id)) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $cakeCategory = CakeCategory::find((int) $id);

        if (!$cakeCategory) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $response = [
            'cakeCategory' => $cakeCategory
        ];

        return response($response, 201);
    }

    public function createCakeCategory(Request $request) {
        $fields = $request -> validate([
            'name' => 'string',
            'description' => 'string',
        ]);

        $cakeCategory = CakeCategory::create([
            'name' => isset($fields['name']) ? $fields['name'] : '',
            'description' => isset($fields['description']) ? $fields['description'] : '',
        ]);

        $response = [
            'cakeCategory' => $cakeCategory
        ];

        return response($response, 201);
    }

    public function updateCakeCategory(Request $request) {
        $fields = $request -> validate([
            'name' => 'string',
            'description' => 'string',
        ]);

        $id = $request->route('id');

        if (!is_numeric($id)) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $cakeCategory = CakeCategory::find((int) $id);

        if (!$cakeCategory) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $newCakeCategory = CakeCategory::where('id', (int) $id) -> update([
            'name' => isset($fields['name']) ? $fields['name'] : $cakeCategory -> name,
            'description' => isset($fields['description']) ? $fields['description'] : $cakeCategory -> description,
        ]);

        $response = [
            'cakeCategoryId' => $cakeCategory -> id
        ];

        return response($response, 201);
    }
}
