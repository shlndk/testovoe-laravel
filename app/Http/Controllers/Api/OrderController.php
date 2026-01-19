<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService){

    }

    public function index(): JsonResponse{
        $orders = Order::all();

        return response()->json($orders);
    }
    public function store(OrderRequest $request): JsonResponse{
        $validatedData = $request->validated();

        return response()->json($this->orderService->create($validatedData), 201);
    }
    public function show($id): JsonResponse{
        $order = Order::findOrFail($id);
        
        return response()->json($order);
    }

    public function update(OrderRequest $request, $id): JsonResponse{
        $validatedData = $request->validated();
        $order = Order::findOrFail($id);
        
        return response()->json($this->orderService->update($order, $validatedData), 200);
    }

    public function destroy($id): JsonResponse{
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([], 204);
    }
}
