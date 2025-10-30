<?php

namespace App\Http\Controllers;

use App\Models\Eneagrama;
use App\Models\EneagramaBase;
use App\Models\EneagramaUsuario;
use App\Models\EneagramaUsuarioPregunta;
use App\Http\Requests\StoreEneagramaRequest;
use App\Http\Requests\UpdateEneagramaRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EneagramaController extends Controller
{
    public function crearDesdeBase(int $userId, int $baseId = 1)
    {
        return DB::transaction(function () use ($userId, $baseId) {
            // 1. Obtener la base con sus preguntas
            $base = EneagramaBase::with('preguntas')->findOrFail($baseId);

            // 2. Crear cuestionario para el usuario
            $cuestionario = EneagramaUsuario::create([
                'user_id' => $userId,
                'base_id' => $base->id,
                'nombre' => 'Mi cuestionario Eneagrama',
            ]);

            // 3. Clonar preguntas
            foreach ($base->preguntas as $pregunta) {
                EneagramaUsuarioPregunta::create([
                    'eneagrama_usuario_id' => $cuestionario->id,
                    'pregunta' => $pregunta->pregunta,
                    'tipo' => $pregunta->tipo,
                ]);
            }

            return $cuestionario;
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEneagramaRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(Eneagrama $eneagrama)
    {
        //
    }

    /**
     * Mostrar el eneagrama que tiene asignado el usuario.
     * Se pasa como parámetro el usuario logeado.
     * Retorna una vista con los datos del eneagrama o incita a crear un eneagrama caso contrario.
     */
    public function form()
    {
        $user = auth()->user();
        return view('eneagramas.form', compact('user'));
    }

    /**
     * Display the specified resource.
     */
    public function list()
    {
        return view('eneagramas.list');
    }

    /**
    * Obtener la base que toma el sistema para crear todos los formularios
    */
    public function getBase(){
        //$eneagrama = Eneagrama::where('base', 1)->first();
    }

    
    /**
    * Setear la base que toma el sistema para crear todos los formularios
    */
    public function setBase(){

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eneagrama $eneagrama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEneagramaRequest $request, Eneagrama $eneagrama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eneagrama $eneagrama)
    {
        //
    }
}
