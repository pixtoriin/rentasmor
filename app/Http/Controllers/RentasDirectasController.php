<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;


class RentasDirectasController extends Controller
{

   
    public function vistaPrincipal(Request $request)
    {
         // Obtener ciudad desde la URL o usar "Mexico City" por defecto
         $city = $request->query('city', 'Cuernavaca');
        
         // Coordenadas de la ciudad (por ejemplo, Ciudad de México)
         // Si tienes una base de datos o un método para obtener las coordenadas dinámicamente, puedes hacerlo.
         $coordinates = [
             'Mexico City' => ['latitude' => 19.4326, 'longitude' => -99.1332],
             'Cuernavaca' => ['latitude' => 18.9241, 'longitude' => -99.2353],
         ];
     
         // Verifica si la ciudad existe en el array de coordenadas, si no, usa Ciudad de México por defecto
         $cityCoordinates = $coordinates[$city] ?? $coordinates['Mexico City'];
     
         // Construir la URL de la API de Open-Meteo con las coordenadas
         $url = "https://api.open-meteo.com/v1/forecast?latitude={$cityCoordinates['latitude']}&longitude={$cityCoordinates['longitude']}&current_weather=true&temperature_unit=celsius";
 
         // Realiza la solicitud a la API
         $response = Http::get($url);
         $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
         $dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
 
         $numero_dia = date('w'); // 0 (domingo) a 6 (sábado)
         $numero_mes = date('n') - 1;
         $año = date('Y');
 
         $fecha = (ucfirst($dias[$numero_dia]) . ', ' . date('d') . ' de ' . $meses[$numero_mes]. ' de ' . $año);
         
         
         // Verificar si la respuesta es exitosa
         if ($response->successful()) {
             // Obtener los datos del clima
             $weatherData = $response->json();
             
             // Extraer la temperatura y otros datos importantes
             $cityName = $city;
             $temperature = $weatherData['current_weather']['temperature']; // Obtener la temperatura actual
                 // Extraer el código del clima
             $weatherCode = $weatherData['current_weather']['weathercode']; 
 
             $weatherInfo = $this->getWeatherIcon($weatherCode);
             // Pasar los datos a la vista
             return view('vistaPrincipal.vistaPrincipal', compact('cityName', 'temperature', 'weatherInfo', 'fecha'));
         } else {
             // Si no se pudo obtener el clima
             return view('vistaPrincipal.vistaPrincipal', compact('cityName', 'temperature', 'weatherInfo', 'fecha'));
         }
    }
    public function getWeatherIcon($weatherCode)
    {
        switch ($weatherCode) {
            case 0: // Soleado
                return 'https://cdn-icons-png.flaticon.com/512/869/869869.png';
            case 1: // Mayormente soleado
                return 'https://cdn-icons-png.flaticon.com/512/10484/10484062.png';
            case 2: // Nublado
                return 'https://cdn-icons-png.flaticon.com/512/1163/1163624.png';
            case 3: // Lluvia ligera
                return 'https://cdn-icons-png.flaticon.com/512/4088/4088981.png';
            case 4: // Lluvia fuerte
                return 'https://cdn-icons-png.flaticon.com/512/4834/4834677.png';
            case 5: // Tormenta
                return 'https://cdn-icons-png.flaticon.com/512/1146/1146860.png';
            default:
                return 'https://cdn-icons-png.flaticon.com/512/1163/1163657.png';
        }
    }
    public function welcome(Request $request)
    {
        // Obtener ciudad desde la URL o usar "Mexico City" por defecto
        $city = $request->query('city', 'Cuernavaca');
       
        // Coordenadas de la ciudad (por ejemplo, Ciudad de México)
        // Si tienes una base de datos o un método para obtener las coordenadas dinámicamente, puedes hacerlo.
        $coordinates = [
            'Mexico City' => ['latitude' => 19.4326, 'longitude' => -99.1332],
            'Cuernavaca' => ['latitude' => 18.9241, 'longitude' => -99.2353],
        ];
    
        // Verifica si la ciudad existe en el array de coordenadas, si no, usa Ciudad de México por defecto
        $cityCoordinates = $coordinates[$city] ?? $coordinates['Mexico City'];
    
        // Construir la URL de la API de Open-Meteo con las coordenadas
        $url = "https://api.open-meteo.com/v1/forecast?latitude={$cityCoordinates['latitude']}&longitude={$cityCoordinates['longitude']}&current_weather=true&temperature_unit=celsius";

        // Realiza la solicitud a la API
        $response = Http::get($url);
        $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        $dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];

        $numero_dia = date('w'); // 0 (domingo) a 6 (sábado)
        $numero_mes = date('n') - 1;
        $año = date('Y');

        $fecha = (ucfirst($dias[$numero_dia]) . ', ' . date('d') . ' de ' . $meses[$numero_mes]. ' de ' . $año);
        
        
        // Verificar si la respuesta es exitosa
        if ($response->successful()) {
            // Obtener los datos del clima
            $weatherData = $response->json();
            
            // Extraer la temperatura y otros datos importantes
            $cityName = $city;
            $temperature = $weatherData['current_weather']['temperature']; // Obtener la temperatura actual
                // Extraer el código del clima
            $weatherCode = $weatherData['current_weather']['weathercode']; 

            $weatherInfo = $this->getWeatherIcon($weatherCode);
            // Pasar los datos a la vista
            return view('welcome', compact('cityName', 'temperature', 'weatherInfo', 'fecha'));
        } else {
            // Si no se pudo obtener el clima
            return view('welcome', compact('cityName', 'temperature', 'weatherInfo', 'fecha'));
        }
    }
    public function vistaDashboard(Request $request)
    {
        return view('vistaAdmin.vistaDashboard');
    }


}
