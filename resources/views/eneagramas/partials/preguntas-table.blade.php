                    <div class="table-wrapper">
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
                                    @foreach ($preguntas as $i => $pregunta)
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
                            <!-- Overlay de carga -->
                                            <!-- Links de paginación -->
                        </div>
                        <div id="overlay-preguntas" class="absolute p-8 hidden inset-0 bg-white/70 dark:bg-black/50  flex items-start justify-center z-50">
                            <svg class="animate-spin h-20 w-20 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </div>
                        <div class="m-4">
                            {{ $preguntas->links() }}
                        </div>
                    </div>
