
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    <div class="relative w-full h-64 bg-gradient-to-br from-cyan-700 to-cyan-900 flex items-center justify-center">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 group">
            <img 
                id="eneagrama-icon"
                src="{{ asset('images/iconos-07.png') }}" 
                alt="Eneagrama Icon" 
                class="w-64 h-64 object-cover rounded-lg shadow-2xl"
            />
            <button 
                type="button"
                class="absolute top-2 right-2 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity"
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
                class="text-4xl font-bold text-center text-cyan-700 mb-12"
            >
                GENERADOR DE ENEAGRAMA
            </h2>
            <button 
                type="button"
                class="absolute top-0 right-0 bg-white/90 hover:bg-white text-cyan-700 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity"
                onclick="editarTitulo()"
                title="Editar título"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </button>
        </div>

        {{-- Elements Cards Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16" id="elements-cards-container">
            {{-- Element 1 --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card" id="element-1">
                <img 
                    src="{{ asset('images/LibroRPyLK.png') }}" 
                    alt="Elemento 1" 
                    class="w-full h-64 object-cover"
                />
                <div class="p-6">
                    <a 
                        href="" 
                        class="inline-block bg-cyan-700 text-white px-6 py-3 rounded-lg hover:bg-cyan-800 transition-colors font-semibold"
                    >
                        Leer más
                    </a>
                </div>
            </div>

            {{-- Element 2 --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card hidden" id="element-2">
                <img 
                    src="{{ asset('images/conferencias-sanar.jpg') }}" 
                    alt="Elemento 2" 
                    class="w-full h-64 object-cover"
                />
                <div class="p-6">
                    <a 
                        href="" 
                        class="inline-block bg-cyan-700 text-white px-6 py-3 rounded-lg hover:bg-cyan-800 transition-colors font-semibold"
                    >
                        Leer más
                    </a>
                </div>
            </div>

            {{-- Element 3 (Opcional) --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card hidden" id="element-3">
                <img 
                    src="{{ asset('images/placeholder-book.jpg') }}" 
                    alt="Elemento 3" 
                    class="w-full h-64 object-cover"
                />
                <div class="p-6">
                    <a 
                        href="" 
                        class="inline-block bg-cyan-700 text-white px-6 py-3 rounded-lg hover:bg-cyan-800 transition-colors font-semibold"
                    >
                        Leer más
                    </a>
                </div>
            </div>

            {{-- Element 4 (Opcional) --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow element-card hidden" id="element-4">
                <img 
                    src="{{ asset('images/placeholder-book.jpg') }}" 
                    alt="Elemento 4" 
                    class="w-full h-64 object-cover"
                />
                <div class="p-6">
                    <a 
                        href="" 
                        class="inline-block bg-cyan-700 text-white px-6 py-3 rounded-lg hover:bg-cyan-800 transition-colors font-semibold"
                    >
                        Leer más
                    </a>
                </div>
            </div>
        </div>

        {{-- Botón para agregar/quitar elementos --}}
        <div class="text-center mb-16">
            <button 
                type="button"
                id="toggle-elements-btn"
                class="bg-cyan-700 hover:bg-cyan-800 text-white px-6 py-2 rounded-lg transition-colors font-semibold"
                onclick="toggleElements()"
            >
                <span id="toggle-elements-text">Agregar más elementos</span>
            </button>
        </div>

        {{-- Instructions --}}
        <div class="max-w-3xl mx-auto mb-8">
            <p class="text-center text-gray-700 text-lg leading-relaxed font-medium">
                Tómese su tiempo para realizar el eneagrama, el formulario está compuesto por tres secciones.
                <br />
                Al final, cuando clickee «finalizar», se le mostrará un mensaje de éxito junto con un link al eneagrama, en formato .pdf para descargarlo o verlo en el navegador.
            </p>
            
            <p class="text-center text-gray-900 font-bold mt-4 text-lg">
                Recomendamos descargarlo, así le queda disponible en su dispositivo.
            </p>
        </div>

        {{-- Form Section --}}
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8 mb-16">
            <h3 class="text-2xl font-bold text-cyan-700 mb-6 text-center">Formulario del Eneagrama</h3>
            
            <form class="space-y-6">
                {{-- Sección 1: Preguntas --}}
                <div class="border-b border-gray-200 pb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Sección 1: Preguntas</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pregunta 1: ¿Cómo te describes a ti mismo?
                            </label>
                            <textarea 
                                rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Escribe tu respuesta aquí..."
                            ></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Pregunta 2: ¿Cuál es tu mayor fortaleza?
                            </label>
                            <input 
                                type="text"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Escribe tu respuesta aquí..."
                            />
                        </div>
                    </div>
                </div>

                {{-- Sección 2: Frases --}}
                <div class="border-b border-gray-200 pb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Sección 2: Frases</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Selecciona la frase que más te identifica:
                            </label>
                            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                                <option value="">Selecciona una opción</option>
                                <option value="1">Frase de ejemplo 1</option>
                                <option value="2">Frase de ejemplo 2</option>
                                <option value="3">Frase de ejemplo 3</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Sección 3: Verbos --}}
                <div class="pb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">Sección 3: Verbos</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Selecciona los verbos que mejor te describen:
                            </label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                                    <span class="ml-2 text-gray-700">Verbo 1</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                                    <span class="ml-2 text-gray-700">Verbo 2</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="rounded border-gray-300 text-cyan-600 focus:ring-cyan-500">
                                    <span class="ml-2 text-gray-700">Verbo 3</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botón de envío --}}
                <div class="text-center pt-4">
                    <button 
                        type="submit"
                        class="bg-cyan-700 hover:bg-cyan-800 text-white px-8 py-3 rounded-lg transition-colors font-semibold text-lg"
                    >
                        Finalizar
                    </button>
                </div>
            </form>
        </div>

        <div class="h-12"></div>

        {{-- Determination Section --}}
        <h2 class="text-4xl font-bold text-center text-cyan-700 mb-8">
            DETERMINACIÓN
        </h2>

        {{-- Notice Box --}}
        <div class="max-w-3xl mx-auto bg-blue-50 border-l-4 border-blue-500 rounded-lg p-6 mb-16 relative group">
            <button 
                type="button"
                class="absolute top-2 right-2 bg-white/90 hover:bg-white text-blue-700 p-2 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-opacity"
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

<script>
    // Estado de los elementos visibles
    let elementosVisibles = 1;

    // Función para editar el icono
    function editarIcono() {
        const icono = document.getElementById('eneagrama-icon');
        const nuevaUrl = prompt('Ingrese la nueva URL de la imagen:', icono.src);
        if (nuevaUrl && nuevaUrl.trim() !== '') {
            icono.src = nuevaUrl.trim();
        }
    }

    // Función para editar el título
    function editarTitulo() {
        const titulo = document.getElementById('main-title');
        const nuevoTexto = prompt('Ingrese el nuevo título:', titulo.textContent.trim());
        if (nuevoTexto && nuevoTexto.trim() !== '') {
            titulo.textContent = nuevoTexto.trim();
        }
    }

    // Función para editar la nota
    function editarNota() {
        const nota = document.getElementById('nota-text');
        const textoActual = nota.textContent.trim();
        const nuevoTexto = prompt('Ingrese el nuevo texto de la nota:', textoActual);
        if (nuevoTexto && nuevoTexto.trim() !== '') {
            nota.innerHTML = '<strong>' + nuevoTexto.trim() + '</strong>';
        }
    }

    // Función para agregar/quitar elementos
    function toggleElements() {
        const element1 = document.getElementById('element-1');
        const element2 = document.getElementById('element-2');
        const element3 = document.getElementById('element-3');
        const element4 = document.getElementById('element-4');
        const toggleText = document.getElementById('toggle-elements-text');
        const container = document.getElementById('elements-cards-container');

        if (elementosVisibles === 1) {
            // Mostrar elemento 2
            element2.classList.remove('hidden');
            elementosVisibles = 2;
            toggleText.textContent = 'Agregar más elementos';
            // Ajustar grid: 2 columnas en md, 2 en lg
            container.classList.remove('md:grid-cols-2', 'lg:grid-cols-3', 'lg:grid-cols-4');
            container.classList.add('md:grid-cols-2', 'lg:grid-cols-4');
        } else if (elementosVisibles === 2) {
            // Mostrar elemento 3
            element3.classList.remove('hidden');
            elementosVisibles = 3;
            toggleText.textContent = 'Agregar más elementos';
            // Ajustar grid: 2 columnas en md, 3 en lg
            container.classList.remove('md:grid-cols-2', 'lg:grid-cols-4');
            container.classList.add('md:grid-cols-2', 'lg:grid-cols-3');
        } else if (elementosVisibles === 3) {
            // Mostrar elemento 4
            element4.classList.remove('hidden');
            elementosVisibles = 4;
            toggleText.textContent = 'Ocultar todos los elementos';
            // Ajustar grid: 2 columnas en md, 4 en lg
            container.classList.remove('md:grid-cols-2', 'lg:grid-cols-3');
            container.classList.add('md:grid-cols-2', 'lg:grid-cols-4');
        } else if (elementosVisibles === 4) {
            // Ocultar todos los elementos
            element1.classList.add('hidden');
            element2.classList.add('hidden');
            element3.classList.add('hidden');
            element4.classList.add('hidden');
            elementosVisibles = 0;
            toggleText.textContent = 'Mostrar elementos';
            // Mantener grid pero sin elementos visibles
        } else {
            // Mostrar elemento 1 (volver al estado inicial)
            element1.classList.remove('hidden');
            element2.classList.add('hidden');
            element3.classList.add('hidden');
            element4.classList.add('hidden');
            elementosVisibles = 1;
            toggleText.textContent = 'Agregar más elementos';
            // Restaurar grid original
            container.classList.remove('md:grid-cols-2', 'lg:grid-cols-3', 'lg:grid-cols-4');
            container.classList.add('md:grid-cols-2', 'lg:grid-cols-4');
        }
    }
</script>