@extends('layouts.navbar2')
@section('content')
<link rel="stylesheet" href="/css/admin-category.css">
<div class="container">
    <div class="wrapper">
      <div class="title"><span>Nova Categoria</span></div>
      <form action="/admin/new/category" method="POST">
        @csrf
        <div class="row">
          <i class="bx bxs-category"></i>
          <input type="text" name="name" placeholder="Digite o nome da categoria" required>
        </div>
       
        <div class="row button">
          <input type="submit" value="Cadastrar">
        </div>

      </form>
    </div>
  </div>
@endsection