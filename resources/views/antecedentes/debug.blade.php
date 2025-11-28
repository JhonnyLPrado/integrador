@extends('adminlte::page')

@section('title', 'Debug - Todos los Registros')

@section('content_header')
    <h1>Debug - Todos los Registros</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Debug Information</h3>
        </div>
        <div class="card-body">
            <h4>Variables recibidas:</h4>
            <ul>
                <li><strong>CI:</strong> {{ request('ci') }}</li>
                <li><strong>Ver todos:</strong> {{ request('ver_todos') }}</li>
                <li><strong>Registros count:</strong> {{ $registros ? $registros->count() : 'NULL' }}</li>
                <li><strong>Persona:</strong> {{ $persona ? 'SÍ' : 'NO' }}</li>
            </ul>
            
            @if($persona)
                <h4>Datos de la persona:</h4>
                <ul>
                    <li><strong>CI:</strong> {{ $persona->ci }}</li>
                    <li><strong>Nombre:</strong> {{ $persona->nombres }} {{ $persona->apellido_paterno }}</li>
                </ul>
            @endif
            
            @if($registros && $registros->count() > 0)
                <h4>Registros encontrados:</h4>
                @foreach($registros as $registro)
                    <div class="alert alert-info">
                        <strong>ID:</strong> {{ $registro->id }} | 
                        <strong>CI:</strong> {{ $registro->ci }} | 
                        <strong>Cargo:</strong> {{ $registro->cargo }}
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning">No hay registros</div>
            @endif
            
            <a href="{{ route('antecedentes.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
@stop
