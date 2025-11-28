<!-- ============================
     PARTE 1 — HTML COMPLETO
     ============================ -->

@extends('adminlte::page')

@section('title', 'Firebase Realtime Database - Mapa de Ubicaciones')

@section('content_header')
    <h1>
        <i class="fas fa-map-marker-alt text-primary"></i>
        Firebase Realtime Database - Mapa de Ubicaciones
    </h1>
@stop

@section('content')
<div class="row">

    <!-- =======================================
         PANEL IZQUIERDO (Estado + Lista)
         ======================================= -->
    <div class="col-md-4">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-database"></i> Control de Datos en Tiempo Real
                </h3>
            </div>

            <div class="card-body">

                <!-- Estado Firebase -->
                <div class="info-box bg-success mb-3">
                    <span class="info-box-icon"><i class="fas fa-wifi"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Estado Realtime DB</span>
                        <span class="info-box-number" id="realtime-status">Conectando...</span>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="row">
                    <div class="col-6">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-map-pin"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Ubicaciones</span>
                                <span class="info-box-number" id="total-locations">0</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Última Act.</span>
                                <span class="info-box-number" id="last-update">--</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lista de Ubicaciones -->
                <div class="mt-4">
                    <h5><i class="fas fa-list"></i> Ubicaciones Activas</h5>

                    <div id="locations-list"
                         class="list-group"
                         style="max-height: 300px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 0.375rem;">
                        <!-- Se llena dinámicamente -->
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- =======================================
         MAPA DERECHA
         ======================================= -->
    <div class="col-md-8">

        <div class="card card-success">
            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-globe"></i> Mapa en Tiempo Real
                    <small id="map-mode-indicator" class="badge badge-success ml-2">Última Ubicación</small>
                </h3>

                <!-- Botones -->
                <div class="card-tools">
                    <button type="button" class="btn btn-tool"
                            id="toggle-mode-btn"
                            onclick="toggleMapMode()"
                            title="Alternar entre última ubicación y todas">
                        <i class="fas fa-history"></i>
                    </button>

                    <button type="button" class="btn btn-tool"
                            onclick="centerMapToBolivia()">
                        <i class="fas fa-home"></i>
                    </button>

                    <button type="button" class="btn btn-tool"
                            onclick="toggleFullscreen()">
                        <i class="fas fa-expand"></i>
                    </button>
                </div>

            </div>

            <div class="card-body p-0">
                <div id="realtime-map" style="height: 600px; width: 100%;"></div>
            </div>
        </div>

    </div>

</div>

<!-- =======================================
     LOG DE ACTIVIDAD
     ======================================= -->
<div class="row mt-3">
    <div class="col-12">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-terminal"></i> Log de Actividad en Tiempo Real
                </h3>

                <div class="card-tools">
                    <button type="button"
                            class="btn btn-tool"
                            onclick="clearLog()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div id="activity-log"
                     style="height: 200px; overflow-y: auto; background: #1e1e1e; color: #00ff00;
                            font-family: 'Courier New', monospace; padding: 10px;">
                    <!-- Logs aquí -->
                </div>
            </div>

        </div>

    </div>
</div>

@stop
@section('css')
<style>

.log-success { color: #28a745 !important; }
.log-error   { color: #dc3545 !important; }
.log-warning { color: #ffc107 !important; }
.log-info    { color: #17a2b8 !important; }

#activity-log {
    border: 1px solid #ddd;
    border-radius: 4px;
}

.location-item {
    transition: all 0.3s ease;
}
.location-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.marker-info {
    max-width: 300px;
}

#realtime-map {
    border-radius: 0 0 0.375rem 0.375rem;
}

/* Pantalla completa */
.fullscreen-map {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    background: white;
}

/* Scroll lista de ubicaciones */
#locations-list {
    scrollbar-width: thin;
    scrollbar-color: #007bff #f1f1f1;
}

#locations-list::-webkit-scrollbar {
    width: 8px;
}
#locations-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}
#locations-list::-webkit-scrollbar-thumb {
    background: #007bff;
    border-radius: 4px;
}
#locations-list::-webkit-scrollbar-thumb:hover {
    background: #0056b3;
}

.locations-empty {
    text-align: center;
    padding: 20px;
    color: #6c757d;
    font-style: italic;
}

/* Indicador de modo */
#map-mode-indicator {
    font-size: 0.75rem;
    vertical-align: middle;
}

