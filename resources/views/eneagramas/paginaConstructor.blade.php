
<x-layouts.app :title="__('Formulario')">
    <div class="flex flex-1 flex-col h-full w-full rounded-xl">
        <div class="flex flex-col gap-6 rounded-xl ">
        <div class="flex flex-col gap-2 p-6 rounded-xl bg-white dark:bg-neutral-900 shadow-sm border border-neutral-200 dark:border-neutral-800">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">Página del usuario</h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Este es el constructor de la página del usuario.
                </p>
            </div>
            </div>
            <div class="p-6 rounded-xl bg-white dark:bg-neutral-900 shadow-sm border border-neutral-200 dark:border-neutral-800">
                <div id="pagina-wrapper" class="partial-wrapper">
                    @include('eneagramas.partials.pagina-constructor')
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>