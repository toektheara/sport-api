<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\BakeryShop;
use App\Models\CakeCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function dashboardTotal() {
        $cakeCategoryList = CakeCategory::all();
        $cakeList = Cake::all();
        $bakeryShopList = BakeryShop::all();

        $response = [
            'totalCakeCategory' => count($cakeCategoryList),
            'totalCake' => count($cakeList),
            'totalBakeryShop' => count($bakeryShopList)
        ];

        return response($response, 201);
    }
}
