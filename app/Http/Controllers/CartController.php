<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index()
    {
        $productsRecommended = Product::all();
        $categories = Category::all();
        $payments = Payment::all();
        if(Auth::check()) {
            $productsOnCart = DB::table('carts')
            ->selectRaw('products.*, carts.id as cart_id, carts.quantity, (quantity * price) as total_value')
            ->where('user_id', auth()->user()->id)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->get();

        } else {  
            $productsOnCart = null;
        }
        return view('/cart', compact(['productsOnCart', 'categories', 'payments', 'productsRecommended']));
    }

    public function addProductToCart(Request $request) {
        if(Auth::check()) { 
            $productCart = new Cart;
            $productCart->user_id = auth()->user()->id;
            $productCart->product_id = $request->product_id;
            $productCart->quantity = 1;
            $productCart->save();

            return redirect()->back();
        } else {
            return redirect('/login')->with('msg-permission', 'Faça login para comprar um produto');
        }
    }

    public function addProductToCartFromShowProductView(Request $request) {
        if(Auth::check()) { 
            $productCart = new Cart;
            $productCart->user_id = auth()->user()->id;
            $productCart->product_id = $request->product_id;
            $productCart->quantity = 1;
            $productCart->save();

            return redirect('/cart');
        } else {
            return redirect('/login')->with('msg-permission', 'Faça login para comprar um produto');
        }
    }

    public function changeQuantityOfProduct($id, Request $request) {
        $product = Cart::findOrFail($id);

            if(isset($request->minus)) {
                if($product -> quantity > 1) {
                    $result = --$product->quantity;
                } else {
                    return redirect()->back()->with('invalid-quantity', 'Quantidade inválida');
                }
            } else {
                $result = ++$product->quantity;
            } 

        $product -> update(['quantity' => $result]);
        return redirect()->back();

    }

    public function removeProductFromCart($id) {
        $cart = Cart::findOrFail($id);
        $cart -> delete();

        return redirect()->back();

    }



    public function removeProductFromCartWhenPurchased() {

    }
}
