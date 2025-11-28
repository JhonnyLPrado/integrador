

<?php $__env->startSection('title', 'Análisis de Regresión - Delitos La Paz'); ?>

<?php $__env->startSection('content_header'); ?>
    <h1>
        <i class="fas fa-chart-line text-purple"></i>
        Análisis de Regresión Lineal - Delitos La Paz
    </h1>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="analisis-regresion">
    <?php if(isset($error)): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <?php echo e($error); ?>

        </div>
    <?php else: ?>
        <!-- Estadísticas principales -->
        <div class="row mb-4">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo e(number_format($data['estadisticas']['total_delitos'])); ?></h3>
                        <p>Total de Delitos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo e($data['estadisticas']['promedio_edad']); ?></h3>
                        <p>Edad Promedio</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo e($data['estadisticas']['total_zonas']); ?></h3>
                        <p>Zonas Afectadas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo e($data['estadisticas']['porcentaje_reincidencia']); ?>%</h3>
                        <p>Tasa de Reincidencia</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-redo"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficas principales -->
        <div class="row">
            <!-- Delitos por Zona -->
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-map-marker-alt"></i>
                            Frecuencia de Delitos por Zona
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="delitosPorZonaChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Delitos por Tipo -->
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-pie"></i>
                            Distribución de Tipos de Delitos
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="delitosPorTipoChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Análisis temporal y correlaciones -->
        <div class="row mt-4">
            <!-- Evolución temporal -->
            <div class="col-md-8">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line"></i>
                            Evolución Temporal de Delitos por Mes
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="evolutionChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Distribución por reincidencia -->
            <div class="col-md-4">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-redo"></i>
                            Análisis de Reincidencia
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="reincidenciaChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Análisis por edad y sexo -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card card-purple">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-venus-mars"></i>
                            Distribución de Edad por Sexo
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="edadSexoChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-fist-raised"></i>
                            Distribución de Edad por Nivel de Violencia
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="violenciaEdadChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>        <!-- Tabla de datos resumidos -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-table"></i>
                            Resumen de Datos por Zona
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Zona</th>
                                        <th>Cantidad de Delitos</th>
                                        <th>Porcentaje</th>
                                        <th>Representación Visual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $data['delitos_por_zona']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zona => $cantidad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $porcentaje = ($cantidad / $data['estadisticas']['total_delitos']) * 100;
                                        ?>
                                        <tr>
                                            <td><strong><?php echo e($zona); ?></strong></td>
                                            <td><?php echo e(number_format($cantidad)); ?></td>
                                            <td><?php echo e(number_format($porcentaje, 2)); ?>%</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-primary" role="progressbar" 
                                                         style="width: <?php echo e($porcentaje); ?>%" 
                                                         aria-valuenow="<?php echo e($porcentaje); ?>" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel de acciones -->
            <div class="col-md-4">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-tools"></i>
                            Acciones Disponibles
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block mb-2" onclick="actualizarDatos()">
                                <i class="fas fa-sync"></i> Actualizar Datos
                            </button>
                            <button class="btn btn-info btn-block mb-2" onclick="mostrarPrediccion()">
                                <i class="fas fa-brain"></i> Hacer Predicción
                            </button>
                            <button class="btn btn-success btn-block mb-2" onclick="exportarPDF()">
                                <i class="fas fa-file-pdf"></i> Exportar PDF
                            </button>
                            <button class="btn btn-warning btn-block" onclick="exportarExcel()">
                                <i class="fas fa-file-excel"></i> Exportar Excel
                            </button>
                        </div>
                    </div>
                </div>            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .small-box .icon {
            font-size: 60px;
        }
        .progress {
            height: 20px;
        }
        .card-header {
            font-weight: bold;
        }
        canvas {
            max-height: 400px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if(!isset($error)): ?>
            // Datos de PHP para JavaScript
            const delitosPorZona = <?php echo json_encode($data['delitos_por_zona'], 15, 512) ?>;
            const delitosPorTipo = <?php echo json_encode($data['delitos_por_tipo'], 15, 512) ?>;
            const delitosPorMes = <?php echo json_encode($data['delitos_por_mes'], 15, 512) ?>;
            const edadPorSexo = <?php echo json_encode($data['edad_por_sexo'], 15, 512) ?>;
            const reincidenciaData = <?php echo json_encode($data['reincidencia_datos'], 15, 512) ?>;
            const violenciaEdadData = <?php echo json_encode($data['violencia_por_edad'], 15, 512) ?>;

            // Configuración general de Chart.js
            Chart.defaults.responsive = true;
            Chart.defaults.maintainAspectRatio = false;

            // Gráfica de delitos por zona
            const ctxZona = document.getElementById('delitosPorZonaChart').getContext('2d');
            new Chart(ctxZona, {
                type: 'bar',
                data: {
                    labels: Object.keys(delitosPorZona),
                    datasets: [{
                        label: 'Cantidad de Delitos',
                        data: Object.values(delitosPorZona),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfica de delitos por tipo
            const ctxTipo = document.getElementById('delitosPorTipoChart').getContext('2d');
            new Chart(ctxTipo, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(delitosPorTipo),
                    datasets: [{
                        data: Object.values(delitosPorTipo),
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                            '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF',
                            '#4BC0C0', '#FF6384'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Gráfica de evolución temporal
            const ctxEvolution = document.getElementById('evolutionChart').getContext('2d');
            const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            const datosTemporales = Array(12).fill(0);
            
            Object.keys(delitosPorMes).forEach(mes => {
                datosTemporales[parseInt(mes) - 1] = delitosPorMes[mes];
            });

            new Chart(ctxEvolution, {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Número de Delitos',
                        data: datosTemporales,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfica de reincidencia
            const ctxReincidencia = document.getElementById('reincidenciaChart').getContext('2d');
            const reincidenciaLabels = Object.keys(reincidenciaData);
            const reincidenciaValues = reincidenciaLabels.map(label => reincidenciaData[label].length);

            new Chart(ctxReincidencia, {
                type: 'pie',
                data: {
                    labels: reincidenciaLabels,
                    datasets: [{
                        data: reincidenciaValues,
                        backgroundColor: ['#28a745', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Gráfica de edad por sexo
            const ctxEdadSexo = document.getElementById('edadSexoChart').getContext('2d');
            const sexos = Object.keys(edadPorSexo);
            const datasets = sexos.map((sexo, index) => {
                const colores = ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 205, 86, 0.6)'];
                const edades = edadPorSexo[sexo];
                // Calcular promedio de edad por sexo
                const promedio = edades.reduce((a, b) => a + b, 0) / edades.length;
                
                return {
                    label: sexo,
                    data: [promedio],
                    backgroundColor: colores[index % colores.length],
                    borderColor: colores[index % colores.length].replace('0.6', '1'),
                    borderWidth: 1
                };
            });

            new Chart(ctxEdadSexo, {
                type: 'bar',
                data: {
                    labels: ['Edad Promedio'],
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Gráfica de violencia por edad
            const ctxViolenciaEdad = document.getElementById('violenciaEdadChart').getContext('2d');
            const nivelesViolencia = Object.keys(violenciaEdadData);
            const datasetsViolencia = nivelesViolencia.map((nivel, index) => {
                const colores = ['rgba(40, 167, 69, 0.6)', 'rgba(255, 193, 7, 0.6)', 'rgba(220, 53, 69, 0.6)'];
                const edades = violenciaEdadData[nivel];
                const promedio = edades.reduce((a, b) => a + b, 0) / edades.length;
                
                return {
                    label: nivel,
                    data: [promedio],
                    backgroundColor: colores[index % colores.length],
                    borderColor: colores[index % colores.length].replace('0.6', '1'),
                    borderWidth: 1
                };
            });

            new Chart(ctxViolenciaEdad, {
                type: 'bar',
                data: {
                    labels: ['Edad Promedio'],
                    datasets: datasetsViolencia
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }                }
            });
        <?php endif; ?>

        // Funciones de interactividad
        function actualizarDatos() {
            fetch('<?php echo e(route("api.analisis-regresion.datos")); ?>')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Datos actualizados:', data.data);
                    Swal.fire({
                        title: 'Datos Actualizados',
                        text: 'Se han cargado los datos más recientes',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al actualizar los datos',
                    icon: 'error'
                });
            });
        }        function exportarPDF() {
            // Mostrar loading
            Swal.fire({
                title: 'Generando PDF...',
                text: 'Por favor espera mientras se genera el reporte',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('<?php echo e(route("api.analisis-regresion.exportar-pdf")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    throw new Error(data.message || 'Error desconocido');
                }
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al generar el PDF: ' + error.message,
                    icon: 'error'
                });
            });
        }

        function exportarExcel() {
            // Mostrar loading
            Swal.fire({
                title: 'Generando Excel...',
                text: 'Por favor espera mientras se genera el archivo',
                allowOutsideClick: false,
                showConfirmButton: false,
                willOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch('<?php echo e(route("api.analisis-regresion.exportar-excel")); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                }
            })
            .then(response => response.json())
            .then(data => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    throw new Error(data.message || 'Error desconocido');
                }
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error al generar el Excel: ' + error.message,
                    icon: 'error'
                });
            });
        }

        function mostrarPrediccion() {
            Swal.fire({
                title: 'Hacer Predicción',
                html: `
                    <div class="form-group">
                        <label>Edad:</label>
                        <input type="number" id="edad" class="form-control" value="30" min="18" max="80">
                    </div>
                    <div class="form-group">
                        <label>Zona:</label>
                        <select id="zona" class="form-control">
                            <option value="Centro">Centro</option>
                            <option value="El Alto">El Alto</option>
                            <option value="Sopocachi">Sopocachi</option>
                            <option value="Miraflores">Miraflores</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Delito:</label>
                        <select id="tipoDelito" class="form-control">
                            <option value="Robo">Robo</option>
                            <option value="Asalto">Asalto</option>
                            <option value="Hurto">Hurto</option>
                            <option value="Violación">Violación</option>
                        </select>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Calcular Predicción',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const edad = document.getElementById('edad').value;
                    const zona = document.getElementById('zona').value;
                    const tipoDelito = document.getElementById('tipoDelito').value;
                    
                    return fetch('<?php echo e(route("api.analisis-regresion.prediccion")); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        body: JSON.stringify({
                            edad: edad,
                            zona: zona,
                            tipo_delito: tipoDelito
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            return data.prediccion;
                        } else {
                            throw new Error('Error en la predicción');
                        }
                    })
                    .catch(error => {
                        Swal.showValidationMessage('Error al calcular la predicción');
                    });
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    const prediccion = result.value;
                    Swal.fire({
                        title: 'Resultado de la Predicción',
                        html: `
                            <div class="alert alert-info">
                                <h5>Probabilidad de Reincidencia: <strong>${prediccion.probabilidad_reincidencia}%</strong></h5>
                                <p>Nivel de Riesgo: <span class="badge badge-${prediccion.nivel_riesgo === 'Alto' ? 'danger' : (prediccion.nivel_riesgo === 'Medio' ? 'warning' : 'success')}">${prediccion.nivel_riesgo}</span></p>
                                <hr>
                                <small>
                                    Factores considerados:<br>
                                    • Edad: ${prediccion.factores.edad} años<br>
                                    • Zona: ${prediccion.factores.zona}<br>
                                    • Tipo de Delito: ${prediccion.factores.tipo_delito}
                                </small>
                            </div>
                        `,
                        icon: 'info',
                        confirmButtonText: 'Entendido'
                    });
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\integrador\resources\views/analisis-regresion/index.blade.php ENDPATH**/ ?>