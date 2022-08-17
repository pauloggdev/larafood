@extends('adminlte::page')
@section('title', 'Editar Categórias')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index')}}">Categórias</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('categories.edit', $category->url)}}">Editar Categória</a></li>
</ol>
<h1>Editar Categória</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('categories.update', $category->url)}}" class="action">
            @csrf
            @method('PUT')
            @include('admin.includes.alerts')

            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="name" class="form-control" value="{{ $category->name ?? old('name')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="name">Descrição: </label>
                <textarea name="description" id="" cols="30" class="form-control" placeholder="Descrição" rows="10">{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

</div>
@stop