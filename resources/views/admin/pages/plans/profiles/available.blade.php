@extends('adminlte::page')
@section('title', "Perfis do Plano {$plan->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.index')}}">Planos</a></li>
</ol>
<h1>Perfis disponivel para o plano {{$plan->name}}</h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('profil.permissions.available', $plan->id)}}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ??''}}">
            <button type="submit" class="btn btn-dark">Filtrar</button>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <form action="{{ route('plan.profiles.attach', $plan->id) }}" method="post">
                    @csrf
                    @foreach($profiles as $profile)
                    <tr>
                        <td>
                            <input type="checkbox" name="profiles[]" value="{{$profile->id}}" id="">
                        </td>
                        <td>{{ $profile->name}}</td>
                    </tr>

                    @endforeach
                    <tr>
                        <td colspan="500">
                            @include('admin.includes.alerts')
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(count($profiles))
        {!! $profiles->appends($filters)->links()!!}
        @else
        {!! $profiles->links() !!}
        @endif
    </div>
</div>
@stop