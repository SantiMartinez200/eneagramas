                    <div class="table-wrapper">
                        <div class="space-y-8 rounded-xl bg-white dark:bg-neutral-900">
                            <!-- Instrucciones -->
                            <div class="text-gray-700 dark:text-gray-300 space-y-2">
                                <p>Estas son las frases y verbos disponibles en tu eneagrama. Puedes agregarlas, quitarlas o modificarlas.</p>
                            </div>

                            <!-- Tabla de Frases -->
                            <div class="overflow-x-auto rounded-lg border border-neutral-200 dark:border-neutral-800 mb-8">
                                <table class="tFrases min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
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
                                                    class="btn-crear-frase text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                    Agregar
                                                </button>
                                            </td>
                                        </tr>
                                        @foreach ($frases as $i => $frase)
                                            <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/70 transition-colors">
                                                <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $frases->firstItem() + $i }}</td>
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
                 
                                <div id="overlay-frases" class="absolute p-8 hidden inset-0 bg-white/70 dark:bg-black/50  flex items-start justify-center z-50">
                                    <svg class="animate-spin h-20 w-20 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>
                                </div>  
                            </div>
                        </div>       
                        <div class="m-4">
                            {{ $frases->links() }}
                        </div>
                    </div>                        