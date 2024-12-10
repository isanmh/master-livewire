<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsApiController extends Controller
{
    public function index()
    {
        // $products = Product::latest()->paginate(5);
        // $products->load('category');

        $products = Product::with('category')->paginate(5);
        return response()->json(
            $products,
            Response::HTTP_OK
        );
    }
}
