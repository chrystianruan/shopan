<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create() {
        $categories = Category::all();
        $types = Type::all();

        return view('/admin/new/product', compact(['categories', 'types']));
    }

    public function store(Request $request) {
        
        $product = new Product;
        $product->image = $request->image->store('images-products');
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->inventory = $request->inventory;
        $product->category_id = $request->category;
        $product->type_id = $request->type;
        $product->save();

        return redirect()->back()->with('msg', 'Produto adicionado com sucesso!');
    }

    public function showViewFilterProducts() {
        $categories = Category::all();
        $types = Type::all();
        $products = Product::with(['category', 'type'])->get();

        return view('/admin/filter/product', compact(['categories', 'types', 'products']));
    }

    public function filterProducts(Request $request) {

        $categories = Category::all();
        $types = Type::all();
        $name = $request->name;
        $type = $request->type;
        $category = $request->category;
        $price = $request->price;

        $principal = Product::with(['category', 'type']);
        if ($name) {
            $principal->where('name', 'LIKE', '%'.$name.'%')
            ->orWhere('description', 'LIKE', '%'.$name.'%');
        }
        if ($category) { 
            $principal->where('category_id', $category);
        }
        if ($type) {
            $principal->where('type_id', $type);
        }  
        if ($price) {
            $principal->whereBetween('price', [0, $price]);
        }
        $products = $principal->get();
        
               /*  
        $products = Product::with(['category', 'type'])
        ->when($type, function ($query, $type) {
            $query->where('type_id', $type);
        })
        ->when($category, function ($query, $category) {
            $query->where('category_id', $category);
        }, function ($query) {
            
        })
        ->get();
        */
     

        return view('/admin/filter/product', compact(['products', 'types', 'categories']));

    }
    public function showProduct($id) {
        $product =  Product::with(['category', 'type'])->findOrFail($id);

        return view('/admin/show/product', compact(['product']));
    }

    public function editProduct($id) {
        $product =  Product::with(['category', 'type'])->findOrFail($id);
        $categories = Category::all();
        $types = Type::all();

        return view('/admin/edit/product', compact(['product', 'categories', 'types']));

    }

    public function updateProduct(Request $request) {
        $product = Product::findOrFail($request->id);

        if ($request->image == null) {
            $product->image = $product->image;
        } else {
            File::delete('storage/'.$product->image);
            $product->image = $request->image->store('images-products');
        }
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->inventory = $request->inventory;
        $product->category_id = $request->category;
        $product->type_id = $request->type;
        $product->name = $request->name;
        $product->save();

        return redirect('admin/filter/product');

    }

    public function update() {

    }

    public function destroy() {

    }
}
