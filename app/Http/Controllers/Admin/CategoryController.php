<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create() {
        return view('/admin/new/category');
    }

    public function store(Request $request) {
        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('msg', 'Categoria adicionada com sucesso!');
    }

    public function filter() {
        $categories = Category::all();
    }

}
