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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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

            return DB::transaction(function () use ($userId, $baseId) {
                $base = EneagramaBase::with('preguntas')->findOrFail($baseId);

                // 2. Crear cuestionario para el usuario

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
            });

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'No se encontró la base especificada.');
        } catch (Exception $e) {
            // Error general en la transacción
            return redirect()->back()
            ->with('error', 'Ocurrió un error al crear el cuestionario: ' . $e->getMessage());
        }
        
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
     * Mostrar el eneagrama que tiene asignado el usuario.
     * Se pasa como parámetro el usuario logeado.
     * Retorna una vista con los datos del eneagrama o incita a crear un eneagrama caso contrario.
     */
    public function form()
    {
        $user = auth()->user();
        $userId = $user->id;
        $UsuarioConEneagrama = User::with('eneagrama')
            ->where('id', $userId)
            ->whereHas('eneagrama') // filtra solo si la relación existe
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
