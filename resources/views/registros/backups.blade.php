@extends('adminlte::page')

@section('title', 'Gestión de Backups - Registros')

@section('content_header')
    <h1>
        <i class="fas fa-database"></i> Gestión de Backups - Registros
        <small>Sistema automático y manual de respaldos CSV</small>
    </h1>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif

<div class="row">
 
<div class="row">
    <!-- Panel de Control -->
    <div class="col-md-4">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-cogs"></i> Panel de Control
                </h3>
            </div>
            <div class="card-body">
                <!-- Generar Backup Manual -->
                <form action="{{ route('registros.backup.generar') }}" method="POST" style="margin-bottom: 15px;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-block" onclick="return confirm('¿Generar backup manual de todos los registros?')">
                        <i class="fas fa-plus-circle"></i> Generar Backup Manual
                    </button>
                </form>
                
                <!-- Volver a Registros -->
                <a href="{{ route('registros.index') }}" class="btn btn-secondary btn-block">
                    <i class="fas fa-arrow-left"></i> Volver a Registros
                </a>
                
       
            </div>
        </div>
        
        <!-- Estadísticas -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie"></i> Estadísticas
                </h3>
            </div>
            <div class="card-body">
                <p><strong>Total de Backups:</strong> {{ count($backups) }}</p>
                <p><strong>Espacio Total:</strong> 
                    {{ number_format(array_sum(array_column($backups, 'size')) / 1024, 2) }} KB
                </p>
                @if(count($backups) > 0)
                    <p><strong>Último Backup:</strong> 
                        {{ $backups[0]['created_at']->format('d/m/Y H:i:s') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Lista de Backups -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-list"></i> Lista de Backups Disponibles
                </h3>
            </div>
            <div class="card-body">
                @if(count($backups) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Archivo</th>
                                    <th>Fecha/Hora</th>
                                    <th>Tamaño</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($backups as $backup)
                                    <tr>
                                        <td>
                                            <i class="fas fa-file-csv text-success"></i>
                                            {{ $backup['filename'] }}
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $backup['created_at']->format('d/m/Y') }}
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                {{ $backup['created_at']->format('H:i:s') }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">
                                                {{ number_format($backup['size'] / 1024, 2) }} KB
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <!-- Descargar -->
                                                <a href="{{ route('registros.backup.descargar', $backup['filename']) }}" 
                                                   class="btn btn-success" 
                                                   title="Descargar">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                                
                                                <!-- Eliminar -->
                                                <form action="{{ route('registros.backup.eliminar', $backup['filename']) }}" 
                                                      method="POST" 
                                                      style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger" 
                                                            title="Eliminar"
                                                            onclick="return confirm('¿Está seguro de eliminar este backup?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center">
                        <i class="fas fa-inbox fa-3x text-muted"></i>
                        <h4 class="text-muted">No hay backups disponibles</h4>
                        <p class="text-muted">Genere el primer backup manual o espere a que se ejecute automáticamente.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection

@section('css')
<style>
.info-box {
    margin-bottom: 15px;
}
.table td {
    vertical-align: middle;
}
.btn-group-sm > .btn, .btn-sm {
    margin-right: 2px;
}
</style>
@endsection
