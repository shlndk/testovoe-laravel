<?php

namespace App\Services;
use App\Models\Product;

class InventoryService{
    public function countProductStock(Product $product, int $quantity): void {
        if($product->stock_quantity < $quantity){
            throw new \Exception("Insufficient stock for product ID: {$product->id}");
        }

        $product->update(['stock_quantity' => $product->stock_quantity - $quantity]);
    }

    public function restoreProductStock(Product $product, int $quantity): void {
        $product->update(['stock_quantity' => $product->stock_quantity + $quantity]);
    }
}