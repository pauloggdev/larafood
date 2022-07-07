@extends('adminlte::page')
@section('title', "Detalhes do Plano {$plan->name}" )
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.show', $plan->url)}}">Detalhes</a></li>
</ol>
<h1>Detalhes do plano <b>{{ $plan->name }}</b></h1>
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>
                <strong>Nome:</strong> {{ $plan->name }}
            </li>
            <li>
                <strong>Url:</strong> {{ $plan->url }}
            </li>
            <li>
                <strong>Preço:</strong> R$ {{number_format( $plan->price, 2,',','.') }}
            </li>
            <li>
                <strong>Descrição:</strong> {{$plan->description}}
            </li>
        </ul>
        <form method="POST" action="{{ route('plans.destroy', $plan->url)}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>    

            DELETAR O PLANO {{ $plan->name }}</button>
        </form>
    </div>
  
</div>
@stop