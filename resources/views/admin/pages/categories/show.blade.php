@extends('adminlte::page')
@section('title', "Descrição da categória" )
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index')}}">Categorias</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('categories.show', $category->url)}}">Descrição</a></li>
</ol>
<h1>Descrição da categória</h1>
@stop
@section('content')

<div class="card">
    <div class="card-body">
    @include('admin.includes.alerts')

        <ul>
            <li>
                <strong>Nome:</strong> {{ $category->name }}
            </li>
            <li>
                <strong>Url:</strong> {{ $category->url }}
            </li>
            <li>
                <strong>Empresa:</strong> {{ $category->tenant->name }}
            </li>
            <li>
                <strong>Descrição:</strong> {{ $category->description }}
            </li>
        </ul>
        <form method="POST" action="{{ route('categories.destroy', $category->url)}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>    

            DELETAR CATEGÓRIA</button>
        </form>
    </div>
  
</div>
@stop