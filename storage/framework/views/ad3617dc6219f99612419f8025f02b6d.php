

<?php $__env->startSection('title', 'Visualización Avanzada de Datos - Delitos La Paz'); ?>
<?php $__env->startSection('content_header'); ?>
    <h1>
        <i class="fas fa-chart-bar text-green"></i>
        Visualización Avanzada de Datos - Análisis Predictivo
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
        <!-- Panel de control y filtros -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-filter"></i>
                            Panel de Control de Visualización
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tipo de Visualización:</label>
                                    <select class="form-control" id="tipoVisualizacion">
                                        <option value="correlacion">Matriz de Correlación</option>
                                        <option value="heatmap">Mapa de Calor</option>
                                        <option value="scatter">Diagrama de Dispersión</option>
                                        <option value="regression">Línea de Regresión</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Variable X:</label>
                                    <select class="form-control" id="variableX">
                                        <option value="edad">Edad</option>
                                        <option value="zona">Zona</option>
                                        <option value="tipo">Tipo de Delito</option>
                                        <option value="mes">Mes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Variable Y:</label>
                                    <select class="form-control" id="variableY">
                                        <option value="frecuencia">Frecuencia</option>
                                        <option value="edad">Edad</option>
                                        <option value="reincidencia">Reincidencia</option>
                                        <option value="violencia">Nivel de Violencia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-primary btn-block" onclick="actualizarVisualizacion()">
                                        <i class="fas fa-sync"></i> Actualizar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Métricas del modelo de regresión -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="info-box bg-gradient-info">
                    <span class="info-box-icon"><i class="fas fa-percentage"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Coeficiente R²</span>                        <span class="info-box-number" id="r2Score">0.856</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 85.6%"></div>
                        </div>
                        <span class="progress-description">Bondad de ajuste del modelo</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-gradient-success">
                    <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Error RMSE</span>
                        <span class="info-box-number" id="rmseValue">2.45</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                        <span class="progress-description">Precisión de predicción</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-gradient-warning">
                    <span class="info-box-icon"><i class="fas fa-calculator"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Error MAE</span>
                        <span class="info-box-number" id="maeValue">1.87</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 78%"></div>
                        </div>
                        <span class="progress-description">Error absoluto medio</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-gradient-danger">
                    <span class="info-box-icon"><i class="fas fa-brain"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Precisión Modelo</span>
                        <span class="info-box-number" id="modelAccuracy">87.2%</span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 87.2%"></div>
                        </div>
                        <span class="progress-description">Efectividad predictiva</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visualizaciones avanzadas -->
        <div class="row">
            <!-- Matriz de correlación -->
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-th"></i>
                            Matriz de Correlación de Variables
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="correlationChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            <!-- Importancia de características -->
            <div class="col-md-6">
                <div class="card card-purple">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-ranking-star"></i>
                            Importancia de Características
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="featureImportanceChart" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Predicciones vs valores reales -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-crosshairs"></i>
                            Comparación: Valores Reales vs Predicciones
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="predictionChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Análisis de residuos -->
            <div class="col-md-4">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-area"></i>
                            Distribución de Residuos
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="residualsChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Análisis temporal avanzado -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clock"></i>
                            Análisis Temporal con Tendencias y Predicciones
                        </h3>
                        <div class="card-tools">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-light btn-sm" onclick="cambiarPeriodo('mensual')">Mensual</button>
                                <button type="button" class="btn btn-outline-light btn-sm" onclick="cambiarPeriodo('trimestral')">Trimestral</button>
                                <button type="button" class="btn btn-outline-light btn-sm" onclick="cambiarPeriodo('anual')">Anual</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="timeSeriesChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

       
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .info-box-number {
            font-size: 1.8rem;
            font-weight: bold;
        }
        .card-tools .btn-group .btn {
            border: 1px solid rgba(255,255,255,0.3);
        }
        .alert h6 {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .progress-description {
            font-size: 0.875rem;
            color: rgba(255,255,255,0.8);
        }
        canvas {
            max-height: 400px;
        }
        .list-unstyled li {
            padding: 0.25rem 0;
        }
        .btn-block {
            margin-bottom: 0.5rem;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if(!isset($error)): ?>
            // Datos simulados para visualización avanzada
            const correlationData = {
                labels: ['Edad', 'RiesgoSocial', 'AñosAntecedentes', 'VecesCapturado', 'IngresoMensualEstimado'],
                datasets: [{
                    label: 'Correlación',
                    data: [
                        [1.0, 0.23, 0.15, 0.45, 0.32],
                        [0.23, 1.0, 0.67, 0.56, 0.41],
                        [0.15, 0.67, 1.0, 0.78, 0.25],
                        [0.45, 0.56, 0.78, 1.0, 0.38],
                        [0.32, 0.41, 0.25, 0.38, 1.0]
                    ],
                    backgroundColor: function(context) {
                        const value = context.raw;
                        return value > 0.5 ? 'rgba(255, 99, 132, 0.8)' :
                               value > 0 ? 'rgba(255, 205, 86, 0.8)' :
                               'rgba(54, 162, 235, 0.8)';
                    }
                }]
            };

            // Importancia de características
            const featureImportanceData = {
                labels: ['AñosAntecedentes', 'RiesgoSocial', 'TipoDelito_encoded', 'Zona_encoded', 'Edad', 'SexoInvolucrado_encoded', 'NivelEducacion_encoded'],
                datasets: [{
                    label: 'Importancia',
                    data: [0.31, 0.25, 0.15, 0.12, 0.09, 0.05, 0.03],
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#FF6384'
                    ]
                }]
            };

            // Crear gráficas
            createCorrelationChart();
            createFeatureImportanceChart();
            createPredictionChart();
            createResidualsChart();
            createTimeSeriesChart();

            function createCorrelationChart() {
                const ctx = document.getElementById('correlationChart').getContext('2d');
                new Chart(ctx, {
                    type: 'scatter',
                    data: {
                        datasets: [{
                            label: 'Correlación Variables',
                            data: [
                                {x: 1, y: 1, v: 1.0},
                                {x: 1, y: 2, v: 0.23},
                                {x: 1, y: 3, v: -0.15},
                                {x: 2, y: 1, v: 0.23},
                                {x: 2, y: 2, v: 1.0},
                                {x: 2, y: 3, v: 0.67}
                            ],
                            backgroundColor: function(context) {
                                const value = context.raw.v;
                                if (value > 0.5) return 'rgba(220, 53, 69, 0.8)';
                                if (value > 0) return 'rgba(255, 193, 7, 0.8)';
                                return 'rgba(40, 167, 69, 0.8)';
                            },
                            pointRadius: 15
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: { 
                                type: 'linear',
                                position: 'bottom',
                                min: 0.5,
                                max: 3.5,
                                ticks: {
                                    callback: function(value) {
                                        const labels = ['', 'Edad', 'Zona', 'Tipo'];
                                        return labels[value];
                                    }
                                }
                            },
                            y: {
                                min: 0.5,
                                max: 3.5,
                                ticks: {
                                    callback: function(value) {
                                        const labels = ['', 'Edad', 'Zona', 'Tipo'];
                                        return labels[value];
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function createFeatureImportanceChart() {
                const ctx = document.getElementById('featureImportanceChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: featureImportanceData,
                    options: {
                        responsive: true,
                        indexAxis: 'y',
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 0.3
                            }
                        }
                    }
                });
            }

            function createPredictionChart() {
                const ctx = document.getElementById('predictionChart').getContext('2d');
                // Generar datos simulados para predicciones vs reales
                const realData = Array.from({length: 50}, () => Math.random() * 10);
                const predData = realData.map(val => val + (Math.random() - 0.5) * 2);
                
                new Chart(ctx, {
                    type: 'scatter',
                    data: {
                        datasets: [{
                            label: 'Predicciones vs Reales',
                            data: realData.map((real, i) => ({x: real, y: predData[i]})),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)'
                        }, {
                            label: 'Línea Perfecta',
                            data: [{x: 0, y: 0}, {x: 10, y: 10}],
                            type: 'line',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'transparent',
                            pointRadius: 0,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: { 
                                title: { display: true, text: 'Valores Reales' }
                            },
                            y: { 
                                title: { display: true, text: 'Predicciones' }
                            }
                        }
                    }
                });
            }

            function createResidualsChart() {
                const ctx = document.getElementById('residualsChart').getContext('2d');
                const residuals = Array.from({length: 100}, () => (Math.random() - 0.5) * 4);
                
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: Array.from({length: 20}, (_, i) => (i-10) * 0.5),
                        datasets: [{
                            label: 'Frecuencia',
                            data: Array.from({length: 20}, (_, i) => {
                                const bin = (i-10) * 0.5;
                                return residuals.filter(r => r >= bin && r < bin + 0.5).length;
                            }),
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            }

            function createTimeSeriesChart() {
                const ctx = document.getElementById('timeSeriesChart').getContext('2d');
                const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                const datos = [45, 52, 48, 61, 58, 67, 72, 69, 65, 59, 54, 47];
                const predicciones = [47, 53, 50, 63, 60, 69, 74, 71, 67, 61, 56, 49];
                
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: meses,
                        datasets: [{
                            label: 'Datos Históricos',
                            data: datos,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.1)',
                            tension: 0.4,
                            fill: true
                        }, {
                            label: 'Predicciones',
                            data: predicciones,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'transparent',
                            borderDash: [5, 5],
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            }

            // Funciones de interactividad
            function actualizarVisualizacion() {
                const tipo = document.getElementById('tipoVisualizacion').value;
                const varX = document.getElementById('variableX').value;
                const varY = document.getElementById('variableY').value;
                
                Swal.fire({
                    title: 'Actualizando...',
                    text: `Procesando visualización ${tipo} con variables ${varX} vs ${varY}`,
                    icon: 'info',
                    timer: 2000,
                    showConfirmButton: false
                });
            }

            function cambiarPeriodo(periodo) {
                Swal.fire({
                    title: 'Cambiando período',
                    text: `Mostrando datos ${periodo}`,
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                });
            }

            function exportarPDF() {
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

            function exportarGraficas() {
                Swal.fire({
                    title: 'Exportando Gráficas',
                    text: 'Generando imágenes PNG de todas las visualizaciones...',
                    icon: 'info',
                    timer: 3000,
                    showConfirmButton: false
                });
            }

            function exportarModelo() {
                Swal.fire({
                    title: 'Exportar Modelo',
                    text: 'Guardando modelo predictivo para uso futuro...',
                    icon: 'info',
                    timer: 3000,
                    showConfirmButton: false
                });
            }
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\integrador\resources\views/analisis-regresion/visualizacion.blade.php ENDPATH**/ ?>