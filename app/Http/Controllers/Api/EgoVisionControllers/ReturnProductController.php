<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\OrderItems;
use App\Models\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ReturnProductController extends Controller
{
    public function myReturns($userId)
    {
        try {
            // Fetch the paginated results
            $returnedProducts = ReturnProduct::where('user_id', $userId)
                ->select('id', 'return_id', 'order_item_id', 'quantity', 'status', 'created_at')
                ->with('item.product:id,name,price') // Include product name and price
                ->orderBy('created_at', 'asc')
                ->paginate(5);

            // Transform the paginated results
            $customizedResults = $returnedProducts->getCollection()->map(function ($returnProduct) {
                return [
                    'id' => $returnProduct->id,
                    'return_id' => $returnProduct->return_id,
                    'order_item_id' => $returnProduct->order_item_id,
                    'quantity' => $returnProduct->quantity,
                    'status' => $returnProduct->status,
                    'created_at' => $returnProduct->created_at,
                    'product_name' => $returnProduct->item->product->name ?? null,
                    'return_price' => $returnProduct->item->product->price * $returnProduct->quantity ?? null,
                ];
            });

            $returnedProducts->setCollection($customizedResults);

            if ($returnedProducts->count() == 0) {
                return response()->json([
                    'error' => true,
                    'message' => 'No Return records found'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Returned products retrieved successfully.',
                'orders' => $returnedProducts->items(),
                'current_page' => $returnedProducts->currentPage(),
                'last_page' => $returnedProducts->lastPage(),
                'total' => $returnedProducts->total(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function makeReturn(Request $request)
    {
        try {
            $returnProducts = []; // To hold all return products
    
            foreach ($request->items as $itemData) {
                $itemId = $itemData['item'];
                $quantity = $itemData['quantity'];
    
                // Fetch the order item
                $orderItem = OrderItems::find($itemId);
    
                // Check if the order item exists
                if (!$orderItem) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No Product Found',
                    ], 404); // HTTP 404 Not Found
                }
    
                // Check if the product has already been returned
                $existingReturn = ReturnProduct::where('order_item_id', $itemId)->first();
    
                if ($existingReturn) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Product Already Returned',
                    ], 200); // HTTP 200 OK
                }
    
                // Update return quantity and save the return product
                $orderItem->return_quantity = $quantity;
                $orderItem->save();
    
                $returnId = Str::random(6);
                $returnProduct = new ReturnProduct();
                $returnProduct->return_id = $returnId;
                $returnProduct->order_item_id = $itemId;
                $returnProduct->quantity = $quantity;
                $returnProduct->reason = $request->reason;
                $returnProduct->user_id = $request->userID; // Changed to match JSON key
                $returnProduct->status = 'requested';
    
                $returnProduct->save(); // Save the return product
                $returnProducts[] = $returnProduct; // Add to the list of return products
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Return processed successfully.',
                'data' => $returnProducts // Return all processed return products
            ], 201); // HTTP 201 Created
    
        } catch (\Exception $e) {
            Log::error('Error processing return: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the return.',
                'error' => $e->getMessage(),
            ], 500); // HTTP 500 Internal Server Error
        }
    }
    
}
