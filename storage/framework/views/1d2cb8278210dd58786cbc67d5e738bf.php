

<?php $__env->startSection('title', 'Crear Usuario'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/usuarios.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content_header'); ?>
    <h1 class="text-dark">Crear Usuario</h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="user-form-container">
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('usuarios.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="photo-container">
                <label for="foto">
                    <i class="fas fa-camera mr-2"></i>Foto del Usuario
                </label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="foto-preview" src="#" alt="Previsualización" class="photo-preview" />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user mr-2"></i>Nombre
                        </label>
                        <input type="text" name="name" id="name" class="form-control" required value="<?php echo e(old('name')); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido_paterno">
                            <i class="fas fa-user mr-2"></i>Apellido Paterno
                        </label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" class="form-control" required value="<?php echo e(old('apellido_paterno')); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido_materno">
                            <i class="fas fa-user mr-2"></i>Apellido Materno
                        </label>
                        <input type="text" name="apellido_materno" id="apellido_materno" class="form-control" required value="<?php echo e(old('apellido_materno')); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ci">
                            <i class="fas fa-id-card mr-2"></i>CI
                        </label>
                        <input type="text" name="ci" id="ci" class="form-control" required value="<?php echo e(old('ci')); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="placa">
                            <i class="fas fa-shield-alt mr-2"></i>Placa
                        </label>
                        <input type="text" name="placa" id="placa" class="form-control" required value="<?php echo e(old('placa')); ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </label>
                        <input type="email" name="email" id="email" class="form-control" required value="<?php echo e(old('email')); ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="rol">
                            <i class="fas fa-user-shield mr-2"></i>Rol
                        </label>
                        <select name="rol" id="rol" class="form-control" required>
                            <option value="">Seleccione un rol</option>
                        
                            <option value="comandante" <?php echo e(old('rol') == 'comandante' ? 'selected' : ''); ?>>Comandante</option>
                            <option value="Sargento" <?php echo e(old('rol') == 'Sargento' ? 'selected' : ''); ?>>Sargento</option>
                            <option value="policia" <?php echo e(old('rol') == 'policia' ? 'selected' : ''); ?>>Policía</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-2"></i>Guardar
                </button>
                <a href="<?php echo e(route('usuarios.index')); ?>" class="btn btn-secondary ml-2">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const output = document.getElementById('foto-preview');
            
            reader.onload = function() {
                output.src = reader.result;
                output.style.display = 'block';
            }
            
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Validación del CI
        document.getElementById('ci').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Validación de la Placa
        document.getElementById('placa').addEventListener('input', function(e) {
            this.value = this.value.toUpperCase();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\integrador\resources\views/usuarios/create.blade.php ENDPATH**/ ?>