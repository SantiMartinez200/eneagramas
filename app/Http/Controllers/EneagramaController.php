<?php

namespace App\Http\Controllers;

use App\Models\Eneagrama;
use App\Models\EneagramaBase;
use App\Models\EneagramaUsuario;
use App\Models\EneagramaUsuarioPregunta;
use App\Http\Requests\StoreEneagramaRequest;
use App\Http\Requests\UpdateEneagramaRequest;
use App\Models\EneagramaUsuarioFrase;
use App\Models\EneagramaUsuarioVerbo;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;

class EneagramaController extends Controller
{
    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     $baseId = 1; //harcode
    //     $base = EneagramaBase::with('preguntas')->findOrFail($baseId);
    //     return view('eneagramas.create', compact($base)); //llevar base a la vista
    // }


    /**
    * @param $baseId *HARCODE* identificador de base ya que no hay ABM de bases
    */

    public function crearDesdeBase(int $baseId = 1)
    {
        try {
            $user = auth()->user();
            $userId = $user->id;

            $resultado = DB::transaction(function () use ($userId, $baseId) {
                // 1. se obtiene la base completa
                $base = EneagramaBase::with('preguntas','frases','verbos')->findOrFail($baseId);
                
                // 2. crear el eneagrama de base primero 'cuz of relations
                $cuestionario = EneagramaUsuario::create([
                    'user_id' => $userId,
                    'base_id' => $base->id,
                ]);

                // 3. Clonar preguntas
                foreach ($base->preguntas as $pregunta) {
                    EneagramaUsuarioPregunta::create([
                        'eneagrama_usuario_id' => $cuestionario->id,
                        'pregunta' => $pregunta->pregunta,
                        'valor' => $pregunta->valor,
                    ]);
                }

                // 4. Clonar Frases
                foreach ($base->frases as $frase) {
                    EneagramaUsuarioFrase::create([
                        'eneagrama_usuario_id' => $cuestionario->id,
                        'frase' => $frase->frase,
                    ]);
                }

                // 4. Clonar Verbos
                foreach ($base->verbos as $verbo) {
                    EneagramaUsuarioVerbo::create([
                        'eneagrama_usuario_id' => $cuestionario->id,
                        'verbo' => $verbo->verbo,
                    ]);
                }
                 
            });

            return redirect()->back()
            ->with('success', 'Eneagrama creado exitosamente.'); 
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'No se encontró la base especificada.');
        } catch (Exception $e) {
            // Error general en la transacción
            return redirect()->back()
            ->with('error', 'Ocurrió un error al crear el cuestionario: ' . $e->getMessage());
        }
        Log::info('Resultado transacción Eneagrama', ['resultado' => $resultado]);

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
     * Misma función que form solo que trae datos para reloadListado() del front para las preguntas.
     * Consulta más liviana.
     */
    public function listPreguntas(){
        $user = auth()->user();
        $userId = $user->id;
        $UsuarioConEneagrama = User::with([
            'eneagrama' => function($q) {
                $q->with(['preguntas' => function($q2) {
                    $q2->orderBy('created_at', 'DESC');
                }]);
            },
        ])
        ->where('id', $userId)
        ->whereHas('eneagrama')
        ->orderBy('created_at','DESC')
        ->first();

       return response()->json($UsuarioConEneagrama);

    }

    /**
     * Mostrar el eneagrama que tiene asignado el usuario.
     * Se pasa como parámetro el usuario logeado.
     * Retorna una vista con los datos del eneagrama o incita a crear un eneagrama caso contrario.
     */
    public function form()
    {
        $user = auth()->user();
        $userId = $user->id;
        $UsuarioConEneagrama = User::with([
            'eneagrama' => function($q) {
                $q->with(['preguntas' => function($q2) {
                    $q2->orderBy('created_at', 'DESC');
                }]);
            },
            'eneagrama.frases',
            'eneagrama.verbos'
        ])
        ->where('id', $userId)
        ->whereHas('eneagrama')
        ->orderBy('created_at','DESC')

        ->first();
        
        return view('eneagramas.form', compact('UsuarioConEneagrama'));
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
