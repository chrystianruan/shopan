<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PurchaseController extends Controller
{
    public function purchaseItemsAndDeleteItemsPurchasedFromCart(Request $request) {
        $products_quantity = DB::table('carts')
        ->selectRaw('products.id as product_id, products.image as product_image, products.name as product_name, products.price, carts.quantity')
        ->where('user_id', auth()->user()->id)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->get();
        $totalValueQuery = DB::table('carts')
        ->selectRaw('sum((quantity * price)) as total_value')
        ->where('user_id', auth()->user()->id)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->get();

        if ($request->payment == 1) {
            $totalValue = $totalValueQuery->sum('total_value') - ($totalValueQuery->sum('total_value') * 2/100);
        }
        elseif ($request->payment == 2) {
            $totalValue = $totalValueQuery->sum('total_value') - ($totalValueQuery->sum('total_value') * 5/100);
        } else {
            $totalValue = $totalValueQuery->sum('total_value');
        }
 

        $purchase = new Purchase;
        $purchase->user_id = auth()->user()->id;
        $purchase->products_quantity = $products_quantity;
        $purchase->total_value = $totalValue;
        $purchase->payment_id = $request->payment;
        $purchase->installments = $request->installments;
        $purchase->save();

        Cart::where('user_id', auth()->user()->id)->delete();

        return redirect('purchases')->with('msg-purchased', "Sua compra foi realizada com sucesso, aguarde 2 minutos para que seja aprovada.");
        
    }

    public function showPurchases() {
        $purchases = Purchase::select('purchases.*', 'payments.name')
        ->where('user_id', auth()->user()->id)
        ->join('payments', 'purchases.payment_id', '=', 'payments.id')
        ->orderBy('created_at', 'desc')
        ->simplePaginate(2);


        if(Auth::check()) {
            $productsOnCart = Cart::select('product_id', 'quantity')->where('user_id', auth()->user()->id)->get();
        } else {
            $productsOnCart = null;
        }

    

        return view('/purchases', compact(['purchases', 'productsOnCart']));
    }

    public function showInvoice($id) {
        $invoice = Purchase::findOrFail($id);

        	
        return \PDF::loadView('/invoice', compact('invoice'))

        ->stream('nota-fiscal.pdf');
    }
}
