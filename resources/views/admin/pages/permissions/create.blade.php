@extends('adminlte::page')
@section('title', 'Cadastrar permissões')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('permissions.index')}}">Permissão</a></li>
</ol>
<h1>Cadastrar Permissão</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('permissions.store')}}" class="action">
            @csrf

            @include('admin.includes.alerts')
         
            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="name" class="form-control" value="{{ $permission->name ?? old('name')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="description">Descrição: </label>
                <input type="text" name="description" class="form-control" value="{{ $permission->description ?? old('description')}}" placeholder="Descrição: ">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>

        </form>

    </div>

</div>
@stop