/* Botón de cambio de modo */
#toggle-mode-btn:hover {
    background-color: rgba(0, 123, 255, 0.1);
    border-radius: 0.375rem;
}

/* Efecto para última ubicación */
.location-item .badge-success {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%   { transform: scale(1); }
    50%  { transform: scale(1.05); }
    100% { transform: scale(1); }
}

</style>
@stop
@section('js')
@vite(['resources/js/app.js'])

<!-- Google Maps API -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApZs1RsAdo4vF99FvtN8Fqf5vbn0vYWG4&callback=initRealtimeMap&libraries=&v=weekly" async defer></script>

<script>
/* ---------------------------------------------
   VARIABLES GLOBALES
--------------------------------------------- */
let map;
let markers = [];
let realtimeListener = null;
let allLocationsData = null;
let showOnlyLastLocation = true;

/* ---------------------------------------------
   INICIALIZACIÓN DEL MAPA
--------------------------------------------- */
function initRealtimeMap() {
    const center = { lat: -16.5, lng: -68.1193 };

    map = new google.maps.Map(document.getElementById('realtime-map'), {
        center,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.HYBRID,
        streetViewControl: false,
        fullscreenControl: false
    });

    addLog("Mapa inicializado", "success");

    setTimeout(connectToRealtimeDB, 700);
}

/* ---------------------------------------------
   CONEXIÓN A REALTIME DATABASE
--------------------------------------------- */
async function connectToRealtimeDB() {
    addLog("Conectando con Firebase RTDB...", "info");

    if (!window.Firebase || !window.Firebase.realtimeDb) {
        addLog("Firebase no está cargado", "error");
        return;
    }

    const { ref, onValue, off } = await import("https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js");

    // ⚠ RUTA EXACTA DEL FLUTTER ACTUAL
    const dbRef = ref(window.Firebase.realtimeDb, "geolocation/device_1");

    // eliminar listeners anteriores
    if (realtimeListener) off(dbRef, "value", realtimeListener);

    realtimeListener = onValue(dbRef, (snapshot) => {
        const data = snapshot.val();
        allLocationsData = data;

        updateMap(data);
        updateList(data);
        updateStats(data);

        addLog("Datos recibidos del RTDB", "success");
    });
}

/* ---------------------------------------------
   SELECCIONAR ÚLTIMA UBICACIÓN
--------------------------------------------- */
function getLast(data) {
    if (!data) return null;
    return data;
}

/* ---------------------------------------------
   ACTUALIZAR MAPA
--------------------------------------------- */
function updateMap(data) {
    markers.forEach(m => m.setMap(null));
    markers = [];

    if (!data) return;

    const lat = parseFloat(data.lat);
    const lng = parseFloat(data.long || data.lng);

    if (!lat || !lng) return;

    const marker = new google.maps.Marker({
        map,
        position: { lat, lng },
        icon: {
            url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
            scaledSize: new google.maps.Size(40, 40)
        },
        title: "Ubicación actual"
    });

    markers.push(marker);

    map.setCenter({ lat, lng });
    map.setZoom(15);
}

/* ---------------------------------------------
   ACTUALIZAR LISTA
--------------------------------------------- */
function updateList(data) {
    const list = document.getElementById("locations-list");
    list.innerHTML = "";

    if (!data) {
        list.innerHTML = `<div class="list-group-item">Sin datos</div>`;
        return;
    }

    const fecha = data.updatedAt
        ? new Date(data.updatedAt).toLocaleString()
        : "Sin fecha";

    list.innerHTML = `
        <div class="list-group-item">
            <b>Lat:</b> ${data.lat}<br>
            <b>Lng:</b> ${data.long || data.lng}<br>
            <b>Fecha:</b> ${fecha}
        </div>
    `;
}

/* ---------------------------------------------
   ESTADÍSTICAS
--------------------------------------------- */
function updateStats(data) {
    document.getElementById("total-locations").textContent = data ? 1 : 0;
    document.getElementById("last-update").textContent = new Date().toLocaleTimeString();
}

/* ---------------------------------------------
   LOG
--------------------------------------------- */
function addLog(msg, type = "info") {
    const box = document.getElementById("activity-log");
    const t = new Date().toLocaleTimeString();
    box.innerHTML += `<div class="log-${type}">[${t}] ${msg}</div>`;
    box.scrollTop = box.scrollHeight;
}

function clearLog() {
    document.getElementById("activity-log").innerHTML = "";
}

window.initRealtimeMap = initRealtimeMap;
</script>
@stop
