<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GeneralController extends Controller
{
    public function indexLoginView() {
        return view('/login');
    }

    public function indexRegisterView() {
        return view('/register');
    }

    public function indexWelcomeViewAndDeleteProductsWhenTimeExpiredFromCart(Request $request) {
          //delete all products on cart, when time to added > 48h (172800s)
          if(Auth::check()) {
            $productsOnCartCreatedAt = Cart::select('id', 'created_at')
            ->where('user_id', auth()->user()->id)
            ->get();
                
            foreach($productsOnCartCreatedAt as $ponccat) {
                $current = strtotime(Carbon::now());
                if($current - strtotime($ponccat->created_at) >= 172800) {
                
                    $ponccat = Cart::findOrFail($ponccat -> id);
                    $ponccat->delete();

                }

            }
        }

            $products = Product::with(['category', 'type'])
            ->where('type_id', 2)
            ->get();



        if(Auth::check()) {
            $productsOnCart = Cart::select('product_id', 'quantity')->where('user_id', auth()->user()->id)->get();
        } else {
            $productsOnCart = null;
        }
        
        $categories = Category::all();
        $types = Type::all();

        return view('/welcome', compact(['products', 'productsOnCart', 'types', 'categories']));
    }

    public function selectProductsByCategory($id) {
        $categoryName = Category::findOrFail($id);
        $products = Product::with(['category', 'type'])
        ->where('category_id', $id)
        ->get();

        if(Auth::check()) {
            $productsOnCart = Cart::select('product_id', 'quantity')->where('user_id', auth()->user()->id)->get();
        } else {
            $productsOnCart = null;
        }

        return view('/category', compact('products', 'productsOnCart', 'categoryName'));
    }


    public function filterProductsInCategory(Request $request) {


    }

    public function searchProducts(Request $request) {
        $products = Product::where('name', 'LIKE', '%'.$request->search.'%')
        ->orWhere('description', 'LIKE', '%'.$request->search.'%')
        ->get();

        if(Auth::check()) {
            $productsOnCart = Cart::select('product_id', 'quantity')->where('user_id', auth()->user()->id)->get();
        } else {
            $productsOnCart = null;
        }

        $search = $request->search;

        return view('/search', compact(['products', 'search', 'productsOnCart']));
    }

    public function showProduct($id) {
        $product = Product::findOrFail($id);

        if(Auth::check()) {
            $productsOnCart = Cart::select('product_id', 'quantity')->where('user_id', auth()->user()->id)->get();
        } else {
            $productsOnCart = null;
        }

        return view('/product', compact(['product', 'productsOnCart']));
    }






}
