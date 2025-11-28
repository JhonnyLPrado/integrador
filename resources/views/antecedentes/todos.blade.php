@extends('adminlte::page')

@section('title', 'Todos los Registros Policiales')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Todos los Registros Policiales</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('antecedentes.index') }}">Antecedentes</a></li>
                <li class="breadcrumb-item active">Registros de {{ $persona->ci ?? 'CI' }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <!-- Información Personal -->
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user"></i> Datos Personales</h3>
                </div>
                <div class="card-body">
                    @if($persona)
                        <div class="text-center mb-3">
                            @if(isset($persona->foto) && $persona->foto)
                                <img src="{{ asset('fotos/' . $persona->foto) }}" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;" alt="Foto">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; margin: 0 auto;">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif
                            <p class="text-muted mt-2">Foto oficial</p>
                        </div>
                        
                        <table class="table table-sm">
                            <tr>
                                <td><strong>Nombre Completo:</strong></td>
                                <td>{{ $persona->nombres }} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }}</td>
                            </tr>
                            <tr>
                                <td><strong>CI:</strong></td>
                                <td><span class="badge badge-info">{{ $persona->ci }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Estado Civil:</strong></td>
                                <td>{{ ucfirst($persona->estado_civil ?? 'No especificado') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Expedido en:</strong></td>
                                <td>{{ $persona->expedido ?? 'No especificado' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Fecha de Nacimiento:</strong></td>
                                <td>
                                    @if(isset($persona->fecha_nacimiento) && $persona->fecha_nacimiento)
                                        {{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}
                                    @else
                                        No especificado
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Profesión:</strong></td>
                                <td>{{ $persona->profesion ?? 'No especificado' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Domicilio:</strong></td>
                                <td>{{ $persona->domicilio ?? 'No especificado' }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> No se encontraron datos de la persona.
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Registro Policial -->
        <div class="col-md-8">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Registro Policial</h3>
                    <div class="card-tools">
                        <a href="{{ route('antecedentes.index') }}" class="btn btn-tool">
                            <i class="fas fa-arrow-left"></i> Volver a la lista
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="text-center mb-4">TODOS SUS REGISTROS POLICIALES</h4>
                    
                    @if($registros && $registros->count() > 0)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p><strong>Total de registros:</strong> <span class="badge badge-danger">{{ $registros->total() }}</span></p>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-success btn-sm" onclick="generarPdfTodos()">
                                    <i class="fas fa-file-pdf"></i> Generar PDF Completo
                                </button>
                            </div>
                        </div>
                        
                        @foreach($registros as $index => $registro)
                            <div class="card card-outline card-warning mb-3">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <i class="fas fa-exclamation-triangle text-warning"></i> 
                                        Registro #{{ $registros->total() - ($registros->currentPage() - 1) * $registros->perPage() - $index }}
                                    </h5>
                                    <div class="card-tools">
                                        <span class="badge badge-info">{{ $registro->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Cargo:</strong> {{ $registro->cargo }}</p>
                                           
                                        </div>
                                        <div class="col-md-6">
                                            @if($registro->latitud && $registro->longitud)
                                                <p><strong>Ubicación:</strong> Lat: {{ $registro->latitud }}, Lng: {{ $registro->longitud }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <strong>Descripción:</strong>
                                        <div class="bg-light p-3 rounded">
                                            {{ $registro->descripcion }}
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3 text-right">
                                        <a href="{{ route('antecedentes.show', $registro->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Ver detalles
                                        </a>
                                        <button class="btn btn-success btn-sm" onclick="generarPdfIndividual({{ $registro->id }})">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- Paginación -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $registros->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle"></i> No se encontraron registros policiales para este CI.
                            <br>
                            <small>CI buscado: {{ request('ci') }}</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    function generarPdfIndividual(registroId) {
        window.open('{{ route("antecedentes.pdf", "") }}/' + registroId, '_blank');
    }
    
    function generarPdfTodos() {
        // Crear formulario para enviar todos los IDs de esta página
        const registroIds = @json($registros->pluck('id')->toArray());
        
        const form = $('<form>', {
            'method': 'POST',
            'action': '{{ route("antecedentes.pdf-multiple") }}'
        });
        
        form.append($('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': '{{ csrf_token() }}'
        }));
        
        registroIds.forEach(function(id) {
            form.append($('<input>', {
                'type': 'hidden',
                'name': 'registros[]',
                'value': id
            }));
        });
        
        $('body').append(form);
        form.submit();
        form.remove();
    }
</script>
@stop
