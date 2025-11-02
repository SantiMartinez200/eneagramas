let input;




const crearPregunta = {
    init() {
        //delegacion de eventos en click 
        document.body.addEventListener('click', (e) => {
            if (e.target.matches('.btn-crear')) {
                input = document.querySelector('input[name="nueva_pregunta"]');
                const valor = input ? input.value : '';
                this.crearRegistro(valor);
            }
        });
    },
    //el input
     async crearRegistro(valor,eneagrama) {
        if (!valor) {
            //tratar de disparar el error del backend
            fireSweetAlert2Simple('error', 'No se pudo crear la pregunta', 'El campo está vacío', 3000, true);
            errorInput(input,true,3000,true);
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
                body: JSON.stringify({ nueva_pregunta: valor, eneagrama_usuario_id:  })
            });

            const data = await response.json();

            console.log('Respuesta del servidor:', data);

            // Ejemplo de feedback visual
            if (data.success) {
                alert('Pregunta creada correctamente (dummy)');
            } else {
                alert('Error al crear pregunta (dummy)');
            }
        } catch (error) {
            console.error('Error en fetch:', error);
        }
    }
};

// Ejecutar automáticamente al cargar el módulo
crearPregunta.init();

export default crearPregunta;
