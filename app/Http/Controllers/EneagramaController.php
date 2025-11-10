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
use Illuminate\Http\Request;

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

            return redirect()->route('eneagramas.form', ['seccion' => 'preguntas'])->with('success', 'Eneagrama creado exitosamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'No se encontró la base especificada.');
        } catch (Exception $e) {
            // Error general en la transacción
            Log::warning($e->getMessage() . "   <- Error al crear cuestionario eneagrama de usuario");
            return redirect()->back()->with('error', 'Ocurrió un error al crear el cuestionario');
        }
        Log::notice('Resultado transacción Eneagrama', ['resultado' => $resultado]);

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
   public function listPreguntas() {
    $user = auth()->user();

    $UsuarioConEneagrama = User::with([
        'eneagrama' => function($q) {
            $q->with(['preguntas' => function($q2) {
                $q2->orderBy('created_at', 'DESC')->paginate(10);
            }]);
        },
    ])
    ->where('id', $user->id)
    ->whereHas('eneagrama')
    ->first();

    return response()->json($UsuarioConEneagrama);
}

public function listFrases() {
    $user = auth()->user();

    $UsuarioConEneagrama = User::with([
        'eneagrama' => function($q) {
            $q->with(['frases' => function($q2) {
                $q2->orderBy('created_at', 'DESC')->paginate(10);
            }]);
        },
    ])
    ->where('id', $user->id)
    ->whereHas('eneagrama')
    ->first();

    return response()->json($UsuarioConEneagrama);
}

public function listVerbos() {
    $user = auth()->user();

    $UsuarioConEneagrama = User::with([
        'eneagrama' => function($q) {
            $q->with(['verbos' => function($q2) {
                $q2->orderBy('created_at', 'DESC')->paginate(10);
            }]);
        },
    ])
    ->where('id', $user->id)
    ->whereHas('eneagrama')
    ->first();

    return response()->json($UsuarioConEneagrama);
}

    /**
     * Mostrar el eneagrama que tiene asignado el usuario.
     * Se pasa como parámetro el usuario logeado.
     * Retorna una vista con los datos del eneagrama o incita a crear un eneagrama caso contrario.
     */

    public function formSimple(){
         return view('eneagramas.formularioSimple');
    }

    public function form(Request $request, $seccion = 'preguntas')
    {
        $user = auth()->user();
        $eneagrama = $user->eneagrama;

        $preguntas = $eneagrama ? $eneagrama->preguntas()->paginate(10, ['*'], 'page_preguntas') : collect();
        $frases    = $eneagrama ? $eneagrama->frases()->paginate(10, ['*'], 'page_frases') : collect();
        $verbos    = $eneagrama ? $eneagrama->verbos()->paginate(10, ['*'], 'page_verbos') : collect();

        // Si la request viene por AJAX (cambio de tabla dinámico)
        if ($request->ajax()) {
            $tabla = $request->get('tabla') ?? $seccion;

            switch ($tabla) {
                case 'frases':
                    return view('eneagramas.partials.frases-table', compact('frases'))->render();

                case 'verbos':
                    return view('eneagramas.partials.verbos-table', compact('verbos'))->render();

                default:
                    return view('eneagramas.partials.preguntas-table', compact('preguntas'))->render();
            }
        }

        // Si la request NO es AJAX → renderiza la vista completa según la sección pedida
        switch ($seccion) {
            case 'frases':
                return view('eneagramas.frasesView', compact('user', 'eneagrama', 'frases'));
            case 'verbos':
                return view('eneagramas.verbosView', compact('user', 'eneagrama', 'verbos'));
            default:
                return view('eneagramas.preguntasView', compact('user', 'eneagrama', 'preguntas'));
        }
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
