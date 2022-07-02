<?php

namespace App\Http\Controllers;

use App\Models\BakeryShop;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BakeryShopController extends Controller
{
    //
    public function bakeryShopList() {
        $bakeryShopList = BakeryShop::all();

        if (!count($bakeryShopList) > 0) {
            return response([
                'message' => 'bakery Shop List is empty!'
            ], 401);
        }

        $response = [
            'bakeryShopList' => $bakeryShopList
        ];

        return response($response, 201);
    }

    public function bakeryShopDetail(Request $request) {
        $id = $request->route('id');

        if (!is_numeric($id)) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $bakeryShop = BakeryShop::find((int) $id);

        if (!$bakeryShop) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $response = [
            'bakeryShop' => $bakeryShop
        ];

        return response($response, 201);
    }

    public function createBakeryShop(Request $request) {
        $fields = $request -> validate([
            'name' => 'string',
            'thumbnail' => 'string',
            'description' => 'string',
            'phone_number' => 'string',
            'provinces_id' => 'integer',
            'districts_id' => 'integer',
            'communes_id' => 'integer',
            'villages_id' => 'integer',
        ]);

        $bakeryShop = BakeryShop::create([
            'name' => isset($fields['name']) ? $fields['name'] : '',
            'thumbnail' => isset($fields['thumbnail']) ? $fields['thumbnail'] : '',
            'description' => isset($fields['description']) ? $fields['description'] : '',
            'phone_number' => isset($fields['phone_number']) ? $fields['phone_number'] : '',
            'provinces_id' => isset($fields['provinces_id']) ? $fields['provinces_id'] : 0,
            'districts_id' => isset($fields['districts_id']) ? $fields['districts_id'] : 0,
            'communes_id' => isset($fields['communes_id']) ? $fields['communes_id'] : 0,
            'villages_id' => isset($fields['villages_id']) ? $fields['villages_id'] : 0,
        ]);

        $response = [   
            'bakeryShop' => $bakeryShop
        ];

        return response($response, 201);
    }

    public function updateBakeryShop(Request $request) {
        $fields = $request -> validate([
            'name' => 'string',
            'thumbnail' => 'string',
            'description' => 'string',
            'phone_number' => 'string',
            'provinces_id' => 'integer',
            'districts_id' => 'integer',
            'communes_id' => 'integer',
            'villages_id' => 'integer',
        ]);

        $id = $request->route('id');

        if (!is_numeric($id)) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $bakeryShop = BakeryShop::find((int) $id);

        if (!$bakeryShop) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $newBakeryShop = BakeryShop::where('id', (int) $id) -> update([
            'name' => isset($fields['name']) ? $fields['name'] : $bakeryShop -> name,
            'thumbnail' => isset($fields['thumbnail']) ? $fields['thumbnail'] : $bakeryShop -> thumbnail,
            'description' => isset($fields['description']) ? $fields['description'] : $bakeryShop -> description,
            'phone_number' => isset($fields['phone_number']) ? $fields['phone_number'] : $bakeryShop -> phone_number,
            'provinces_id' => isset($fields['provinces_id']) ? $fields['provinces_id'] : $bakeryShop -> provinces_id,
            'districts_id' => isset($fields['districts_id']) ? $fields['districts_id'] : $bakeryShop -> districts_id,
            'communes_id' => isset($fields['communes_id']) ? $fields['communes_id'] : $bakeryShop -> communes_id,
            'villages_id' => isset($fields['villages_id']) ? $fields['villages_id'] : $bakeryShop -> villages_id,
        ]);

        $response = [
            'bakeryShopId' => $bakeryShop -> id
        ];

        return response($response, 201);
    }
}
