<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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

    public function filterProducts() {
        
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $types = Type::all();

        return view('/admin/edit/product', compact(['product', 'categories', 'types']));

    }

    public function update() {

    }

    public function destroy() {

    }
}
