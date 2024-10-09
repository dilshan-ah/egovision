<?php

namespace App\Http\Controllers\EgoAdmin;

use App\Http\Controllers\Controller;
use App\Models\EgoModels\OrderItems;
use App\Models\ReturnProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReturnProductController extends Controller
{
    public function makeReturn(Request $request)
    {
        foreach ($request->items as $itemData) {
            $itemId = $itemData['item'] ?? null;
            $quantity = $itemData['quantity'] ?? null;

            $orderItem = OrderItems::where('id', $itemId)->first();

            if ($orderItem) {
                $orderItem->return_quantity = $quantity;
                $orderItem->save();

                $returnId = Str::random(6);

                $returnProduct = new ReturnProduct();
                $returnProduct->return_id = $returnId;
                $returnProduct->order_item_id = $itemId;
                $returnProduct->quantity = $quantity;
                $returnProduct->reason = $request->reason;
                $returnProduct->user_id = Auth::user()->id;

                $returnProduct->save();
            }
        }

        return redirect()->back();
    }


    public function showReturns()
    {
        $pageTitle = "Returend Products";
        $returnProducts = ReturnProduct::where('user_id', Auth::user()->id)->get();

        return view('user.returned_products', compact('returnProducts', 'pageTitle'));
    }

    public function index()
    {
        $returns = ReturnProduct::orderBy('created_at', 'desc')->get();
        $pageTitle = "All Returned Products";

        return view('admin.returnProducts.index', compact('returns', 'pageTitle'));
    }

    public function changeStatus($id, Request $request)
    {
        try {
            $returnProduct = ReturnProduct::where('id', $id)->first();
    
            if (!$returnProduct) {
                return response()->json(['error' => 'Return product not found.'], 404);
            }
    
            // Update the status
            $returnProduct->status = $request->status;
            $returnProduct->save();
    
            return response()->json(['message' => 'Status updated successfully!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred: ' . $th->getMessage()], 500);
        }
    }
    
}
