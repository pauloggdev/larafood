@extends('adminlte::page')
@section('title', "Descrição do Produto" )
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index')}}">Produtos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.show', $product->uuid)}}">Descrição</a></li>
</ol>
<h1>Descrição do Produto</h1>
@stop
@section('content')

<div class="card">
    <div class="card-body">
    @include('admin.includes.alerts')

        <ul>
            <li>
                <strong>Nome:</strong> {{ $product->title }}
            </li>
            <li>
                <strong>Flag:</strong> {{ $product->flag }}
            </li>
            <li>
                <strong>Preço:</strong> {{ number_format($product->price , 2,',','.')}}
            </li>
            <li>
                <strong>Empresa:</strong> {{ $product->tenant->name }}
            </li>
            
            <li>
                <strong>Descrição:</strong> {{ $product->description }}
            </li>
            <li>
                <strong>Imagem:</strong><br>
                <img src='{{ url("storage/{$product->image}") }}' width="75px" alt="">
            </li>
        </ul>
        <form method="POST" action="{{ route('products.destroy', $product->uuid)}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>    

            DELETAR PRODUTO</button>
        </form>
    </div>
  
</div>
@stop