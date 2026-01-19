<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller{

    public function index(){
        $product = Product::all();

        return response()->json($product);
    }
    public function store(ProductRequest $request){
        $validatedData = $request->validated();
        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }
    public function show($id){
        $product = Product::findOrFail($id);

        return response()->json($product);
    }
    public function update(ProductRequest $request, $id){
        $validatedData = $request->validated();
        $product = Product::findOrFail($id);
        $product->update($validatedData);

        return response()->json($product);
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([], 204);
    }
}