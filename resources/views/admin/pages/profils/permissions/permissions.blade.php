@extends('adminlte::page')
@section('title', "Permissões do Perfil {$profile->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profils.index')}}">Perfis</a></li>
</ol>
<h1>Permissões do Perfil {{$profile->name}} <a href="{{ route('profil.permissions.available', $profile->id)}}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD NOVA PERMISSÃO</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('profil.permissions.available', $profile->id)}}" method="post" class="form form-inline">
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
<!-- =                    <th>Ações</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td width="50px">
                        <a href="{{ route('profils.edit', $profile->id )}}" class="btn btn-primary">EDIT</a>
                    </td>
                    <td width="50px">
                        <a href="{{ route('profil.permissions.detach', [$profile->id, $permission->id] )}}" class="btn btn-danger">DESVINCULAR</a>
                    </td>
                </tr>
                @endforeach

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