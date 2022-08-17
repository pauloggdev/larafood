@extends('adminlte::page')
@section('title', 'Editar Mesas')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('tables.index')}}">Mesas</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('tables.edit', $table->uuid)}}">Editar Mesas</a></li>
</ol>
<h1>Editar Mesa</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('tables.update', $table->uuid)}}" class="action">
            @csrf
            @method('PUT')
            @include('admin.includes.alerts')

            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="identify" class="form-control" value="{{ $table->identify ?? old('identify')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="name">Descrição: </label>
                <textarea name="description" id="" cols="30" class="form-control" placeholder="Descrição" rows="10">{{ $table->description }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </form>
    </div>

</div>
@stop