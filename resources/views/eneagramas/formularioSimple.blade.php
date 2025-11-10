 
<x-layouts.app :title="__('Formulario')">
    <div class="flex flex-1 flex-col h-full w-full rounded-xl">
        <div class="flex flex-col gap-6 rounded-xl ">
 
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
        </div>
    </div>
</x-layouts.app>