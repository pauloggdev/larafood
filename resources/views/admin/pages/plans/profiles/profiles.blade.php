@extends('adminlte::page')
@section('title', "Perfis do plano {$plan->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profils.index')}}">Perfis</a></li>
</ol>
<h1>Perfis do Plano {{$plan->name}} <a href="{{ route('plan.profiles.available', $plan->id) }}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD NOVA PERFIL</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="" method="post" class="form form-inline">
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
                </tr>
            </thead>
            <tbody>
                @foreach($profiles as $profile)
                <tr>
                    <td>{{$profile->name}}</td>
                    <td width="50px">
                        <a href="" class="btn btn-primary">EDIT</a>
                    </td>
                    <td width="50px">
                        <a href="{{ route('plan.profiles.detach', [$plan->id, $profile->id] )}}" class="btn btn-danger">DESVINCULAR</a>
                    </td>
                </tr>
                @endforeach

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