<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CollageMail;

class RentasDirectasController extends Controller
{

    public function rutas(Request $request)
    {
        
       return view('vistaPrincipal.rutas');  
    }
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

    public function getHistorias(Request $request)
    {
        $storyIndex = $request->input('storyIndex');
    
        $stories = [
            0 => [
                ["type" => "image", "src" => "https://picsum.photos/450/800"],
                ["type" => "image", "src" => "https://picsum.photos/450/800"],
                ["type" => "image", "src" => "https://picsum.photos/450/800"],
                ["type" => "image", "src" => "https://picsum.photos/450/800"],
            ],
            1 => [
                ["type" => "image", "src" => "https://picsum.photos/450/820"],
                ["type" => "video", "src" => "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4"],
            ],
            2 => [
                ["type" => "image", "src" => "https://picsum.photos/450/830"],
                ["type" => "video", "src" => "https://exit109.com/~dnn/clips/RW20seconds_1.mp4"],
                ["type" => "image", "src" => "https://picsum.photos/450/860"],
            ],
            3 => [
                ["type" => "image", "src" => "https://picsum.photos/450/840"],
                ["type" => "video", "src" => "https://www.learningcontainer.com/wp-content/uploads/2020/05/sample-mp4-file.mp4"],
                ["type" => "image", "src" => "https://picsum.photos/450/870"],
                ["type" => "image", "src" => "https://picsum.photos/450/880"],
            ],
            4 => [
                ["type" => "image", "src" => "https://picsum.photos/450/850"],
                ["type" => "video", "src" => "https://www.w3schools.com/html/mov_bbb.mp4"],
                ["type" => "image", "src" => "https://picsum.photos/450/890"],
                ["type" => "image", "src" => "https://picsum.photos/450/900"],
                ["type" => "image", "src" => "https://picsum.photos/450/910"],
            ]
        ];
    
        if (!isset($stories[$storyIndex])) {
            return Response::json(['error' => 'Historia no encontrada'], 404);
        }
    
        return Response::json($stories[$storyIndex]);
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


    public function enviarCorreo(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if (!empty($data['imagen'])) {
            $imagen_base64 = $data['imagen'];
            $imagen_base64 = str_replace('data:image/png;base64,', '', $imagen_base64);
            $imagen_base64 = str_replace(' ', '+', $imagen_base64);
            $imagen_binaria = base64_decode($imagen_base64);

            $nombreArchivo = 'collage_' . uniqid() . '.png';
            $rutaArchivo = 'public/imagenes/' . $nombreArchivo;

            Storage::put($rutaArchivo, $imagen_binaria);


            return response()->json(['message' => 'Collage enviado por correo con éxito']);
        }

        return response()->json(['message' => 'No se recibió imagen'], 400);
    }
}
