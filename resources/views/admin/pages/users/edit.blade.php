@extends('adminlte::page')
@section('title', 'Editar User')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index')}}">Users</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('users.edit', $user->uuid)}}">Editar User</a></li>
</ol>
<h1>Editar User</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('users.update', $user->uuid)}}" class="action">
            @csrf
            @method('PUT')
            @include('admin.includes.alerts')

            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="name" class="form-control" value="{{ $user->name ?? old('name')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="name">E-mail: </label>
                <input type="text" name="email" class="form-control" value="{{ $user->email ?? old('email')}}" placeholder="Email: ">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

</div>
@stop