var input;
var eneagrama;
var select;
var selectValue;


const crearPregunta = {
    init() {
        //delegacion de eventos en click 
        document.body.addEventListener('click', (e) => {
            if (e.target.matches('.btn-crear')) {
                input = document.querySelector('input[name="nueva_pregunta"]');
                const valor = input ? input.value : '';
                eneagrama = document.querySelector('input[name="eneagrama_usuario_id"]').value;
                select = document.querySelector('select[name="valor"]');
                selectValue = document.querySelector('select[name="valor"]').value;

                this.crearRegistro(valor,eneagrama,selectValue);
            }
        });
    },
    async reloadListado() {
        const overlay = document.getElementById('overlay-carga');

        try {
            // Mostrar overlay
            overlay.classList.remove('hidden');

            const response = await fetch('/eneagrama/listado/reload', {
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
            const firstRow = tbody.querySelector('tr'); // fila del input
            tbody.innerHTML = '';
            tbody.appendChild(firstRow);

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
            // Ocultar overlay
            overlay.classList.add('hidden');
        }
    },
    //el input
     async crearRegistro(valor,eneagrama,selectValue) {
        if (isNaN(eneagrama) || isNaN(selectValue)) {
            fireSweetAlert2Simple('error', 'Error', 'No fue posible realizar la operación', 3000, true);
            console.error('Falta identificador de eneagrama o algún valor no es numérico.');
            return;
        }

        if (!valor || !select.value) {
            //tratar de disparar el error del backend
            fireSweetAlert2Simple('error', 'No se pudo crear la pregunta', 'El campo está vacío', 3000, true);
            errorInput(input,true,3000,true);
            errorInput(select,true,3000,true);
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
                
                body: JSON.stringify({ nueva_pregunta: valor, eneagrama_usuario_id: eneagrama, valor: selectValue})
            });

            const data = await response.json();

            // Ejemplo de feedback visual
            if (data.success) {
                fireSweetAlert2Simple('success', 'Éxito', 'La pregunta fue creada correctamente', 3000, true);
                this.reloadListado();
                //alert('Pregunta creada correctamente (dummy)');
            } else {
                fireSweetAlert2Simple('error', 'Error', data.message, 3000, true);
                //alert('Error al crear pregunta (dummy)');
            }
        } catch (error) {
            console.error('Error en fetch:', error);
        }
    },

    
};

// Ejecutar automáticamente al cargar el módulo
crearPregunta.init();

export default crearPregunta;
