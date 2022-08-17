@extends('adminlte::page')
@section('title', 'Permissions')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('permissions.index')}}">Permissions</a></li>
</ol>
<h1>Permissions <a href="{{ route('permissions.create')}}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('permissions.search')}}" method="post" class="form form-inline">
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
                @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td>{{ $permission->description}}</td>
                    <td width="250px" style="display:flex;">
                        <a href="{{ route('permissions.edit', $permission->id )}}" class="btn btn-primary">EDIT</a>
                        <form action="{{ route('permissions.destroy', $permission->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">DELET</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ route('permission.profiles', $permission->id )}}" class="btn btn-primary">
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