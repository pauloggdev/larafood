@extends('adminlte::page')
@section('title', 'Produtos')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}">Produtos</a></li>
</ol>
<h1>Produtos <a href="{{ route('products.create')}}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('products.search')}}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ??''}}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>flag</th>
                    <th>Preço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <img src='{{ url("storage/{$product->image}") }}' width="75px" alt="">
                    </td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->flag}}</td>
                    <td>{{number_format($product->price,'2',',','.')}}</td>
                    <td width="300px">
                        <a href="{{ route('product.categories', $product->uuid )}}" class="btn btn-warning">
                            <i class="fas fa-layer-group"></i>
                        </a>
                        <a href="{{ route('products.edit', $product->uuid )}}" class="btn btn-primary">EDIT</a>
                        <a href="{{ route('products.show', $product->uuid )}}" class="btn btn-warning">VER</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(count($filters))
        {!! $products->appends($filters)->links()!!}
        @else
        {!! $products->links() !!}
        @endif
    </div>
</div>
@stop