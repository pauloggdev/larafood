@extends('adminlte::page')
@section('title', 'Detalhes')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index')}}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url)}}">Detalhes</a></li>
</ol>
<h1>Detalhes <a href="{{ route('details.plan.create', $plan->url)}}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('plans.search')}}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ??''}}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $detail)
                <tr>
                    <td>{{$detail->name}}</td>
                    <td width="250px">
                        <a href="{{ route('details.plan.edit', [$plan->url, $detail->id])}}" class="btn btn-primary">EDIT</a>
                        <a href="{{ route('details.plan.destroy', [$plan->url, $detail->id] )}}" class="btn btn-warning">DELET</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">

    </div>
</div>
@stop