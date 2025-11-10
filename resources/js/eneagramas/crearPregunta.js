const crearPregunta = {
    async reloadListado() {
        const overlay = document.getElementById('overlay-preguntas');

        try {
            overlay?.classList.remove('hidden');

            const response = await fetch('/eneagrama/preguntas/reload', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                fireSweetAlert2Simple('error', 'Error', 'No fue posible cargar el listado', 3000, true);
                throw new Error('Error en la petición');
            }

            const data = await response.json();
            const tbody = document.querySelector('table tbody');
            
            if (!tbody) return;
            
            const firstRow = tbody.querySelector('tr');
            tbody.innerHTML = '';
            if (firstRow) tbody.appendChild(firstRow);

            data.eneagrama.preguntas.forEach((pregunta, i) => {
                const tr = document.createElement('tr');
                tr.classList.add('hover:bg-neutral-50', 'dark:hover:bg-neutral-800/70', 'transition-colors');

                tr.innerHTML = `
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">${i + 1}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        <div class="truncate max-w-xl" title="${pregunta.pregunta}">
                            ${pregunta.pregunta}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                        ${pregunta.valor ?? '—'}
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="/pregunta/editar/${pregunta.id}"
                           class="text-sm font-medium underline text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300">
                           Editar
                        </a>
                    </td>
                `;
                tbody.appendChild(tr);
            });

        } catch (error) {
            console.error(error);
            fireSweetAlert2Simple('error', 'Error', 'No fue posible cargar el listado', 3000, true);
        } finally {
            overlay?.classList.add('hidden');
        }
    },

    async crearRegistro(valor, eneagrama, selectValue) {
        console.log('📝 Intentando crear pregunta:', { valor, eneagrama, selectValue });

        if (isNaN(eneagrama) || isNaN(selectValue)) {
            fireSweetAlert2Simple('error', 'Error', 'No fue posible realizar la operación', 3000, true);
            console.error('Falta identificador de eneagrama o algún valor no es numérico.');
            return;
        }

        if (!valor || !selectValue) {
            const input = document.querySelector('input[name="nueva_pregunta"]');
            const select = document.querySelector('select[name="valor"]');
            
            fireSweetAlert2Simple('error', 'No se pudo crear la pregunta', 'Faltan campos requeridos', 3000, true);
            
            if (typeof errorInput !== 'undefined') {
                errorInput(input, true, 3000, true);
                errorInput(select, true, 3000, true);
            }
            return;
        }

        try {
            const response = await fetch('/pregunta/crear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ 
                    nueva_pregunta: valor, 
                    eneagrama_usuario_id: eneagrama, 
                    valor: selectValue
                })
            });

            const data = await response.json();

            if (data.success) {
                fireSweetAlert2Simple('success', 'Éxito', 'La pregunta fue creada correctamente', 3000, true);
                // Volver a la página 1 del listado paginado si existe
                if (typeof window.goToFirstPage === 'function') {
                    await window.goToFirstPage('preguntas');
                } else {
                    await this.reloadListado();
                }
                
                const input = document.querySelector('input[name="nueva_pregunta"]');
                const select = document.querySelector('select[name="valor"]');
                if (input) input.value = '';
                if (select) select.value = '1';
            } else {
                fireSweetAlert2Simple('error', 'Error', data.message, 3000, true);
            }
        } catch (error) {
            console.error('Error en fetch:', error);
            fireSweetAlert2Simple('error', 'Error', 'Ocurrió un error al crear la pregunta', 3000, true);
        }
    }
};

// ============================================
// HANDLER GLOBAL - Singleton pattern
// ============================================
// Guardamos la referencia de la función para poder removerla correctamente
if (!window._handleClickPregunta) {
    window._handleClickPregunta = function(e) {
        if (e.target.matches('.btn-crear') || e.target.closest('.btn-crear')) {
            console.log('🎯 Click detectado en .btn-crear');
            
            const input = document.querySelector('input[name="nueva_pregunta"]');
            const valor = input ? input.value : '';
            const eneagrama = document.querySelector('input[name="eneagrama_usuario_id"]')?.value;
            const select = document.querySelector('select[name="valor"]');
            const selectValue = select?.value;

            console.log('📊 Datos encontrados:', {
                hasInput: !!input,
                hasEneagrama: !!eneagrama,
                hasSelect: !!select,
                valor,
                selectValue
            });

            if (eneagrama && selectValue) {
                crearPregunta.crearRegistro(valor, eneagrama, selectValue);
            } else {
                console.warn('⚠️ Faltan elementos en el DOM');
            }
        }
    };
}

// Función para inicializar el listener
function initCrearPregunta() {
    // Remover listener anterior si existe
    document.body.removeEventListener('click', window._handleClickPregunta);
    // Agregar listener
    document.body.addEventListener('click', window._handleClickPregunta);
    console.log('✅ crearPregunta.js - Event listener inicializado');
}

// Inicializar inmediatamente
initCrearPregunta();

// Reinicializar después de navegación Livewire
document.addEventListener('livewire:navigated', initCrearPregunta);

export default crearPregunta;