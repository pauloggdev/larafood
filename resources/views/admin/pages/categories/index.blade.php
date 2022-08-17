@extends('adminlte::page')
@section('title', 'Categórias')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('categories.index')}}">Categórias</a></li>
</ol>
<h1>Categórias <a href="{{ route('categories.create')}}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('categories.search')}}" method="post" class="form form-inline">
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
                    <th>Url</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->url}}</td>
                    <td>{{$category->description}}</td>
                    <td width="300px">
                        <a href="{{ route('category.products', $category->id )}}" class="btn btn-warning">
                            <i class="fas fa-layer-group"></i>
                        </a>
                        <a href="{{ route('categories.edit', $category->url )}}" class="btn btn-primary">EDIT</a>
                        <a href="{{ route('categories.show', $category->url )}}" class="btn btn-warning">VER</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(count($filters))
        {!! $categories->appends($filters)->links()!!}
        @else
        {!! $categories->links() !!}
        @endif
    </div>
</div>
@stop