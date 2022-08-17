@extends('adminlte::page')
@section('title', "Categorias do produto {$product->title}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('categories.index')}}">Categories</a></li>
</ol>
<h1>Categorias do produto {{$product->title}} <a href="{{ route('product.categories.available', $product->uuid) }}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD NOVA CATEGORIA</a></h1>
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
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td width="50px">
                        <a href="" class="btn btn-primary">EDIT</a>
                    </td>
                    <td width="50px">
                        <a href="{{ route('product.categories.detach', [$product->uuid, $category->id] )}}" class="btn btn-danger">DESVINCULAR</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(count($categories))
        {!! $categories->appends($filters)->links()!!}
        @else
        {!! $categories->links() !!}
        @endif
    </div>
</div>
@stop