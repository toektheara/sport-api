<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CakeController extends Controller
{
    //
    public function cakeList(Request $request) {
        $fields = $request -> validate([
            'bakery_shop_id' => 'integer',
            'cake_category_id' => 'integer',
        ]);

        $cakeList;

        if (isset($fields['bakery_shop_id']) && isset($fields['cake_category_id'])) {
            $cakeList = Cake::where([
                ['bakery_shop_id', '=', $fields['bakery_shop_id']],
                ['cake_category_id', '=',$fields['cake_category_id']]
            ]);
        }
        else if (isset($fields['bakery_shop_ids'])) {
            $cakeList = Cake::where([
                ['bakery_shop_id', '=', $fields['bakery_shop_id']],
            ]);
        }
        else if (isset($fields['cake_category_id'])) {
            $cakeList = Cake::where([
                ['cake_category_id', '=',$fields['cake_category_id']]
            ]);
        } 
        else {
            $cakeList = Cake::all();
        }

        if (!count($cakeList) > 0) {
            return response([
                'message' => 'Cake List is empty!'
            ], 401);
        }

        $response = [
            'cakeList' => $cakeList
        ];

        return response($response, 201);
    }

    public function cakeDetail(Request $request) {
        $id = $request->route('id');

        if (!is_numeric($id)) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $cake = Cake::find((int) $id);

        if (!$cake) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $response = [
            'cake' => $cake
        ];

        return response($response, 201);
    }

    public function createCake(Request $request) {
        $fields = $request -> validate([
            'name' => 'string',
            'thumbnail' => 'string',
            'description' => 'string',
            'price' => 'integer',
            'bakery_shop_id' => 'integer',
            'cake_category_id' => 'integer',
        ]);

        $cake = Cake::create([
            'name' => isset($fields['name']) ? $fields['name'] : '',
            'thumbnail' => isset($fields['thumbnail']) ? $fields['thumbnail'] : '',
            'description' => isset($fields['description']) ? $fields['description'] : '',
            'price' => isset($fields['price']) ? $fields['price'] : '',
            'bakery_shop_id' => isset($fields['bakery_shop_id']) ? $fields['bakery_shop_id'] : 0,
            'cake_category_id' => isset($fields['cake_category_id']) ? $fields['cake_category_id'] : 0,
        ]);

        $response = [
            'cake' => $cake
        ];

        return response($response, 201);
    }

    public function updateCake(Request $request) {
        $fields = $request -> validate([
            'name' => 'string',
            'thumbnail' => 'string',
            'description' => 'string',
            'price' => 'integer',
            'bakery_shop_id' => 'integer',
            'cake_category_id' => 'integer',
        ]);

        $id = $request->route('id');

        if (!is_numeric($id)) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $cake = Cake::find((int) $id);

        if (!$cake) {
            return response([
                'message' => 'Invalid Item!'
            ], 401);
        }

        $newCake = Cake::where('id', (int) $id) -> update([
            'name' => isset($fields['name']) ? $fields['name'] : $cake -> name,
            'thumbnail' => isset($fields['thumbnail']) ? $fields['thumbnail'] : $cake -> thumbnail,
            'description' => isset($fields['description']) ? $fields['description'] : $cake -> description,
            'price' => isset($fields['price']) ? $fields['price'] : $cake -> price,
            'bakery_shop_id' => isset($fields['bakery_shop_id']) ? $fields['bakery_shop_id'] : $cake -> bakery_shop_id,
            'cake_category_id' => isset($fields['cake_category_id']) ? $fields['cake_category_id'] : $cake -> cake_category_id,
        ]);

        $response = [
            'cakeId' => $cake -> id
        ];

        return response($response, 201);
    }
}
