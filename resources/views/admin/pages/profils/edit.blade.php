@extends('adminlte::page')
@section('title', 'Editar Perfil')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('profils.index')}}">Perfil</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profils.edit', $perfil->id)}}">Editar perfil</a></li>
</ol>
<h1>Editar Perfil</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('profils.update', $perfil->id)}}" class="action">
            @csrf
            @method('PUT')
            @include('admin.includes.alerts')

            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="name" class="form-control" value="{{ $perfil->name ?? old('name')}}" placeholder="Nome: ">
            </div>

            <div class="form-group">
                <label for="description">Descrição: </label>
                <input type="text" name="description" class="form-control" value="{{ $perfil->description ?? old('description')}}" placeholder="Descrição: ">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

</div>
@stop