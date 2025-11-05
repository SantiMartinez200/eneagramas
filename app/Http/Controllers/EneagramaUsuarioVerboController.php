<?php

namespace App\Http\Controllers;

use App\Http\Requests\EneagramaUsuarioVerboRequest;
use App\Models\EneagramaUsuarioVerbo;
use Illuminate\Http\Request;

class EneagramaUsuarioVerboController extends Controller
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

    
    //funcion genérica que valida si el registro pertenece al usuario que lo está realizando.
    public function esDeEsteUsuario($eneagramaUsuarioId)
    {
        $userId = auth()->id();
    
        $existe = EneagramaUsuarioVerbo::whereHas('cuestionario', function ($query) use ($userId, $eneagramaUsuarioId) {
                $query->where('user_id', $userId)
                      ->where('id', $eneagramaUsuarioId);
            })
            ->exists(); // devuelve true/false directamente
        return $existe;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EneagramaUsuarioVerboRequest $request)
    {
        // El Request ya valida automáticamente según las reglas definidas
        // Recuperamos los datos validados:
        $validated = $request->validated();

        //validar que el eneagrama sea de este usuario (evita poner id's de otros registros)
        if (! $this->esDeEsteUsuario($validated['eneagrama_usuario_id'])) {
            return response()->json([
                'title' => 'Acceso denegado',
                'message' => 'El formulario no pertenece a tu usuario.'
            ], 403);
        }

        // Crear el registro en la base de datos
        $verbo = EneagramaUsuarioVerbo::create([
            'verbo' => $validated['nuevo_verbo'],
            'eneagrama_usuario_id' => $validated['eneagrama_usuario_id'], // o $request->user()->id si corresponde
        ]);

        // Retornar respuesta JSON para fetch
        return response()->json([
            'success' => true,
            'verbo' => $verbo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(EneagramaUsuarioVerbo $eneagrama)
    {
        //
    }
}
