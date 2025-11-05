var input;
var eneagrama;


const crearVerbo = {
    init() {
        //delegacion de eventos en click 
        document.body.addEventListener('click', (e) => {
            if (e.target.matches('.btn-crear-verbo')) {
                input = document.querySelector('input[name="nuevo_verbo"]');
                const valor = input ? input.value : '';
                eneagrama = document.querySelector('input[name="eneagrama_usuario_id"]').value;
                this.crearRegistro(valor,eneagrama);
            }
        });
    },
    async reloadListado() {
        const overlay = document.getElementById('overlay-verbos');

        try {
            // Mostrar overlay
            overlay.classList.remove('hidden');

            const response = await fetch('/eneagrama/verbos/reload', {
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
            const tbody = document.querySelector('.tVerbos tbody');
            const firstRow = tbody.querySelector('tr'); // fila del input
            tbody.innerHTML = '';
            tbody.appendChild(firstRow);

            data.eneagrama.verbos.forEach((verbo, i) => {
                const tr = document.createElement('tr');
                tr.classList.add('hover:bg-neutral-50', 'dark:hover:bg-neutral-800/70', 'transition-colors');

                tr.innerHTML = `
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">${i + 1}</td>
                    <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                        <div class="truncate max-w-xl" title="${verbo.verbo}">
                            ${verbo.verbo}
                        </div>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="/verbo/editar/${verbo.id}"
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
            // Ocultar overlay
            overlay.classList.add('hidden');
        }
    },
    //el input
     async crearRegistro(valor,eneagrama) {
        if (isNaN(eneagrama)) {
            fireSweetAlert2Simple('error', 'Error', 'No fue posible realizar la operación', 3000, true);
            console.error('Falta identificador de eneagrama o algún valor no es numérico.');
            return;
        }

        if (!valor) {
            //tratar de disparar el error del backend
            fireSweetAlert2Simple('error', 'No se pudo crear el verbo', 'El campo está vacío', 3000, true);
            errorInput(input,true,3000,true);
            return;
        }

        try {
            const response = await fetch('/verbo/crear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                
                body: JSON.stringify({ nuevo_verbo: valor, eneagrama_usuario_id: eneagrama,})
            });

            const data = await response.json();

            // Ejemplo de feedback visual
            if (data.success) {
                fireSweetAlert2Simple('success', 'Éxito', 'La verbo fue creada correctamente', 3000, true);
                this.reloadListado();
                //alert('Verbo creado correctamente (dummy)');
            } else {
                fireSweetAlert2Simple('error', 'Error', data.message, 3000, true);
                //alert('Error al crear verbo (dummy)');
            }
        } catch (error) {
            console.error('Error en fetch:', error);
        }
    },

    
};

// Ejecutar automáticamente al cargar el módulo
crearVerbo.init();

export default crearVerbo;
