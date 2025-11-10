const crearFrase = {
    async reloadListado() {
        const overlay = document.getElementById('overlay-frases');

        try {
            overlay?.classList.remove('hidden');

            const response = await fetch('/eneagrama/frases/reload', {
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
            const tbody = document.querySelector('.tFrases tbody');
            
            if (!tbody) return;
            
            const firstRow = tbody.querySelector('tr');
            tbody.innerHTML = '';
            if (firstRow) tbody.appendChild(firstRow);

            data.eneagrama.frases.forEach((frase, i) => {
                const tr = document.createElement('tr');
                tr.classList.add('hover:bg-neutral-50', 'dark:hover:bg-neutral-800/70', 'transition-colors');

                tr.innerHTML = `
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">${i + 1}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        <div class="truncate max-w-xl" title="${frase.frase}">
                            ${frase.frase}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="/frase/editar/${frase.id}"
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

    async crearRegistro(valor, eneagrama) {
        console.log('📝 Intentando crear frase:', { valor, eneagrama });

        if (isNaN(eneagrama)) {
            fireSweetAlert2Simple('error', 'Error', 'No fue posible realizar la operación', 3000, true);
            console.error('Falta identificador de eneagrama');
            return;
        }

        if (!valor) {
            const input = document.querySelector('input[name="nueva_frase"]');
            fireSweetAlert2Simple('error', 'No se pudo crear la frase', 'El campo está vacío', 3000, true);
            if (typeof errorInput !== 'undefined') {
                errorInput(input, true, 3000, true);
            }
            return;
        }

        try {
            const response = await fetch('/frase/crear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ 
                    nueva_frase: valor, 
                    eneagrama_usuario_id: eneagrama
                })
            });

            const data = await response.json();

            if (data.success) {
                fireSweetAlert2Simple('success', 'Éxito', 'La frase fue creada correctamente', 3000, true);
                await this.reloadListado();
                
                const input = document.querySelector('input[name="nueva_frase"]');
                if (input) input.value = '';
            } else {
                fireSweetAlert2Simple('error', 'Error', data.message, 3000, true);
            }
        } catch (error) {
            console.error('Error en fetch:', error);
            fireSweetAlert2Simple('error', 'Error', 'Ocurrió un error al crear la frase', 3000, true);
        }
    }
};

// ============================================
// HANDLER GLOBAL - Singleton pattern
// ============================================
// Guardamos la referencia de la función para poder removerla correctamente
if (!window._handleClickFrase) {
    window._handleClickFrase = function(e) {
        if (e.target.matches('.btn-crear-frase') || e.target.closest('.btn-crear-frase')) {
            console.log('🎯 Click detectado en .btn-crear-frase');
            
            const input = document.querySelector('input[name="nueva_frase"]');
            const valor = input ? input.value : '';
            const eneagrama = document.querySelector('input[name="eneagrama_usuario_id"]')?.value;
            
            console.log('📊 Datos encontrados:', {
                hasInput: !!input,
                hasEneagrama: !!eneagrama,
                valor
            });

            if (eneagrama) {
                crearFrase.crearRegistro(valor, eneagrama);
            } else {
                console.warn('⚠️ Falta eneagrama_usuario_id en el DOM');
            }
        }
    };
}

// Función para inicializar el listener
function initCrearFrase() {
    // Remover listener anterior si existe
    document.body.removeEventListener('click', window._handleClickFrase);
    // Agregar listener
    document.body.addEventListener('click', window._handleClickFrase);
    console.log('✅ crearFrase.js - Event listener inicializado');
}

// Inicializar inmediatamente
initCrearFrase();

// Reinicializar después de navegación Livewire
document.addEventListener('livewire:navigated', initCrearFrase);

export default crearFrase;