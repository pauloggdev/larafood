@extends('adminlte::page')
@section('title', 'Cadastrar Nova categoria')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('categories.index')}}">Categórias</a></li>
</ol>
<h1>Cadastrar Nova categoria</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('categories.store')}}" class="action">
            @csrf

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="name" class="form-control" value="{{ $category->name ?? old('name')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="name">Descrição</label>
                <textarea name="description" id="" cols="30" class="form-control" value="{{ $category->description ?? old('description')}}" rows="10"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>

        </form>

    </div>

</div>
@stop