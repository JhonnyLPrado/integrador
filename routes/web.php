<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\OrdenDelDiaController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\AntecedenteController;
use App\Http\Controllers\ReparticionController;
use App\Http\Controllers\AprobacionController;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\AnalisisRegresionController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuarioController::class)->middleware('can:manage-users');
    
    // Rutas para órdenes del día (rutas específicas primero)
    Route::get('ordenes/search', [OrdenDelDiaController::class, 'search'])->name('ordenes.search')->middleware('can:manage-ordenes');
    Route::get('ordenes/estadisticas', [OrdenDelDiaController::class, 'estadisticas'])->name('ordenes.estadisticas')->middleware('can:manage-ordenes');
    Route::resource('ordenes', OrdenDelDiaController::class)->middleware('can:manage-ordenes');
    
    // Rutas para aprobaciones (rutas específicas primero)
    Route::put('aprobaciones/{aprobacion}/aprobar', [AprobacionController::class, 'aprobar'])->name('aprobaciones.aprobar')->middleware('can:manage-aprobaciones');
    Route::put('aprobaciones/{aprobacion}/rechazar', [AprobacionController::class, 'rechazar'])->name('aprobaciones.rechazar')->middleware('can:manage-aprobaciones');
    Route::resource('aprobaciones', AprobacionController::class)->parameters([
        'aprobaciones' => 'aprobacion'
    ])->middleware('can:manage-aprobaciones');
    
    Route::get('buscar-antecedentes', [RegistroController::class, 'buscarPorCi'])->name('registros.buscar-antecedentes')->middleware('can:manage-registros');
    
    // Rutas para backups de registros
    Route::get('registros/backups/listar', [RegistroController::class, 'listarBackups'])->name('registros.backups')->middleware('can:manage-registros');
    Route::post('registros/backups/generar', [RegistroController::class, 'generarBackup'])->name('registros.backup.generar')->middleware('can:manage-registros');
    Route::get('registros/backups/descargar/{filename}', [RegistroController::class, 'descargarBackup'])->name('registros.backup.descargar')->middleware('can:manage-registros');
    Route::delete('registros/backups/eliminar/{filename}', [RegistroController::class, 'eliminarBackup'])->name('registros.backup.eliminar')->middleware('can:manage-registros');

    Route::resource('registros', RegistroController::class)->middleware('can:manage-registros');
    
    // Rutas para antecedentes (CRUD completo)
    Route::get('antecedentes-buscar', [AntecedenteController::class, 'buscarPorCi'])->name('antecedentes.buscar')->middleware('can:manage-antecedentes');
    Route::get('antecedentes/{id}/pdf', [AntecedenteController::class, 'generarPdf'])->name('antecedentes.pdf')->middleware('can:manage-antecedentes');
    Route::post('antecedentes-pdf-multiple', [AntecedenteController::class, 'generarPdfMultiple'])->name('antecedentes.pdf-multiple')->middleware('can:manage-antecedentes');
    Route::resource('antecedentes', AntecedenteController::class)->middleware('can:manage-antecedentes');
    
    // Rutas para repartición de personal (rutas específicas primero)
    Route::get('reparticiones/disponibles', [ReparticionController::class, 'policiasDisponibles'])->name('reparticiones.disponibles')->middleware('can:manage-reparticiones');
    Route::get('reparticiones/filtrar', [ReparticionController::class, 'filtrar'])->name('reparticiones.filtrar')->middleware('can:manage-reparticiones');
    Route::get('reparticiones/pdf', [ReparticionController::class, 'generarPdf'])->name('reparticiones.pdf')->middleware('can:manage-reparticiones');
    
    // Rutas del resource con parámetro consistente
    Route::resource('reparticiones', ReparticionController::class)->parameters([
        'reparticiones' => 'reparticion'
    ])->middleware('can:manage-reparticiones');
    
    // Ruta toggle después del resource
    Route::patch('reparticiones/{reparticion}/toggle', [ReparticionController::class, 'toggleActivo'])->name('reparticiones.toggle')->middleware('can:manage-reparticiones');
    
    // Rutas para Firebase
    Route::get('firebase', [FirebaseController::class, 'index'])->name('firebase.index');
    Route::get('firebase/test-connection', [FirebaseController::class, 'testConnection'])->name('firebase.test');
    Route::get('firebase/realtime-map', [FirebaseController::class, 'realtimeMap'])->name('firebase.realtime-map');
    
    // Rutas para Análisis de Regresión
    Route::get('analisis-regresion', [AnalisisRegresionController::class, 'index'])->name('analisis-regresion.index')->middleware('can:view-reportes');
    Route::get('visualizacion-datos', [AnalisisRegresionController::class, 'visualizacion'])->name('analisis-regresion.visualizacion')->middleware('can:view-reportes');
    
    // API endpoints para análisis de regresión
    Route::get('api/analisis-regresion/datos', [AnalisisRegresionController::class, 'obtenerDatosAPI'])->name('api.analisis-regresion.datos')->middleware('can:view-reportes');
    Route::post('api/analisis-regresion/prediccion', [AnalisisRegresionController::class, 'calcularPrediccion'])->name('api.analisis-regresion.prediccion')->middleware('can:view-reportes');
    Route::post('api/analisis-regresion/exportar-pdf', [AnalisisRegresionController::class, 'exportarPDF'])->name('api.analisis-regresion.exportar-pdf')->middleware('can:view-reportes');
    Route::post('api/analisis-regresion/exportar-excel', [AnalisisRegresionController::class, 'exportarExcel'])->name('api.analisis-regresion.exportar-excel')->middleware('can:view-reportes');
});

Route::get('usuarios-inactivos', [UsuarioController::class, 'inactivos'])->name('usuarios.inactivos')->middleware('can:manage-users');
Route::post('usuarios/{id}/activar', [UsuarioController::class, 'activar'])->name('usuarios.activar')->middleware('can:manage-users');
Route::get('registros-reportes', [RegistroController::class, 'reportes'])->name('registros.reportes')->middleware('can:view-reportes');
