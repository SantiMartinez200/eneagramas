<?php

namespace Database\Seeders;

use App\Models\EneagramaBase;
use App\Models\EneagramaFrase;
use App\Models\EneagramaPregunta;
use App\Models\EneagramaUsuario;
use App\Models\EneagramaVerbo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        EneagramaBase::create([
            'base' => 1,
        ]);

        $preguntas = [
            // Tipo 1 (Perfeccionista)
            ['Me esfuerzo por hacer las cosas correctamente, incluso en los pequeños detalles.', 1],
            ['Siento incomodidad cuando algo está fuera de lugar.', 1],
            ['Me resulta difícil relajarme si algo no está terminado.', 1],
            ['Tengo una voz interior que me dice constantemente cómo debería actuar.', 1],
            ['A menudo noto los errores antes que los aciertos.', 1],
            ['Siento la necesidad de mejorar lo que otros hacen.', 1],
            ['Evito mostrar enojo, pero internamente me irrito con facilidad.', 1],
            ['Creo que hay una forma correcta de hacer cada cosa.', 1],
            ['Cuando me equivoco, me cuesta perdonarme.', 1],
            ['Prefiero seguir las reglas antes que improvisar.', 1],

            // Tipo 2 (Servicial)
            ['Me preocupo sinceramente por las necesidades de los demás.', 2],
            ['Me siento valorado cuando puedo ser útil a otros.', 2],
            ['A veces ayudo sin que me lo pidan, solo para sentirme necesario.', 2],
            ['Me cuesta pedir ayuda, prefiero darla.', 2],
            ['Soy empático y percibo fácilmente lo que otros sienten.', 2],
            ['Cuando alguien me rechaza, me duele profundamente.', 2],
            ['Me cuesta decir “no” aunque no tenga tiempo.', 2],
            ['Disfruto sentirme indispensable.', 2],
            ['Busco cariño a través de mis acciones.', 2],
            ['Temo ser considerado egoísta.', 2],

            // Tipo 3 (Exitoso)
            ['Me esfuerzo constantemente por alcanzar metas ambiciosas.', 3],
            ['Mido mi valor por mis logros.', 3],
            ['Me gusta dar una buena impresión.', 3],
            ['Suelo adaptarme a lo que se espera de mí para destacar.', 3],
            ['Trabajo duro y me cuesta descansar sin sentir culpa.', 3],
            ['Disfruto competir y ganar.', 3],
            ['Evito mostrar debilidad o fracaso.', 3],
            ['Me motiva el reconocimiento.', 3],
            ['Me gusta ser eficiente y productivo.', 3],
            ['Prefiero la acción antes que la reflexión.', 3],

            // Tipo 4 (Individualista)
            ['Siento que soy diferente a los demás.', 4],
            ['Me gusta expresar mis emociones y creatividad.', 4],
            ['A veces me siento incomprendido.', 4],
            ['Busco autenticidad en mí y en los demás.', 4],
            ['Me atraen las artes y la belleza.', 4],
            ['Me es importante sentir profundidad emocional.', 4],
            ['Siento nostalgia o melancolía con frecuencia.', 4],
            ['Valoro la originalidad y la singularidad.', 4],
            ['Me gusta explorar mis sentimientos más íntimos.', 4],
            ['Prefiero la autenticidad antes que la aceptación social.', 4],

            // Tipo 5 (Investigador)
            ['Me gusta aprender y acumular conocimientos.', 5],
            ['Prefiero observar antes que participar.', 5],
            ['Me siento más seguro con información suficiente.', 5],
            ['Disfruto el análisis profundo y detallado.', 5],
            ['A veces me aíslo para concentrarme.', 5],
            ['Valoro la independencia y autonomía.', 5],
            ['Me resulta difícil compartir emociones con otros.', 5],
            ['Suelo planear antes de actuar.', 5],
            ['Busco comprensión antes que interacción social.', 5],
            ['Prefiero la reflexión a la acción impulsiva.', 5],

            // Tipo 6 (Leal)
            ['Busco seguridad y confianza en mi entorno.', 6],
            ['Me preocupo por posibles problemas y riesgos.', 6],
            ['Valoro la lealtad y el compromiso.', 6],
            ['Prefiero la preparación antes que la improvisación.', 6],
            ['Suelo dudar antes de tomar decisiones importantes.', 6],
            ['Me esfuerzo por ser responsable y fiable.', 6],
            ['Me siento más seguro siguiendo reglas o normas.', 6],
            ['Confío en quienes han demostrado consistencia.', 6],
            ['A veces cuestiono mi seguridad y capacidad.', 6],
            ['Me gusta tener un plan para cualquier situación.', 6],

            // Tipo 7 (Entusiasta)
            ['Me encanta explorar nuevas experiencias y aventuras.', 7],
            ['Prefiero mantenerme ocupado y activo.', 7],
            ['Busco placer y disfrute en la vida.', 7],
            ['Me gusta evitar el aburrimiento o la rutina.', 7],
            ['Soy optimista y positivo en general.', 7],
            ['Disfruto compartir momentos alegres con otros.', 7],
            ['Suelo improvisar y ser espontáneo.', 7],
            ['Me motiva la variedad y la libertad.', 7],
            ['A veces evito compromisos que me limiten.', 7],
            ['Busco experiencias que me entusiasmen y diviertan.', 7],

            // Tipo 8 (Desafiador)
            ['Me gusta tener el control y la dirección.', 8],
            ['No temo enfrentar conflictos o desafíos.', 8],
            ['Valoro la fuerza y la determinación.', 8],
            ['Defiendo a quienes están a mi cargo.', 8],
            ['Soy directo y claro en mis opiniones.', 8],
            ['Prefiero asumir responsabilidades importantes.', 8],
            ['Me molesta la injusticia o la debilidad.', 8],
            ['Busco respeto y reconocimiento.', 8],
            ['Me esfuerzo por proteger a los míos.', 8],
            ['No me intimidan los desafíos ni los riesgos.', 8],

            // Tipo 9 (Pacificador)
            ['Prefiero la armonía antes que el conflicto.', 9],
            ['Me esfuerzo por mantener la paz en mi entorno.', 9],
            ['A veces evito decisiones para no generar fricciones.', 9],
            ['Busco comprender todos los puntos de vista.', 9],
            ['Soy paciente y tolerante con los demás.', 9],
            ['Disfruto ambientes tranquilos y estables.', 9],
            ['Prefiero negociar antes que confrontar.', 9],
            ['Valoro la cooperación y el consenso.', 9],
            ['A veces postergó mis intereses para mantener la paz.', 9],
            ['Me esfuerzo por escuchar y mediar entre personas.', 9],
        ];

        foreach ($preguntas as $p) {
            EneagramaPregunta::create([
                'pregunta' => $p[0],
                'valor' => $p[1],
                'eneagramas_base_id' => 1,
            ]);
        }

        

        // Verbos y Frases de base
        $verbos = [
            'Cooperar',
            'Crear',
            'Alegrar',
            'Ayudar',
            'Liderar',
            'Observar',
            'Organizar',
            'Realizar',
            'Serenar',
        ];

        foreach ($verbos as $verbo) {
            EneagramaVerbo::create([
                'eneagramas_base_id' => 1,
                'verbo' => $verbo,
            ]);
        }


        $frases = [
            'Evito la debilidad, porque no hay nada imposible para mi.',
            'Evito el fracaso a toda costa, porque creo que siempre se puede hacer algo más.',
            'Evito la confusión, porque necesito tener las ideas claras.',
            'Evito el dolor, porque veo lo positivo de la vida.',
            'Evito el conflicto, porque trato de comprender y mediar en cualquier situación.',
            'Evito la mediocridad, porque no quiero ser uno más.',
            'Evito la cólera y el enojo, porque no es correcto irritarse.',
            'Evito cualquier tipo de irresponsabilidad.',
            'Evito reconocer y atender mis propias necesidades, priorizando las de los otros.',
        ];

         foreach ($frases as $frase) {
            EneagramaFrase::create([
                'eneagramas_base_id' => 1,
                'frase' => $frase,
            ]);
        }
    }
}
