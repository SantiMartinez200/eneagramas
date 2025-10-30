<x-layouts.app :title="__('Eneagramas')">
    <div class="flex flex-col gap-6 p-6 rounded-xl bg-white shadow-sm">
        <!-- Título principal -->
        <h1 class="text-3xl font-bold text-gray-900">Eneagramas</h1>
        <p class="text-gray-600">Listado general de eneagramas consultados en el sistema.</p>

        <!-- Contenedor principal de tabla/listado -->
        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900">
            <!-- Acá va tu tabla o componente -->
            <x-placeholder-pattern class="absolute inset-0 size-full" />
            
            <div class="p-4">
                <!-- Ejemplo de encabezado de tabla -->
                <table class="min-w-full border-collapse text-left">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-neutral-700">
                            <th class="py-2 px-3 text-sm font-semibold text-gray-700">#</th>
                            <th class="py-2 px-3 text-sm font-semibold text-gray-700">Nombre</th>
                            <th class="py-2 px-3 text-sm font-semibold text-gray-700 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 dark:border-neutral-800 hover:bg-gray-50 dark:hover:bg-neutral-800/40">
                            <td class="py-2 px-3 text-sm text-gray-600">1</td>    
                            <td class="py-2 px-3 text-sm text-gray-600">Santiago</td>
                            <td class="py-2 px-3 text-sm text-gray-600 text-right">Descargar Ver</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
