

<?php $__env->startSection('title', 'Ver Registro'); ?>



<?php $__env->startSection('content_header'); ?>
    <h1>Detalles del Registro</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- DATOS PERSONALES -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-user"></i> Datos Personales</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <?php if($registro->foto): ?>
                        <div class="text-center mb-3">
                            <img src="<?php echo e(asset($registro->foto)); ?>" alt="Foto del registro" class="img-thumbnail" style="max-height: 200px; max-width: 200px;">
                            <p class="text-muted mt-2">Fotografía</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Nombre Completo:</strong></label>
                                <p><?php echo e($registro->nombres); ?> <?php echo e($registro->apellido_paterno); ?> <?php echo e($registro->apellido_materno); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>CI:</strong></label>
                                <p><?php echo e($registro->ci); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Expedido en:</strong></label>
                                <p><?php echo e($registro->expedido ?? 'No especificado'); ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Fecha de Nacimiento:</strong></label>
                                <p>
                                    <?php if($registro->fecha_nacimiento): ?>
                                        <?php echo e($registro->fecha_nacimiento->format('d/m/Y')); ?>

                                        <small class="text-muted">(<?php echo e($registro->edad); ?> años)</small>
                                    <?php else: ?>
                                        No especificado
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><strong>Estado Civil:</strong></label>
                                <p>
                                    <?php if($registro->estado_civil): ?>
                                        <?php echo e(\App\Models\Registro::getEstadosCiviles()[$registro->estado_civil]); ?>

                                    <?php else: ?>
                                        No especificado
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label><strong>Profesión:</strong></label>
                                <p><?php echo e($registro->profesion ?? 'No especificado'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>Domicilio:</strong></label>
                                <p><?php echo e($registro->domicilio ?? 'No especificado'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DATOS DEL REGISTRO POLICIAL -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Registro Policial</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Tipo de Delito/Infracción:</strong></label>
                        <p><?php echo e($registro->cargo); ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Fecha de Registro:</strong></label>
                        <p><?php echo e($registro->created_at->format('d/m/Y H:i:s')); ?></p>
                    </div>
                </div>
            </div>

            <?php if($registro->descripcion): ?>
            <div class="form-group">
                <label><strong>Descripción del Incidente:</strong></label>
                <p><?php echo e($registro->descripcion); ?></p>
            </div>
            <?php endif; ?>

            <?php if($registro->antecedentes): ?>
            <div class="form-group">
                <label><strong>Antecedentes:</strong></label>
                <div class="alert alert-info">
                    <p><?php echo e($registro->antecedentes); ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- UBICACIÓN DEL INCIDENTE -->
    <?php if($registro->longitud && $registro->latitud): ?>
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Ubicación del Incidente</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <p><strong>Coordenadas:</strong> Latitud: <?php echo e($registro->latitud); ?>, Longitud: <?php echo e($registro->longitud); ?></p>
                <div id="map" style="height: 300px; width: 100%; border: 1px solid #ddd; border-radius: 5px;"></div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- BOTONES DE ACCIÓN -->
    <div class="card">
        <div class="card-body text-center">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-registros')): ?>
                <a href="<?php echo e(route('registros.edit', $registro)); ?>" class="btn btn-warning btn-lg">
                    <i class="fas fa-edit"></i> Editar
                </a>
            <?php endif; ?>
            <a href="<?php echo e(route('registros.index')); ?>" class="btn btn-secondary btn-lg ml-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage-registros')): ?>
                <form action="<?php echo e(route('registros.destroy', $registro)); ?>" method="POST" style="display:inline-block" class="ml-2">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if($registro->longitud && $registro->latitud): ?>
<?php $__env->startSection('js'); ?>
    <!-- Google Maps JavaScript API -->    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApZs1RsAdo4vF99FvtN8Fqf5vbn0vYWG4&callback=initMap&libraries=&v=weekly" async defer></script>
    <script>
        function initMap() {
            const ubicacion = { 
                lat: parseFloat(<?php echo e($registro->latitud); ?>), 
                lng: parseFloat(<?php echo e($registro->longitud); ?>) 
            };
            
            const map = new google.maps.Map(document.getElementById('map'), {
                center: ubicacion,
                zoom: 15
            });

            const marker = new google.maps.Marker({
                position: ubicacion,
                map: map,
                title: 'Ubicación del incidente'
            });

            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div>
                        <h6>Ubicación del Incidente</h6>
                        <p><strong>Delito:</strong> <?php echo e($registro->cargo); ?></p>
                        <p><strong>Fecha:</strong> <?php echo e($registro->created_at->format('d/m/Y H:i')); ?></p>
                    </div>
                `
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });
        }

        // Hacer la función disponible globalmente
        window.initMap = initMap;
    </script>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\integrador\resources\views/registros/show.blade.php ENDPATH**/ ?>