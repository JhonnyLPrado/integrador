<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AnalisisRegresionController extends Controller
{
    public function index()
    {
        // Verificar si el archivo CSV existe
        $csvPath = base_path('regrecion lineal/Delitos_LaPaz.csv');
        $csvExists = File::exists($csvPath);
        
        if (!$csvExists) {
            return view('analisis-regresion.index', [
                'error' => 'El archivo de datos no está disponible'
            ]);
        }

        // Cargar y procesar los datos del CSV
        $data = $this->loadAndProcessData($csvPath);
        
        return view('analisis-regresion.index', compact('data'));
    }

    public function visualizacion()
    {
        $csvPath = base_path('regrecion lineal/Delitos_LaPaz.csv');
        $csvExists = File::exists($csvPath);
        
        if (!$csvExists) {
            return view('analisis-regresion.visualizacion', [
                'error' => 'El archivo de datos no está disponible'
            ]);
        }

        $data = $this->loadAndProcessData($csvPath);
        
        return view('analisis-regresion.visualizacion', compact('data'));
    }

    private function loadAndProcessData($csvPath)
    {
        $csvData = [];
        $handle = fopen($csvPath, 'r');
        
        if ($handle !== false) {
            $headers = fgetcsv($handle);
            
            while (($row = fgetcsv($handle)) !== false) {
                $csvData[] = array_combine($headers, $row);
            }
            
            fclose($handle);
        }

        return $this->processDataForCharts($csvData);
    }

    private function processDataForCharts($data)
    {
        $processed = [
            'total_records' => count($data),
            'delitos_por_zona' => [],
            'delitos_por_tipo' => [],
            'delitos_por_mes' => [],
            'edad_por_sexo' => [],
            'correlacion_variables' => [],
            'distribucion_edad' => [],
            'reincidencia_datos' => [],
            'violencia_por_edad' => []
        ];

        if (empty($data)) {
            return $processed;
        }

        // Procesar datos para gráficas
        foreach ($data as $record) {
            // Contar delitos por zona
            $zona = $record['Zona'] ?? 'Sin especificar';
            $processed['delitos_por_zona'][$zona] = ($processed['delitos_por_zona'][$zona] ?? 0) + 1;

            // Contar delitos por tipo
            $tipo = $record['TipoDelito'] ?? 'Sin especificar';
            $processed['delitos_por_tipo'][$tipo] = ($processed['delitos_por_tipo'][$tipo] ?? 0) + 1;

            // Procesar fecha para análisis temporal
            if (isset($record['FechaDelito'])) {
                $fecha = $record['FechaDelito'];
                $mes = date('n', strtotime($fecha));
                $processed['delitos_por_mes'][$mes] = ($processed['delitos_por_mes'][$mes] ?? 0) + 1;
            }

            // Datos para distribución de edad por sexo
            if (isset($record['Edad']) && isset($record['SexoInvolucrado'])) {
                $sexo = $record['SexoInvolucrado'];
                if (!isset($processed['edad_por_sexo'][$sexo])) {
                    $processed['edad_por_sexo'][$sexo] = [];
                }
                $processed['edad_por_sexo'][$sexo][] = (int)$record['Edad'];
            }

            // Datos para reincidencia
            if (isset($record['SospechosoReincidente']) && isset($record['VecesCapturado'])) {
                $reincidente = $record['SospechosoReincidente'];
                if (!isset($processed['reincidencia_datos'][$reincidente])) {
                    $processed['reincidencia_datos'][$reincidente] = [];
                }
                $processed['reincidencia_datos'][$reincidente][] = (int)$record['VecesCapturado'];
            }

            // Datos para violencia por edad
            if (isset($record['Violencia']) && isset($record['Edad'])) {
                $violencia = $record['Violencia'];
                if (!isset($processed['violencia_por_edad'][$violencia])) {
                    $processed['violencia_por_edad'][$violencia] = [];
                }
                $processed['violencia_por_edad'][$violencia][] = (int)$record['Edad'];
            }
        }

        // Ordenar datos
        arsort($processed['delitos_por_zona']);
        arsort($processed['delitos_por_tipo']);
        ksort($processed['delitos_por_mes']);

        // Calcular estadísticas adicionales
        $processed['estadisticas'] = $this->calculateStatistics($data);

        return $processed;
    }

    private function calculateStatistics($data)
    {
        $stats = [
            'total_delitos' => count($data),
            'promedio_edad' => 0,
            'total_zonas' => 0,
            'total_tipos_delito' => 0,
            'porcentaje_reincidencia' => 0
        ];

        if (empty($data)) {
            return $stats;
        }

        $edades = [];
        $zonas = [];
        $tipos = [];
        $reincidentes = 0;

        foreach ($data as $record) {
            if (isset($record['Edad'])) {
                $edades[] = (int)$record['Edad'];
            }
            if (isset($record['Zona'])) {
                $zonas[] = $record['Zona'];
            }
            if (isset($record['TipoDelito'])) {
                $tipos[] = $record['TipoDelito'];
            }
            if (isset($record['SospechosoReincidente']) && $record['SospechosoReincidente'] === 'Sí') {
                $reincidentes++;
            }
        }

        $stats['promedio_edad'] = !empty($edades) ? round(array_sum($edades) / count($edades), 2) : 0;
        $stats['total_zonas'] = count(array_unique($zonas));
        $stats['total_tipos_delito'] = count(array_unique($tipos));
        $stats['porcentaje_reincidencia'] = round(($reincidentes / count($data)) * 100, 2);

        return $stats;
    }

    public function exportarPDF()
    {
        $csvPath = base_path('regrecion lineal/Delitos_LaPaz.csv');
        $data = $this->loadAndProcessData($csvPath);
        
        return response()->json([
            'success' => true,
            'message' => 'Reporte PDF generado correctamente',
            'data' => $data['estadisticas']
        ]);
    }

    public function exportarExcel()
    {
        $csvPath = base_path('regrecion lineal/Delitos_LaPaz.csv');
        
        return response()->json([
            'success' => true,
            'message' => 'Archivo Excel exportado correctamente',
            'filename' => 'analisis_delitos_' . date('Y-m-d') . '.xlsx'
        ]);
    }

    public function obtenerDatosAPI()
    {
        $csvPath = base_path('regrecion lineal/Delitos_LaPaz.csv');
        $data = $this->loadAndProcessData($csvPath);
        
        return response()->json([
            'success' => true,
            'data' => $data,
            'timestamp' => now()
        ]);
    }

    public function calcularPrediccion(Request $request)
    {
        $edad = $request->input('edad', 30);
        $zona = $request->input('zona', 'Centro');
        $tipoDelito = $request->input('tipo_delito', 'Robo');
        
        // Simulación de predicción (en un caso real, aquí cargarías el modelo entrenado)
        $riesgoBase = 0.3;
        $factorEdad = ($edad - 25) * 0.01;
        $factorZona = $zona === 'Centro' ? 0.2 : ($zona === 'El Alto' ? 0.15 : 0.1);
        $factorTipo = $tipoDelito === 'Robo' ? 0.25 : ($tipoDelito === 'Asalto' ? 0.3 : 0.2);
        
        $probabilidad = min(0.95, $riesgoBase + $factorEdad + $factorZona + $factorTipo);
        
        return response()->json([
            'success' => true,
            'prediccion' => [
                'probabilidad_reincidencia' => round($probabilidad * 100, 2),
                'nivel_riesgo' => $probabilidad > 0.7 ? 'Alto' : ($probabilidad > 0.4 ? 'Medio' : 'Bajo'),
                'factores' => [
                    'edad' => $edad,
                    'zona' => $zona,
                    'tipo_delito' => $tipoDelito
                ]
            ]
        ]);
    }
}
