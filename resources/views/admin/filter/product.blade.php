@extends('layouts.navbar2')
@section('content')
<link rel="stylesheet" href="/css/admin-filters.css">
<div class="container">

    <div class="filter">
        <form action="/admin/filter/product" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nome">
            <select name="type">
                <option selected value="" disabled>Tipo</option>
                @foreach($types as $t)
                <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
            <select name="category">
                <option selected value="" disabled>Categoria</option>
                @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            <label>Até</label>
            <input name="price" placeholder="Preço (R$)">
            <button>Filtrar</button>
            <button type="reset">Limpar</button>
        </form>
    </div>

    <table class="table-products">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr>
                <td style="text-align: center"><img width="50" src="{{ url('storage/'.$p->image)}}"></td>
                <td><a class="view" href="#"> {{ $p->name }}</a></td>
                <td style="text-align: center">R$ {{ number_format($p->price,2, ',', '.')}}</td>
                <td style="text-align: center">{{ $p->inventory }}</td>
                <td>{{ $p->type->name }}</td>
                <td>{{ $p->category->name }}</td>
                <td><a href="/admin/edit/product/{{ $p->id }}"><button class="btn-edit">editar</button></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection