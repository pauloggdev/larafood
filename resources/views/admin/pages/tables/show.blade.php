@extends('adminlte::page')
@section('title', "Descrição da Mesa" )
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('tables.index')}}">Mesas</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('tables.show', $table->uuid)}}">Descrição</a></li>
</ol>
<h1>Descrição da mesa</h1>
@stop
@section('content')

<div class="card">
    <div class="card-body">
    @include('admin.includes.alerts')

        <ul>
            <li>
                <strong>Nome:</strong> {{ $table->identify }}
            </li>
            <li>
                <strong>Empresa:</strong> {{ $table->tenant->name }}
            </li>
            <li>
                <strong>Descrição:</strong> {{ $table->description }}
            </li>
        </ul>
        <form method="POST" action="{{ route('tables.destroy', $table->uuid)}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>    

            DELETAR MESA</button>
        </form>
    </div>
  
</div>
@stop