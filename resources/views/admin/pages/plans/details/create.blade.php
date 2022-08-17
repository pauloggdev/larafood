@extends('adminlte::page')
@section('title', 'Cadastrar Novo Detalhes')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.create')}}">Novo plano</a></li>
</ol>
<h1>Detalhe no plano {{ $plan->name }}</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="post" action="{{ route('details.plan.store', $plan->url)}}" class="action">
            @include('admin.includes.alerts')
            @include('admin.pages.plans.details._partials.form')
        </form>

    </div>

</div>
@stop