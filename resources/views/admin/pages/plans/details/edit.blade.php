@extends('adminlte::page')
@section('title', 'Editar Detalhes')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.create')}}">Novo plano</a></li>
</ol>
<h1>Editar Detalhe no plano {{ $plan->name }}</h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('details.plan.update',[$plan->url, $detail->id])}}" class="action">
            @include('admin.includes.alerts')
            @method('PUT')
            @include('admin.pages.plans.details._partials.form')
        </form>

    </div>

</div>
@stop