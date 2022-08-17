@extends('adminlte::page')
@section('title', 'Mesas')
@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('tables.index')}}">Mesas</a></li>
</ol>
<h1>Mesas <a href="{{ route('tables.create')}}" class="btn btn-dark">
        <i class="fas fa-plus-square"></i>
        ADD</a></h1>
@stop
@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{route('tables.search')}}" method="post" class="form form-inline">
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
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tables as $table)
                <tr>
                    <td>{{$table->identify}}</td>
                    <td>{{$table->description}}</td>
                    <td width="300px">
                       
                        <a href="{{ route('tables.edit', $table->uuid )}}" class="btn btn-primary">EDIT</a>
                        <a href="{{ route('tables.show', $table->uuid )}}" class="btn btn-warning">VER</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if(count($filters))
        {!! $tables->appends($filters)->links()!!}
        @else
        {!! $tables->links() !!}
        @endif
    </div>
</div>
@stop