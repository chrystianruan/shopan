@extends('layouts.navbar2')
@section('content')

<link rel="stylesheet" href="/css/admin-category.css">
<div class="container">
    <div class="wrapper">
      <div class="title"><span>Novo Produto</span></div>
      <form action="/admin/new/product" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <i class="bx bx-image-add"></i>
          <input type="file" name="image"  required>
        </div>

        <div class="row">
          <i class="bx bx-rename"></i>
          <input type="text" name="name" placeholder="Digite o nome do produto" required>
        </div>

        <div class="row" id="div-description">
          <i class="bx bx-text" id="description"></i>
          <textarea rows="5" style="height" name="description" placeholder="Digite o nome do produto" required> </textarea>
        </div>

        <div class="row">
          <i class="bx bxs-category"></i>
          <select name="category" required>
            <option selected value="" disabled>Selecionar Categoria</option>
            @foreach($categories as $category)
            <option value="{{ $category -> id }}"> {{ $category -> name }}</option>
            @endforeach 
          </select>
        </div>

        <div class="row">
          <i class="bx bxs-purchase-tag"></i>
          <select name="type" required>
            <option selected value="" disabled>Selecionar tipo</option>
            @foreach($types as $type)
            <option value="{{ $type -> id }}"> {{ $type -> name }}</option>
            @endforeach 
          </select>
        </div>

        <div class="row">
          <i class="bx bx-dollar"></i>
          <input type="number" name="price" min="0" step="0.01" placeholder="Digite o valor do produto" required>
        </div>

        <div class="row">
          <i class="bx bxs-package"></i>
          <input type="number" name="inventory" placeholder="Digite o estoque do produto" required>
        </div>
       
        <div class="row button">
          <input type="submit" value="Cadastrar">
        </div>

      </form>
    </div>
  </div>
<script src="/js/admin-product.js"></script>
@endsection