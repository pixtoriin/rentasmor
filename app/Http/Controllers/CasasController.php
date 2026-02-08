<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CasasController extends Controller
{
    // Constante para el nombre de la tabla
    private const TABLA_CASAS = 'rd_casa';
    private const TABLA_IMAGENES = 'rd_imagenes';

    /**
     * Crear una nueva casa
     */
    public function nuevaCasa(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'casa_nombre' => 'required|string|max:100',
            'casa_propietario' => 'required|string|max:100',
            'casa_direccion' => 'required|string|max:255',
            'casa_municipio' => 'required|string|max:100',
            'casa_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'casa_precioxnoche' => 'required|numeric|min:0',
            'casa_descripcion' => 'required|string',
            'casa_telefono' => 'required|string|max:20',
            'casa_activo' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Subir la imagen
            $logoUrl = $this->subirLogo($request->file('casa_logo'));

            // Insertar en la base de datos
            $idCasa = DB::table(self::TABLA_CASAS)->insertGetId([
                'casa_nombre' => $request->casa_nombre,
                'casa_propietario' => $request->casa_propietario,
                'casa_direccion' => $request->casa_direccion,
                'casa_municipio' => $request->casa_municipio,
                'casa_logo' => $logoUrl,
                'casa_precioxnoche' => $request->casa_precioxnoche,
                'casa_descripcion' => $request->casa_descripcion,
                'casa_telefono' => $request->casa_telefono,
                'casa_activo' => $request->boolean('casa_activo'),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Casa creada exitosamente',
                'id' => $idCasa
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            // Eliminar la imagen si hubo error después de subirla
            if (isset($logoUrl)) {
                $this->eliminarLogo($logoUrl);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error al crear la casa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Listar todas las casas
     */
    public function buscarCasas()
    {
        try {
            $casas = DB::table(self::TABLA_CASAS)
                        ->orderBy('casa_nombre')
                        ->get();

            return response()->json([
                'success' => true,
                'casas' => $casas
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las casas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mostrar una casa específica
     */
    public function mostrarCasa(Request $request )
    {
        
        try {
            $casa = DB::table(self::TABLA_CASAS)
                        ->where('casa_id', $request->casa_id)
                        ->first();

            if (!$casa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Casa no encontrada'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'casa' => $casa
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener la casa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar una casa existente
     */
    public function actualizarCasa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'casa_nombre' => 'required|string|max:100',
            'casa_propietario' => 'required|string|max:100',
            'casa_direccion' => 'required|string|max:255',
            'casa_municipio' => 'required|string|max:100',
            'casa_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'casa_precioxnoche' => 'required|numeric|min:0',
            'casa_descripcion' => 'required|string',
            'casa_telefono' => 'required|string|max:20',
            'casa_activo' => 'sometimes|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Obtener la casa actual
        $casaActual = DB::table(self::TABLA_CASAS)
                        ->where('casa_id', $request->casa_id)
                        ->first();

        if (!$casaActual) {
            return response()->json([
                'success' => false,
                'message' => 'Casa no encontrada'
            ], 404);
        }

        DB::beginTransaction();
        try {
            $updateData = [
                'casa_nombre' => $request->casa_nombre,
                'casa_propietario' => $request->casa_propietario,
                'casa_direccion' => $request->casa_direccion,
                'casa_municipio' => $request->casa_municipio,
                'casa_precioxnoche' => $request->casa_precioxnoche,
                'casa_descripcion' => $request->casa_descripcion,
                'casa_telefono' => $request->casa_telefono,
                'casa_activo' => $request->boolean('casa_activo'),
            ];

            // Manejar la imagen del logo si se subió una nueva
            if ($request->hasFile('casa_logo')) {
                // Eliminar el logo anterior si existe
                $this->eliminarLogo($casaActual->casa_logo);
                
                // Guardar el nuevo logo
                $updateData['casa_logo'] = $this->subirLogo($request->file('casa_logo'));
            }

            // Actualizar en la base de datos
            $affected = DB::table(self::TABLA_CASAS)
                        ->where('casa_id', $request->casa_id)
                        ->update($updateData);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Casa actualizada correctamente',
                'casa' => array_merge((array)$casaActual, $updateData)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la casa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Método privado para subir logos
     */
    private function subirLogo($file)
    {
        if (!$file->isValid()) {
            throw new \Exception('El archivo no es válido');
        }
        $path = $file->store('casas/logos', 'public');
        $url = asset(Storage::url($path));

        return $url;
    }

    /**
     * Método privado para eliminar logos
     */
    private function eliminarLogo($url)
    {
        if ($url) {
            $path = str_replace('/storage', 'public', $url);
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
        }
    }

    public function obtenerImagenes(Request $request)
    {
        

        $imagenes = DB::table(self::TABLA_IMAGENES)
            ->where('casa_id', $request->casa_id)
            ->where('img_activo', 1)
            ->get()
            ->map(function($imagen) {
                return [
                    'img_id' => $imagen->img_id,
                    'img_url' => $imagen->img_nombre,
                ];
            });

        return response()->json([
            'imagenes' => $imagenes
        ]);
    }

    public function subirImagenes(Request $request)
    {
       

        $casa = DB::table('rd_casa')->where('casa_id', $request->casa_id)->first();
        $imagenesSubidas = [];

        foreach ($request->file('images') as $image) {
            $path = $image->store('casas/' . $casa->casa_id, 'public');
            $url = asset(Storage::url($path));

            $imgId = DB::table(self::TABLA_IMAGENES)->insertGetId([
                'casa_id' => $casa->casa_id,
                'img_nombre' => $url,
                'img_activo' => 1,
            ]);
            
            $imagen = DB::table(self::TABLA_IMAGENES)->where('img_id', $imgId)->first();
            $imagenesSubidas[] = $imagen;
        }

        return response()->json([
            'message' => 'Imágenes subidas correctamente',
            'count' => count($imagenesSubidas)
        ]);
    }

    public function eliminarImagen(Request $request)
    {
        $request->validate([
            'img_id' => 'required|exists:rd_imagenes,img_id'
        ]);

        $imagen = DB::table(self::TABLA_IMAGENES)->where('img_id', $request->img_id)->first();
        
        if ($imagen) {
            // Eliminar el archivo físico
            Storage::delete('public/' . $imagen->img_nombre);
            
            // Eliminar el registro de la base de datos
            DB::table(self::TABLA_IMAGENES)->where('img_id', $request->img_id)->delete();
        }

        return response()->json([
            'message' => 'Imagen eliminada correctamente'
        ]);
    }
}