@extends('adminlte::page')
@section('title', "Permissões do Perfil {$profile->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profils.index')}}">Perfis</a></li>
</ol>
<h1>Permissões disponivel para o Perfil {{$profile->name}}</h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('profil.permissions.available', $profile->id)}}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter"  placeholder="Nome" class="form-control" value="{{$filters['filter'] ??''}}">
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
                <form action="{{ route('profil.permissions.attach', $profile->id) }}" method="post">
                    @csrf
                    @foreach($permissions as $permission)
                    <tr>
                        <td>
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}" id="">
                        </td>
                        <td>{{ $permission->name}}</td>
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
        @if(count($permissions))
        {!! $permissions->appends($filters)->links()!!}
        @else
        {!! $permissions->links() !!}
        @endif
    </div>
</div>
@stop