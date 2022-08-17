@extends('adminlte::page')
@section('title', "Perfis da Permissão {$permission->name}")
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profils.index')}}">Perfis</a></li>
</ol>
<h1>Permissão - {{$permission->name}}</h1>
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
                        <a href="{{ route('permission.profile.detachProfile',[$permission->id, $profile->id ]) }}" class="btn btn-danger">DESVINCULAR</a>
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