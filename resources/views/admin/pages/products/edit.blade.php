@extends('adminlte::page')
@section('title', 'Editar Produto')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index')}}">Produtos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.edit', $product->uuid)}}">Editar Produtos</a></li>
</ol>
<h1>Editar Produto</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('products.update', $product->uuid)}}" class="action" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            @include('admin.includes.alerts')

            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="title" class="form-control" value="{{ $product->title ?? old('title')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="name">Preço: </label>
                <input type="number" name="price" class="form-control" value="{{ $product->price ?? old('price')}}" placeholder="Preço: ">
            </div>
            <div class="form-group">
                <label for="name">Descrição</label>
                <textarea name="description" id="" cols="30" class="form-control" value="{{ $product->description ?? old('description')}}" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="name">Imagem</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

</div>
@stop