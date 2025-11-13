
{{-- Color Picker Panel --}}
<div class="bg-white">
    <div class="bg-white border-b-2 border-gray-200 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Personalizar Colores</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                {{-- Color picker para fondo de botones --}}
                <div class="flex items-center gap-3">
                    <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Fondo de botones:</label>
                    <div class="flex items-center gap-2">
                        <input 
                            type="color" 
                            id="color-botones" 
                            value="#0891b2" 
                            class="w-12 h-10 rounded border border-gray-300 cursor-pointer"
                            onchange="aplicarColorBotones(this.value)"
                        />
                        <input 
                            type="text" 
                            id="color-botones-text" 
                            value="#0891b2" 
                            class="w-24 px-2 py-1 border text-gray-900 dark:text-gray-900 border-gray-300 rounded text-sm"
                            onchange="aplicarColorBotones(this.value)"
                        />
                    </div>
                </div>

                {{-- Color picker para color de títulos --}}
                <div class="flex items-center gap-3">
                    <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Color de títulos:</label>
                    <div class="flex items-center gap-2">
                        <input 
                            type="color" 
                            id="color-titulos" 
                            value="#0891b2" 
                            class="w-12 h-10 rounded border border-gray-300 cursor-pointer"
                            onchange="aplicarColorTitulos(this.value)"
                        />
                        <input 
                            type="text" 
                            id="color-titulos-text" 
                            value="#0891b2" 
                            class="w-24 px-2 py-1 border text-gray-900 dark:text-gray-900 border-gray-300 rounded text-sm"
                            onchange="aplicarColorTitulos(this.value)"
                        />
                    </div>
                </div>

                {{-- Color picker para color de alerta "Nota" --}}
                <div class="flex items-center gap-3">
                    <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Color de alerta "Nota":</label>
                    <div class="flex items-center gap-2">
                        <input 
                            type="color" 
                            id="color-nota" 
                            value="#3b82f6" 
                            class="w-12 h-10 rounded border border-gray-300 cursor-pointer"
                            onchange="aplicarColorNota(this.value)"
                        />
                        <input 
                            type="text" 
                            id="color-nota-text" 
                            value="#3b82f6" 
                            class="w-24 px-2 py-1 border text-gray-900 dark:text-gray-900 border-gray-300 rounded text-sm"
                            onchange="aplicarColorNota(this.value)"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-full p-3 bg-white mx-auto mt-6 mb-16 relative group">
                <div class="text-start">
                    <a 
                        id="volver-sitio-link"
                        href="#" 
                        class="inline-block text-white px-8 py-3 rounded-lg transition-colors font-semibold text-lg color-boton"
                        style="background-color: #0891b2;"
                    >
                        <span id="volver-sitio-text">Volver al sitio</span>
                    </a>
                    <button 
                        type="button"
                        class="absolute top-0 right-0 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                        onclick="editarVolverSitio()"
                        title="Editar botón Volver al sitio"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                </div>
            </div>
    <div class="min-h-screen bg-gray-50">
    {{-- Botón Volver al sitio --}}

        {{-- Hero Section --}}
        <div class="relative w-full h-64 bg-gradient-to-br from-cyan-700 to-cyan-900 flex items-center justify-center">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative z-10 group h-full w-full flex items-center justify-center">

                <img 
                    id="eneagrama-icon"
                    src="{{ asset('images/iconos-07.png') }}" 
                    alt="Eneagrama Icon" 
                    class="absolute inset-0 w-full h-full object-cover"
                    style="object-position: 62% 23%;"

                    />
                <button 
                    type="button"
                    class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg "
                    onclick="editarIcono()"
                    title="Editar icono"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="h-20"></div>

        {{-- Main Title --}}
        <div class="max-w-7xl mx-auto px-4">
            <div class="relative inline-block w-full group">
                <h2 
                    id="main-title"
                    class="text-4xl font-bold text-center mb-12 color-titulo"
                    style="color: #0891b2;"
                >
                    GENERADOR DE ENEAGRAMA
                </h2>
                <button 
                    type="button"
                    class="absolute top-0 right-0 bg-white/90  text-cyan-700 p-2 rounded-full shadow-lg "
                    onclick="editarTitulo()"
                    title="Editar título"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
            </div>

            {{-- Elements Cards Section --}}
            <div class="flex flex-wrap justify-center gap-8 mb-16" id="elements-cards-container">
                {{-- Element 1 --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card relative group w-full sm:w-[calc(50%-1rem)] lg:w-[calc(25%-1.5rem)] max-w-sm" id="element-1">
                    <div class="relative">
                        <img 
                            id="element-1-img"
                            src="{{ asset('images/LibroRPyLK.png') }}" 
                            alt="Elemento 1" 
                            class="w-full h-64 object-cover"
                        />
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarImagenElemento(1)"
                            title="Editar imagen"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 relative">
                            <a 
                            id="element-1-link"
                            href="" 
                            class="inline-block text-white px-6 py-3 rounded-lg transition-colors font-semibold color-boton"
                            style="background-color: #0891b2;"
                        >
                            <span id="element-1-text">Leer más</span>
                        </a>
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarBotonElemento(1)"
                            title="Editar botón"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Element 2 --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card hidden relative group w-full sm:w-[calc(50%-1rem)] lg:w-[calc(25%-1.5rem)] max-w-sm" id="element-2">
                    <div class="relative">
                        <img 
                            id="element-2-img"
                            src="{{ asset('images/conferencias-sanar.jpg') }}" 
                            alt="Elemento 2" 
                            class="w-full h-64 object-cover"
                        />
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarImagenElemento(2)"
                            title="Editar imagen"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 relative">
                        <a 
                            id="element-2-link"
                            href="" 
                            class="inline-block text-white px-6 py-3 rounded-lg transition-colors font-semibold color-boton"
                            style="background-color: #0891b2;"
                        >
                            <span id="element-2-text">Leer más</span>
                        </a>
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarBotonElemento(2)"
                            title="Editar botón"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Element 3 (Opcional) --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card hidden relative group w-full sm:w-[calc(50%-1rem)] lg:w-[calc(25%-1.5rem)] max-w-sm" id="element-3">
                    <div class="relative">
                        <img 
                            id="element-3-img"
                            src="{{ asset('images/placeholder-book.jpg') }}" 
                            alt="Elemento 3" 
                            class="w-full h-64 object-cover"
                        />
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarImagenElemento(3)"
                            title="Editar imagen"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 relative">
                        <a 
                            id="element-3-link"
                            href="" 
                            class="inline-block text-white px-6 py-3 rounded-lg transition-colors font-semibold color-boton"
                            style="background-color: #0891b2;"
                        >
                            <span id="element-3-text">Leer más</span>
                        </a>
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarBotonElemento(3)"
                            title="Editar botón"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Element 4 (Opcional) --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card hidden relative group w-full sm:w-[calc(50%-1rem)] lg:w-[calc(25%-1.5rem)] max-w-sm" id="element-4">
                    <div class="relative">
                        <img 
                            id="element-4-img"
                            src="{{ asset('images/placeholder-book.jpg') }}" 
                            alt="Elemento 4" 
                            class="w-full h-64 object-cover"
                        />
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarImagenElemento(4)"
                            title="Editar imagen"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 relative">
                        <a 
                            id="element-4-link"
                            href="" 
                            class="inline-block text-white px-6 py-3 rounded-lg transition-colors font-semibold color-boton"
                            style="background-color: #0891b2;"
                        >
                            <span id="element-4-text">Leer más</span>
                        </a>
                        <button 
                            type="button"
                            class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                            onclick="editarBotonElemento(4)"
                            title="Editar botón"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Botón para agregar/quitar elementos --}}
            <div class="text-center mb-16">
                <button 
                    type="button"
                    id="toggle-elements-btn"
                    class="bg-red-700 hover:bg-red-800 text-white px-6 py-2 rounded-lg transition-colors font-semibold"
                    onclick="toggleElements()"
                >
                    <span id="toggle-elements-text">Agregar más elementos</span>
                </button>
            </div>

            {{-- Instructions --}}
            <div class="max-w-3xl mx-auto mb-8 relative group">
                <button 
                    type="button"
                    class="absolute top-0 right-0 bg-white/90  text-cyan-700 p-2 rounded-full shadow-lg "
                    onclick="editarInstrucciones()"
                    title="Editar instrucciones"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
                <p 
                    id="instrucciones-text-1"
                    class="text-center text-gray-700 text-lg leading-relaxed font-medium"
                >
                    Tómese su tiempo para realizar el eneagrama, el formulario está compuesto por tres secciones.
                    <br />
                    Al final, cuando clickee «finalizar», se le mostrará un mensaje de éxito junto con un link al eneagrama, en formato .pdf para descargarlo o verlo en el navegador.
                </p>

                <p 
                    id="instrucciones-text-2"
                    class="text-center text-gray-900 font-bold mt-4 text-lg"
                >
                    Recomendamos descargarlo, así le queda disponible en su dispositivo.
                </p>
            </div>

            {{-- Form Section --}}
            <div class="max-w-2xl mx-auto rounded-lg shadow-lg mb-16 relative overflow-hidden border border-neutral-200 bg-white">
                <h3 class="text-2xl font-bold mb-6 text-center color-titulo pt-8" style="color: #0891b2;">Formulario del Eneagrama</h3>

                {{-- Placeholder con fondo stripped --}}
                <div class="relative h-64 flex items-center justify-center">
                    <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20" />

                    <div class="relative z-10">
                        <p class="text-2xl font-extrabold text-gray-400 tracking-tight">
                            Reservado para formulario
                        </p>
                    </div>
                </div>
            </div>

            <div class="h-12"></div>

            {{-- Determination Section --}}
            <div class="relative inline-block w-full group">
                <h2 
                    id="determinacion-title"
                    class="text-4xl font-bold text-center mb-8 color-titulo"
                    style="color: #0891b2;"
                >
                    DETERMINACIÓN
                </h2>
                <button 
                    type="button"
                    class="absolute top-0 right-0 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg"
                    onclick="editarDeterminacion()"
                    title="Editar título Determinación"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
            </div>

            {{-- Notice Box --}}
            <div id="nota-box" class="max-w-3xl mx-auto rounded-lg p-6 mb-16 relative group color-nota" style="background-color: rgba(59, 130, 246, 0.1); border-left: 4px solid #3b82f6;">
                <button 
                    type="button"
                    class="absolute top-2 right-2 bg-white/90  text-blue-700 p-2 rounded-full shadow-lg "
                    onclick="editarNota()"
                    title="Editar nota"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </button>
                <div class="flex items-start">
                    <div class="flex-1">
                        <h4 class="text-lg font-bold text-blue-900 mb-3">NOTA</h4>
                        <p 
                            id="nota-text"
                            class="text-gray-700 leading-relaxed"
                        >
                            <strong>
                                Las conclusiones de las respuestas obtenidas son una aproximación a la identificación de la esencia. 
                                Se requiere la entrevista con un formador en Eneagrama para confirmar la tipología predominante.
                            </strong>
                        </p>
                    </div>
                </div>
            </div>



            <div class="h-24"></div>
        </div>
    </div>
</div>

@vite(['resources/js/eneagramas/pagina-constructor.js'])