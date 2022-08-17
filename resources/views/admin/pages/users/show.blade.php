@extends('adminlte::page')
@section('title', "Descrição do User" )
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index')}}">Users</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('users.show', $user->uuid)}}">Descrição</a></li>
</ol>
<h1>Descrição do User</h1>
@stop
@section('content')

<div class="card">
    <div class="card-body">
    @include('admin.includes.alerts')

        <ul>
            <li>
                <strong>Nome:</strong> {{ $user->name }}
            </li>
            <li>
                <strong>E-mail:</strong> {{ $user->email }}
            </li>
            <li>
                <strong>Empresa:</strong> {{ $user->tenant->name }}
            </li>
        </ul>
        <form method="POST" action="{{ route('users.destroy', $user->uuid)}}">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>    

            DELETAR USER</button>
        </form>
    </div>
  
</div>
@stop