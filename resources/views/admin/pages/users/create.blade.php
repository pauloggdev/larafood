@extends('adminlte::page')
@section('title', 'Cadastrar Novo User')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('users.index')}}">Users</a></li>
</ol>
<h1>Cadastrar Novo User</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('users.store')}}" class="action">
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
                <input type="text" name="name" class="form-control" value="{{ $user->name ?? old('name')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="name">Email: </label>
                <input type="text" name="email" class="form-control" value="{{ $user->email ?? old('email')}}" placeholder="Email: ">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>

        </form>

    </div>

</div>
@stop