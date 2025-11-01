<x-layouts.app :title="__('Formulario')">
    <div class="flex flex-1 flex-col h-full w-full rounded-xl">
        <div class="flex flex-col gap-6 rounded-xl shadow-sm">

            <!-- Encabezado principal -->
            <div class="flex flex-col gap-2 p-6 rounded-xl bg-white dark:bg-neutral-900 shadow-sm border border-neutral-200 dark:border-neutral-800">
                <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">Formulario</h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Este es el listado de preguntas que deben completar los usuarios.
                </p>
            </div>

            <!-- Contenido principal -->
            <div class="p-6 rounded-xl bg-white dark:bg-neutral-900 shadow-sm border border-neutral-200 dark:border-neutral-800">
                @if ($UsuarioConEneagrama && $UsuarioConEneagrama->eneagrama && $UsuarioConEneagrama->eneagrama->preguntas->isNotEmpty())

                    <p class="mb-4 text-gray-700 dark:text-gray-300">
                        Por favor tómate tu tiempo para revisar las preguntas. Al final del listado encontrarás la sección de frases y verbos.
                    </p>

                    <!-- Tabla -->
                    <div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-800 mb-8">
                        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
                            <thead class="bg-neutral-50 dark:bg-neutral-800/60">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">#</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Pregunta</th>
                                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Valor Numérico</th>
                                    <th scope="col" class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800 bg-white dark:bg-neutral-900">
                                    <tr class="bg-neutral-50 dark:bg-neutral-800/60">
                                        <td class="px-4 py-3 text-sm text-gray-400 dark:text-gray-500">+</td>
                                        <td class="px-4 py-3">
                                            <input type="text" name="nueva_pregunta" placeholder="Nueva pregunta"
                                                class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-sm text-gray-700 dark:text-gray-300 px-2 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                        </td>
                                        <td class="px-4 py-3">
                                            <select name="" id="">
                                                @for($i = 1; $i <= 9; $i++)
                                                    <option value="@php echo $i; @endphp">@php echo $i; @endphp</option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <button type="button"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Agregar
                                            </button>
                                        </td>
                                    </tr>
                                @foreach ($UsuarioConEneagrama->eneagrama->preguntas as $i => $pregunta)
                                    <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/70 transition-colors">
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $i + 1 }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                            <div class="truncate max-w-xl" title="{{ $pregunta->pregunta }}">
                                                {{ $pregunta->pregunta }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $pregunta->valor ?? '—' }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('pregunta.editar', $pregunta->id) }}"
                                               class="text-sm font-medium underline text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Editar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Sección de Frases y Verbos -->
                    <div class="space-y-8 rounded-xl bg-white dark:bg-neutral-900 shadow-sm">
                        <!-- Instrucciones -->
                        <div class="text-gray-700 dark:text-gray-300 space-y-2">
                            <p>Estas son las frases y verbos disponibles en tu eneagrama. Puedes agregarlas, quitarlas o modificarlas.</p>
                        </div>

                        <!-- Tabla de Frases -->
                        <div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-800 mb-8">
                            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
                                <thead class="bg-neutral-50 dark:bg-neutral-800/60">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">#</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Frase</th>
                                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800 bg-white dark:bg-neutral-900">
                                    <tr class="bg-neutral-50 dark:bg-neutral-800/60">
                                        <td class="px-4 py-3 text-sm text-gray-400 dark:text-gray-500">+</td>
                                        <td class="px-4 py-3">
                                            <input type="text" name="nueva_frase" placeholder="Nueva frase"
                                                class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-sm text-gray-700 dark:text-gray-300 px-2 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <button type="button"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Agregar
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach ([
                                        'Evito la debilidad, porque no hay nada imposible para mi.',
                                        'Evito el fracaso a toda costa, porque creo que siempre se puede hacer algo más.',
                                        'Evito la confusión, porque necesito tener las ideas claras.',
                                        'Evito el dolor, porque veo lo positivo de la vida.',
                                        'Evito el conflicto, porque trato de comprender y mediar en cualquier situación.',
                                        'Evito la mediocridad, porque no quiero ser uno más.',
                                        'Evito la cólera y el enojo, porque no es correcto irritarse.',
                                        'Evito cualquier tipo de irresponsabilidad.',
                                        'Evito reconocer y atender mis propias necesidades, priorizando las de los otros.',
                                    ] as $index => $frase)
                                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/70 transition-colors">
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $frase }}</td>
                                            <td class="px-4 py-3 text-right">
                                                <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Editar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                                    
                        <!-- Tabla de Verbos -->
                        <div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-800">
                            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
                                <thead class="bg-neutral-50 dark:bg-neutral-800/60">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">#</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Verbo</th>
                                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800 bg-white dark:bg-neutral-900">
                                    @php
                                        $verbos = [
                                            ['verbo' => 'Cooperar'],
                                            ['verbo' => 'Crear'],
                                            ['verbo' => 'Alegrar'],
                                            ['verbo' => 'Ayudar'],
                                            ['verbo' => 'Liderar'],
                                            ['verbo' => 'Observar'],
                                            ['verbo' => 'Organizar'],
                                            ['verbo' => 'Realizar'],
                                            ['verbo' => 'Serenar'],
                                        ];
                                    @endphp
                                    <tr class="bg-neutral-50 dark:bg-neutral-800/60">
                                        <td class="px-4 py-3 text-sm text-gray-400 dark:text-gray-500">+</td>
                                        <td class="px-4 py-3">
                                            <input type="text" name="nuevo_verbo" placeholder="Nuevo verbo"
                                                class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-sm text-gray-700 dark:text-gray-300 px-2 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                        </td>

                                        <td class="px-4 py-3 text-right">
                                            <button type="button"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Agregar
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach ($verbos as $index => $item)
                                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/70 transition-colors">
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $item['verbo'] }}</td>

                                            <td class="px-4 py-3 text-right">
                                                <button class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Editar
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                                    
                        <!-- Botón Guardar -->
                        <div class="flex items-center justify-end pt-6 border-t border-neutral-200 dark:border-neutral-800">
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 transition">
                                Guardar
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- SweetAlert -->
            @php
                $sessionMessages = collect(Session::only(['success', 'error', 'warning', 'info']));
                $type = $sessionMessages->keys()->first();
                $message = $sessionMessages->first();
            @endphp

            @if ($message)
                <script>
                    window.addEventListener('DOMContentLoaded', function() {
                        fireSweetAlert2Simple(
                            @json($type),
                            @json('Éxito'),
                            @json($message)
                        );
                    });
                </script>
            @endif

        </div>
    </div>
</x-layouts.app>
