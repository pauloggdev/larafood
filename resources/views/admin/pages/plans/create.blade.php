@extends('adminlte::page')
@section('title', 'Cadastrar Novo Plano')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.create')}}">Novo plano</a></li>
</ol>
<h1>Planos-Cadastrar Novo Plano</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('plans.store')}}" class="action">
            @csrf

            @include('admin.includes.alerts')
         
            <div class="form-group">
                <label for="name">Nome: </label>
                <input type="text" name="name" class="form-control" value="{{ $plan->name ?? old('name')}}" placeholder="Nome: ">
            </div>
            <div class="form-group">
                <label for="nome">Preço: </label>
                <input type="text" name="price" class="form-control" value="{{ $plan->name ?? old('price')}}" placeholder="Preço: ">
            </div>
            <div class="form-group">
                <label for="description">Descrição: </label>
                <input type="text" name="description" class="form-control" value="{{ $plan->name ?? old('description')}}" placeholder="Descrição: ">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>

        </form>

    </div>

</div>
@stop