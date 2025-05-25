<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function allOrder()
    {
        $orders = Order::with('user', 'product')->get(); // Fetch all orders from the database

        return response()->json([
            'message' => 'All orders retrieved successfully',
            'status' => 'success',
            'orders' => $orders,
        ]);
    } //end method


    function storeOrder(Request $request)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'order_number' => 'required|string|unique:orders,order_number',
            // 'status' => 'required|string|in:pending,completed,cancelled',
            'total_amount' => 'required|numeric|min:0',
            'shipping_fee' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
            'shipping_address' => 'required|string|max:255',
            'ordered_at' => 'nullable|date',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
            // Add other necessary validation rules
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => $validator->errors()
            ], 422);
        }

        // Logic to store the order

        $orders = new Order();
        $orders->user_id = $request->user_id;
        $orders->order_number = $request->order_number;
        // $orders->status = $request->status;
        $orders->total_amount = $request->total_amount;
        $orders->shipping_fee = $request->shipping_fee ?? 0; // Default to 0 if not provided
        $orders->payment_method = $request->payment_method;
        $orders->shipping_address = $request->shipping_address;
        $orders->ordered_at = $request->ordered_at ?? now(); // Default to current time if not provided
        $orders->created_at = $request->created_at ?? now(); // Default to current time if not provided
        $orders->updated_at = $request->updated_at ?? now(); // Default to current time if not provided
        //dd($orders);
        $orders->save();

        return response()->json([
            'message' => 'Order created successfully',
            // 'order' => $order, // Assuming $order is the newly created order data
        ]);
    } //end method
}
