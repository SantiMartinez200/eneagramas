<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EneagramaUsuarioPregunta;
use App\Http\Requests\EneagramaUsuarioPreguntaRequest;

class EneagramaUsuarioPreguntaController extends Controller
{
    public function create(){

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(EneagramaUsuarioPreguntaRequest $request)
    {
         // El Request ya valida automáticamente según las reglas definidas
        // Recuperamos los datos validados:
        $validated = $request->validated();

        // Crear el registro en la base de datos
        $pregunta = EneagramaUsuarioPregunta::create([
            'nueva_pregunta' => $validated['nueva_pregunta'],
            'eneagrama_usuario_id' => $userId, // o $request->user()->id si corresponde
        ]);

        // Retornar respuesta JSON para fetch
        return response()->json([
            'success' => true,
            'pregunta' => $pregunta,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(EneagramaUsuarioPregunta $eneagrama)
    {
        //
    }
}
