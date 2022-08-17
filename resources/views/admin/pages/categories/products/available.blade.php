@extends('adminlte::page')
@section('title', "Produtos da categoria {$category->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}">Produtos</a></li>
</ol>
<h1>produtos disponivel para a categoria {{$category->name}}</h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('category.products.attach', $category->id)}}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ??''}}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <form action="{{ route('product.categories.attach', $category->id) }}" method="post">
                    @csrf
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <input type="checkbox" name="products[]" value="{{$product->uuid}}" id="">
                        </td>
                        <td>{{ $product->title}}</td>
                    </tr>

                    @endforeach
                    <tr>
                        <td colspan="500">
                            @include('admin.includes.alerts')
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(count($products))
        {!! $products->appends($filters)->links()!!}
        @else
        {!! $products->links() !!}
        @endif
    </div>
</div>
@stop