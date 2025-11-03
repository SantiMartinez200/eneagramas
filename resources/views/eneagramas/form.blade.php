
<x-layouts.app :title="__('Formulario')">
    <div class="flex flex-1 flex-col h-full w-full rounded-xl">
        <div class="flex flex-col gap-6 rounded-xl ">

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
                    <input type="hidden" name="eneagrama_usuario_id" value="{{$UsuarioConEneagrama->eneagrama->id}}">
                    <p class="mb-4 text-gray-700 dark:text-gray-300">
                        Por favor tómate tu tiempo para revisar las preguntas. Al final del listado encontrarás la sección de frases y verbos.
                    </p>

                    <!-- Tabla -->
                    <div id="preguntas-container" class="relative">      
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
                                                    class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-sm text-gray-700 dark:text-gray-300 px-2 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                            </td>
                                            <td class="px-4 py-3">
                                                <div class="relative">
                                                    <select id="valor" name="valor"
                                                      class="block w-full appearance-none pr-10 rounded-md border bg-white dark:bg-neutral-900 py-2 pl-3 text-sm text-gray-700 dark:text-gray-300
                                                             border-gray-300 dark:border-gray-600 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                                             transition-colors">
                                                        @for($i = 1; $i <= 9; $i++)
                                                            <option value="@php echo $i; @endphp">@php echo $i; @endphp</option>
                                                        @endfor
                                                    </select>

                                                    <!-- Icono (chevron) -->
                                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                      <svg class="h-4 w-4 text-gray-400 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                           viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                      </svg>
                                                    </div>
                                                </div>
                                                <!-- <select name="" id="">
                                                    @for($i = 1; $i <= 9; $i++)
                                                        <option value="@php echo $i; @endphp">@php echo $i; @endphp</option>
                                                    @endfor
                                                </select> -->
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                <button type="button"
                                                    class="btn-crear text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
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
                         <!-- Overlay de carga -->
                        <div id="overlay-carga" class="absolute p-8 inset-0 bg-white/70 dark:bg-black/50 hidden flex items-start justify-center z-50">
                            <svg class="animate-spin h-20 w-20 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- Sección de Frases y Verbos -->
                    <div class="space-y-8 rounded-xl bg-white dark:bg-neutral-900">
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
                                                class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-sm text-gray-700 dark:text-gray-300 px-2 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <button type="button"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Agregar
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach ($UsuarioConEneagrama->eneagrama->frases as $i => $frase)
                                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/70 transition-colors">
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $i + 1 }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $frase->frase }}</td>
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
                        <div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-800 mb-8">
                            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
                                <thead class="bg-neutral-50 dark:bg-neutral-800/60">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">#</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Verbo</th>
                                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-700 dark:text-gray-300">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800 bg-white dark:bg-neutral-900">
                                    <tr class="bg-neutral-50 dark:bg-neutral-800/60">
                                        <td class="px-4 py-3 text-sm text-gray-400 dark:text-gray-500">+</td>
                                        <td class="px-4 py-3">
                                            <input type="text" name="nuevo_verbo" placeholder="Nuevo verbo"
                                                class="w-full rounded-md border border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-900 text-sm text-gray-700 dark:text-gray-300 px-2 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                                        </td>

                                        <td class="px-4 py-3 text-right">
                                            <button type="button"
                                                class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Agregar
                                            </button>
                                        </td>
                                    </tr>
                                    @foreach ($UsuarioConEneagrama->eneagrama->verbos as $i => $verbo)
                                        <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/70 transition-colors">
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $i + 1 }}</td>
                                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $verbo->verbo }}</td>

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
                        <!-- <div class="flex items-center justify-end pt-6 border-t border-neutral-200 dark:border-neutral-800">
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 transition">
                                Guardar
                            </button>
                        </div> -->
                    </div>
                @else
                    {{-- Card de alerta si aún no hay eneagrama --}}
                    <p class="text-gray-600"></p>
                    <div class="relative h-full flex flex-col items-center justify-center gap-4 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-8 text-center bg-white dark:bg-neutral-900">
                        <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />

                        <div class="relative z-10 flex flex-col items-center gap-3">
                            <!-- Ícono de cruz -->
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>

                            <!-- Mensaje -->
                            <p class="text-lg font-medium text-gray-800 dark:text-gray-100">
                                Aún no creaste el eneagrama
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Haz click en el botón de abajo para crearlo.
                            </p>

                            <!-- Botón -->
                            <a href="{{ route('eneagrama.crear') }}"
                               class="mt-2 inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm transition-all dark:bg-blue-500 dark:hover:bg-blue-600">
                                Crear Eneagrama
                            </a>
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
@vite(['resources/js/eneagramas/crearPregunta.js'])
</x-layouts.app>
