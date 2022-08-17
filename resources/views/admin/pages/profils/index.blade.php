@extends('adminlte::page')
@section('title', 'Perfis')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profils.index')}}">Perfis</a></li>
</ol>
<h1>Perfils <a href="{{ route('profils.create')}}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('profils.search')}}" method="post" class="form form-inline">
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
                    <th>descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profils as $profil)
                <tr>
                    <td>{{$profil->name}}</td>
                    <td>{{ $profil->description}}</td>
                    <td width="250px" style="display:flex;">
                        <a href="{{ route('profils.edit', $profil->id )}}" class="btn btn-primary">EDIT</a>
                        <form action="{{ route('profils.destroy', $profil->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">DELET</button>
                        </form>
                        <a href="{{ route('profil.permissions', $profil->id )}}" class="btn btn-primary">
                            <i class="fas fa-lock"></i>
                        </a>
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