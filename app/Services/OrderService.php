<?php

namespace App\Services;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class OrderService{

    public function __construct(protected InventoryService $inventoryService){

    }


    public function create(array $validatedData): Order{
        return DB::transaction(function() use ($validatedData) {
            $order = Order::create([
                'customer_name' => $validatedData['customer_name'],
                'customer_email' => $validatedData['customer_email'],
                'total_amount' => 0
            ]);

            [$attachData, $total] = $this->processProducts($validatedData['products']);
            
            $order->products()->attach($attachData);

            $order->update([
                'total_amount' => $total
            ]);

            return $order;
        
        });
        
    }

    public function update(Order $order, array $validatedData): Order{
        return DB::transaction(function() use ($order, $validatedData) {

            $oldProducts = $order->products
            ->mapWithKeys(function($product) {
                return [$product->id => ['quantity' => $product->pivot->quantity]];
            })
            ->toArray();

            $order->update([
                'customer_name' => $validatedData['customer_name'],
                'customer_email' => $validatedData['customer_email'],
            ]);

            [$attachData, $total] = $this->processProducts($validatedData['products'], $oldProducts);
            
            $order->products()->sync($attachData);

            $order->update([
                'total_amount' => $total
            ]);

            return $order;
        
        });
    }

    public function processProducts(array $products, array $oldProducts = []): array{
        $total = 0;
        $attachData = [];

        foreach ($products as $item) {
            $product = Product::find($item['id']);

            if($oldProducts){
                $oldQuantity = $oldProducts[$product->id]['quantity'] ?? 0;
                $this->inventoryService->restoreProductStock($product, $oldQuantity - $item['quantity']);
            }else{
                $this->inventoryService->countProductStock($product, $item['quantity']);
            }
            
            $attachData[$product->id] = ['quantity' => $item['quantity']];
            
            $total += $product->price * $item['quantity'];
        }

        return [$attachData, $total];
    }
}