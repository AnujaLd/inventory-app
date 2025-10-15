<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $products = [
            [
                'id' => 1,
                'name' => "Men's Pro Long Sleeve Performance Shirt in DezTek Lite",
                'image' => 'men_pro_long_sleeve.png',
                'status' => 'Draft',
                'inventory' => '0 In Stock',
                'sales_channels' => 5,
                'markets' => 2,
                'category' => 'Activewear Tops',
                'vendor' => 'Encore',
                'variants' => [],
                'last_update' => '25 AUG 25'
            ],
            [
                'id' => 2,
                'name' => "Women's Pro Long Sleeve Performance Shirt in DezTek Lite",
                'image' => 'women_pro_long_sleeve.png',
                'status' => 'Active',
                'inventory' => '73 In Stock For 5 Variants',
                'sales_channels' => 6,
                'markets' => 3,
                'category' => 'Activewear Tops',
                'vendor' => 'Encore',
                'variants' => [
                    ['color' => 'Aqua', 'stock' => 23, 'discount' => 0],
                    ['color' => 'Blue', 'stock' => 10, 'discount' => 0],
                    ['color' => 'Black', 'stock' => 10, 'discount' => 0],
                    ['color' => 'White', 'stock' => 20, 'discount' => 0],
                    ['color' => 'Green', 'stock' => 10, 'discount' => 0],
                ],
                'last_update' => '25 AUG 25'
            ],
            [
                'id' => 3,
                'name' => "Men's Short Sleeve Performance Shirt in CoolTech Fabric",
                'image' => 'men_short_sleeve.png',
                'status' => 'Active',
                'inventory' => '68 In Stock For 18 Variants',
                'sales_channels' => 7,
                'markets' => 4,
                'category' => 'Activewear Tops',
                'vendor' => 'NextGen',
                'variants' => [],
                'last_update' => '25 AUG 25'
            ],
        ];

        return view('inventory.index', compact('products'));
    }
}