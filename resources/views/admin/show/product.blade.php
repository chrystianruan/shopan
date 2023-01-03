@extends('layouts.navbar2')
@section('content')
<link rel="stylesheet" href="/css/admin-category.css">
<div class="container">
    <div class="wrapper">
      <div class="title"><span>Edição de Produto</span></div>
      <form action="/admin/new/product" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <i class="bx bx-image-add"></i>
          <img src="{{ url('storage/'.$product->image) }}">
        </div>

        <div class="row">
          <i class="bx bx-rename"></i>
          <input type="text" name="name" placeholder="Digite o nome do produto" required value="{{ $product->name }}">
        </div>

        <div class="row" id="div-description">
          <i class="bx bx-text" id="description"></i>
          <textarea rows="5" style="height" name="description" placeholder="Digite o nome do produto" required>{{ $product->description }} </textarea>
        </div>

        <div class="row">
          <i class="bx bxs-category"></i>
          <select name="category" required>
            <option value="" disabled>Selecionar Categoria</option>
            @foreach($categories as $category)
            <option @if($product->category_id == $category->id) selected @endif value="{{ $category -> id }}"> {{ $category -> name }}</option>
            @endforeach 
          </select>
        </div>

        <div class="row">
          <i class="bx bxs-purchase-tag"></i>
          <select name="type" required>
            <option selected value="" disabled>Selecionar tipo</option>
            @foreach($types as $type)
            <option @if($product->type_id == $type->id) selected @endif  value="{{ $type -> id }}"> {{ $type -> name }}</option>
            @endforeach 
          </select>
        </div>

        <div class="row">
          <i class="bx bx-dollar"></i>
          <input type="number" name="price" min="0" step="0.01" placeholder="Digite o valor do produto" required value="{{ number_format($product->price, 2, ",",".") }}">
        </div>

        <div class="row">
          <i class="bx bxs-package"></i>
          <input type="number" name="inventory" placeholder="Digite o estoque do produto" required value="{{ $product->inventory }}">
        </div>
       
        <div class="row button">
          <input type="submit" value="Cadastrar">
        </div>

      </form>
    </div>
  </div>
<script src="/js/admin-product.js"></script>
@endsection