

<?php $__env->startSection('title', 'Nueva Asignación - Repartición de Personal'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="row">
        <div class="col-sm-6">
            <h1>Nueva Asignación de Personal</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('reparticiones.index')); ?>">Repartición de Personal</a></li>
                <li class="breadcrumb-item active">Nueva Asignación</li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulario de Nueva Asignación</h3>
                    <div class="card-tools">
                        <a href="<?php echo e(route('reparticiones.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                    </div>
                </div>
                
                <form action="<?php echo e(route('reparticiones.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Policía <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-control <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">Seleccione un policía</option>
                                        <?php $__currentLoopData = $policias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($policia->id); ?>" <?php echo e(old('user_id') == $policia->id ? 'selected' : ''); ?>>
                                                <?php echo e($policia->name); ?> - <?php echo e($policia->email); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['user_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <small class="form-text text-muted">
                                        Solo se muestran usuarios con rol de policía activos
                                    </small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="zona">Zona de La Paz <span class="text-danger">*</span></label>
                                    <select name="zona" id="zona" class="form-control <?php $__errorArgs = ['zona'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">Seleccione una zona</option>
                                        <?php $__currentLoopData = $zonas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($key); ?>" <?php echo e(old('zona') == $key ? 'selected' : ''); ?>>
                                                <?php echo e($value); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['zona'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_asignacion">Fecha de Asignación <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           name="fecha_asignacion" 
                                           id="fecha_asignacion" 
                                           class="form-control <?php $__errorArgs = ['fecha_asignacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           value="<?php echo e(old('fecha_asignacion', date('Y-m-d'))); ?>" 
                                           min="<?php echo e(date('Y-m-d')); ?>"
                                           required>
                                    <?php $__errorArgs = ['fecha_asignacion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="horario_inicio">Horario de Inicio <span class="text-danger">*</span></label>
                                    <input type="time" 
                                           name="horario_inicio" 
                                           id="horario_inicio" 
                                           class="form-control <?php $__errorArgs = ['horario_inicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           value="<?php echo e(old('horario_inicio', '08:00')); ?>"
                                           required>
                                    <?php $__errorArgs = ['horario_inicio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="horario_fin">Horario de Fin <span class="text-danger">*</span></label>
                                    <input type="time" 
                                           name="horario_fin" 
                                           id="horario_fin" 
                                           class="form-control <?php $__errorArgs = ['horario_fin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           value="<?php echo e(old('horario_fin', '16:00')); ?>"
                                           required>
                                    <?php $__errorArgs = ['horario_fin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <textarea name="observaciones" 
                                      id="observaciones" 
                                      class="form-control <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="3" 
                                      placeholder="Observaciones adicionales sobre la asignación (opcional)"
                                      maxlength="500"><?php echo e(old('observaciones')); ?></textarea>
                            <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted">Máximo 500 caracteres</small>
                        </div>

                        <!-- Alert de disponibilidad -->
                        <div id="disponibilidad-alert" class="alert alert-info" style="display: none;">
                            <i class="fas fa-info-circle"></i>
                            <span id="disponibilidad-mensaje"></span>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Guardar Asignación
                        </button>
                        <a href="<?php echo e(route('reparticiones.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .form-group label {
            font-weight: 600;
        }
        .text-danger {
            color: #dc3545 !important;
        }
        .invalid-feedback {
            display: block;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            // Validación en tiempo real de horarios
            $('#horario_inicio, #horario_fin').on('change', function() {
                validateTimeRange();
            });

            // Verificar disponibilidad cuando cambian fecha y horarios
            $('#fecha_asignacion, #horario_inicio, #horario_fin, #user_id').on('change', function() {
                checkAvailability();
            });

            function validateTimeRange() {
                const inicio = $('#horario_inicio').val();
                const fin = $('#horario_fin').val();
                
                if (inicio && fin && inicio >= fin) {
                    $('#horario_fin').addClass('is-invalid');
                    showAlert('warning', 'El horario de fin debe ser posterior al horario de inicio');
                } else {
                    $('#horario_fin').removeClass('is-invalid');
                    hideAlert();
                }
            }

            function checkAvailability() {
                const fecha = $('#fecha_asignacion').val();
                const horaInicio = $('#horario_inicio').val();
                const horaFin = $('#horario_fin').val();
                const userId = $('#user_id').val();
                
                if (fecha && horaInicio && horaFin && userId) {
                    $.ajax({
                        url: "<?php echo e(route('reparticiones.disponibles')); ?>",
                        method: 'GET',
                        data: {
                            fecha: fecha,
                            hora_inicio: horaInicio,
                            hora_fin: horaFin
                        },
                        success: function(data) {
                            const disponible = data.some(policia => policia.id == userId);
                            
                            if (!disponible) {
                                showAlert('danger', 'El policía seleccionado ya tiene una asignación en ese horario');
                                $('#user_id').addClass('is-invalid');
                            } else {
                                showAlert('success', 'El policía está disponible para ese horario');
                                $('#user_id').removeClass('is-invalid');
                            }
                        },
                        error: function() {
                            showAlert('warning', 'No se pudo verificar la disponibilidad');
                        }
                    });
                }
            }

            function showAlert(type, message) {
                const alertDiv = $('#disponibilidad-alert');
                alertDiv.removeClass('alert-info alert-success alert-warning alert-danger')
                        .addClass('alert-' + type)
                        .show();
                $('#disponibilidad-mensaje').text(message);
            }

            function hideAlert() {
                $('#disponibilidad-alert').hide();
            }

            // Contador de caracteres para observaciones
            $('#observaciones').on('input', function() {
                const maxLength = 500;
                const currentLength = $(this).val().length;
                const remaining = maxLength - currentLength;
                
                $(this).next('.form-text').text(`Máximo 500 caracteres (${remaining} restantes)`);
                
                if (remaining < 0) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // Select2 para mejor UX
            if ($.fn.select2) {
                $('#user_id, #zona').select2({
                    theme: 'bootstrap4',
                    placeholder: function() {
                        return $(this).data('placeholder');
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\integrador\resources\views/reparticiones/create.blade.php ENDPATH**/ ?>