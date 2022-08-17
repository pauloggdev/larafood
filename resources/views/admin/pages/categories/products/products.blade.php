@extends('adminlte::page')
@section('title', "Produtos da categoria {$category->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}">Produtos</a></li>
</ol>
<h1>Produtos da categoria {{$category->name}}
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ??''}}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td width="50px">
                        <a href="" class="btn btn-primary">EDIT</a>
                    </td>
                    <td width="50px">
                        <a href="{{ route('category.products.detach', [$category->id, $product->uuid] )}}" class="btn btn-danger">DESVINCULAR</a>
                    </td>
                </tr>
                @endforeach

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