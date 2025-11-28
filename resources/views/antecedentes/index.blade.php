@extends('adminlte::page')

@section('title', 'Antecedentes')

@section('content_header')
    <div class="row">
        <div class="col-sm-6">
            <h1>Gestión de Antecedentes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                
                <li class="breadcrumb-item active">Antecedentes</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">                <div class="card-header">
                    <h3 class="card-title">Lista de Antecedentes</h3>
                    <div class="card-tools">
                    </div>
                </div>
                
                <div class="card-body">                    <!-- Formulario de búsqueda -->
                    <form method="GET" action="{{ route('antecedentes.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="text" name="ci" class="form-control" placeholder="CI" value="{{ request('ci') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="nombres" class="form-control" placeholder="Nombres" value="{{ request('nombres') }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="apellido_paterno" class="form-control" placeholder="Apellido Paterno" value="{{ request('apellido_paterno') }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="apellido_materno" class="form-control" placeholder="Apellido Materno" value="{{ request('apellido_materno') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <a href="{{ route('antecedentes.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Limpiar
                                </a>
                            </div>
                        </div>
                    </form>

                    @if($registros->count() > 0)                      
                         
                          
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>CI</th>
                                        <th>Nombre Completo</th>
                                        <th>Antecedentes</th>
                                        <th>Fecha de Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registros as $registro)
                                        <tr>
                                            <td></td>
                                            <td>{{ $registro->ci }}</td>                            <td>{{ $registro->nombres }} {{ $registro->apellido_paterno }} {{ $registro->apellido_materno }}</td>
                            <td>
                                <span class="badge badge-info">{{ $registro->antecedentes_count }}</span>
                            </td>
                                            <td>
                                                @if($registro->last_created)
                                                    {{ \Carbon\Carbon::parse($registro->last_created)->format('d/m/Y H:i') }}
                                                @else
                                                    <span class="text-muted">Sin fecha</span>
                                                @endif
                                            </td>                                            <td>
                                                <a href="{{ route('antecedentes.index', ['ci' => $registro->ci, 'ver_todos' => 1]) }}" class="btn btn-outline-primary btn-sm" title="Ver todos los antecedentes de este CI">
                                                    <i class="fas fa-list"></i> Ver todos
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Botón para generar PDF múltiple -->
                        <div class="mt-3">
                            <button type="button" class="btn btn-success" id="btn-pdf-multiple" disabled>
                                <i class="fas fa-file-pdf"></i> Generar PDF de Seleccionados
                            </button>
                        </div>
                        
                        <!-- Paginación -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $registros->appends(request()->query())->links() }}
                        </div>                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No se encontraron registros.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script>
    $(document).ready(function() {
        // Seleccionar/deseleccionar todos
        $('#select-all').change(function() {
            $('.registro-checkbox').prop('checked', this.checked);
            togglePdfButton();
        });
        
        // Cambio en checkboxes individuales
        $('.registro-checkbox').change(function() {
            togglePdfButton();
        });
        
        // Función para habilitar/deshabilitar botón PDF múltiple
        function togglePdfButton() {
            const checkedBoxes = $('.registro-checkbox:checked').length;
            $('#btn-pdf-multiple').prop('disabled', checkedBoxes === 0);
        }
        
        // Generar PDF múltiple
        $('#btn-pdf-multiple').click(function() {
            const selectedIds = $('.registro-checkbox:checked').map(function() {
                return this.value;
            }).get();
            
            if (selectedIds.length > 0) {
                const form = $('<form>', {
                    'method': 'POST',
                    'action': '{{ route("antecedentes.pdf-multiple") }}'
                });
                
                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': '{{ csrf_token() }}'
                }));
                
                selectedIds.forEach(function(id) {
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
        });
    });
</script>
@stop
