<?php

namespace App\Http\Controllers;

use App\Models\Fletero;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FleteroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fleteros = Fletero::all();
        return response()->json($fleteros, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        Log::info('Llego la solicitud:', $request->all());
        
        // Validación de los datos del fletero
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'satelital' => 'nullable|string',
            'alta_aker' => 'nullable|boolean',
            'CUIT' => ['required', function ($attribute, $value, $fail) {
        if (!is_string($value) && !is_numeric($value)) {
            $fail('El campo CUIT debe ser un número o una cadena.');
        }
    }],
            'direccion' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'paut' => 'nullable|string|max:255',
            'permiso' => 'nullable|string|max:255',
            'vto_permiso' => 'nullable|date',
            'observation' => 'nullable|string',
            'transport_ids' => 'nullable|array', // Acepta un array de IDs de transporte
            'transport_ids.*' => 'exists:transports,id' // Cada ID de transporte debe existir
        ]);
        Log::info('Asi está Validate:', $validated);
        

        // Crear el fletero
        $fletero = Fletero::create($validated);

        // Asociar transportes al fletero
        if (isset($validated['transport_ids'])) {
            $fletero->transports()->sync($validated['transport_ids']); // Asocia múltiples transportes
        }

        return response()->json([
            'message' => 'Fletero creado y asociado exitosamente.',
            'data' => $fletero->load('transports') // Carga los transportes asociados para mostrar en la respuesta
        ], 201);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fletero = Fletero::findOrFail($id);
        return response()->json($fletero, 200);
    }

    // app/Http/Controllers/TransportController.php

    public function getFleteroDetails($transporteId)
    {
        // Encuentra el transporte con los fleteros asociados
        $transporte = Transport::with('fleteros')->find($transporteId);

        // Verifica si el transporte existe
        if (!$transporte) {
            return response()->json([
                'message' => 'Transporte no encontrado.'
            ], 404);
        }

        // Devuelve los fleteros asociados al transporte
        return response()->json([
            'message' => 'Detalles de los fleteros asociados al transporte.',
            'data' => $transporte->fleteros // Devuelve la colección de fleteros
        ], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'CUIT' => 'required|string|max:11',
            'logo' => 'nullable|string|max:255',
            'satelital' => 'nullable|string',
            'alta_aker' => 'nullable|boolean',
            'CUIT' => 'required|string|size:11',
            'direccion' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'paut' => 'nullable|string|max:255',
            'permiso' => 'nullable|string|max:255',
            'vto_permiso' => 'nullable|date',
            'observation' => 'nullable|string',
            // Agrega las validaciones necesarias para otros campos
        ]);

        $fletero = Fletero::findOrFail($id);
        $fletero->update($validated);

        return response()->json([
            'message' => 'Fletero actualizado exitosamente.',
            'data' => $fletero
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fletero = Fletero::findOrFail($id);
        $fletero->delete();  // Esto marcará el registro como eliminado (soft delete)

        return response()->json([
            'message' => 'Fletero marcado como eliminado exitosamente.'
        ], 200);
    }
}
