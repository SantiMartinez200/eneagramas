// resources/js/eneagramas/pagina-constructor.js

// Asegurar que Swal esté disponible
import Swal from 'sweetalert2';
window.Swal = Swal;

// Estado de los elementos visibles
let elementosVisibles = 1;

// Función para oscurecer un color (para hover de botones)
function obtenerColorHover(color) {
    let r, g, b;
    
    // Si es hexadecimal
    if (color.startsWith('#')) {
        const hex = color.replace('#', '');
        r = parseInt(hex.substr(0, 2), 16);
        g = parseInt(hex.substr(2, 2), 16);
        b = parseInt(hex.substr(4, 2), 16);
    } 
    // Si es RGB o RGBA
    else if (color.startsWith('rgb')) {
        const rgb = color.match(/\d+/g);
        if (rgb && rgb.length >= 3) {
            r = parseInt(rgb[0]);
            g = parseInt(rgb[1]);
            b = parseInt(rgb[2]);
        } else {
            return color;
        }
    } else {
        return color;
    }
    
    // Oscurecer el color
    r = Math.max(0, r - 20);
    g = Math.max(0, g - 20);
    b = Math.max(0, b - 20);
    
    return `rgb(${r}, ${g}, ${b})`;
}

// Función para convertir hex a RGB con opacidad
function hexToRgba(hex, opacity) {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    return `rgba(${r}, ${g}, ${b}, ${opacity})`;
}

// Función para aplicar color a los botones
function aplicarColorBotones(color) {
    // Sincronizar el input de texto con el color picker
    if (document.getElementById('color-botones-text')) {
        document.getElementById('color-botones-text').value = color;
    }
    if (document.getElementById('color-botones')) {
        document.getElementById('color-botones').value = color;
    }
    
    // Aplicar a todos los botones con clase color-boton
    const botones = document.querySelectorAll('.color-boton');
    botones.forEach(boton => {
        boton.style.backgroundColor = color;
        // Actualizar el hover
        boton.onmouseover = function() {
            this.style.backgroundColor = obtenerColorHover(color);
        };
        boton.onmouseout = function() {
            this.style.backgroundColor = color;
        };
    });
}

// Función para aplicar color a los títulos
function aplicarColorTitulos(color) {
    // Sincronizar el input de texto con el color picker
    document.getElementById('color-titulos-text').value = color;
    document.getElementById('color-titulos').value = color;
    
    // Aplicar a todos los títulos con clase color-titulo
    const titulos = document.querySelectorAll('.color-titulo');
    titulos.forEach(titulo => {
        titulo.style.color = color;
    });
}

// Función para aplicar color a la alerta de Nota
function aplicarColorNota(color) {
    // Sincronizar el input de texto con el color picker
    document.getElementById('color-nota-text').value = color;
    document.getElementById('color-nota').value = color;
    
    // Aplicar a la caja de nota
    const notaBox = document.getElementById('nota-box');
    if (notaBox) {
        notaBox.style.backgroundColor = hexToRgba(color, 0.1);
        notaBox.style.borderLeftColor = color;
    }
}

// Función para editar el icono
function editarIcono() {
    const icono = document.getElementById('eneagrama-icon');
    Swal.fire({
        title: 'Editar Icono',
        input: 'text',
        inputLabel: 'URL de la imagen',
        inputValue: icono.src,
        inputPlaceholder: 'Ingrese la nueva URL de la imagen',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar una URL';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            icono.src = result.value.trim();
        }
    });
}

// Función para editar el título
function editarTitulo() {
    const titulo = document.getElementById('main-title');
    Swal.fire({
        title: 'Editar Título',
        input: 'text',
        inputLabel: 'Nuevo título',
        inputValue: titulo.textContent.trim(),
        inputPlaceholder: 'Ingrese el nuevo título',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar un título';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            titulo.textContent = result.value.trim();
        }
    });
}

// Función para editar la nota
function editarNota() {
    const nota = document.getElementById('nota-text');
    const textoActual = nota.textContent.trim();
    Swal.fire({
        title: 'Editar Nota',
        input: 'textarea',
        inputLabel: 'Nuevo texto de la nota',
        inputValue: textoActual,
        inputPlaceholder: 'Ingrese el nuevo texto de la nota',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar un texto';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            nota.innerHTML = '<strong>' + result.value.trim() + '</strong>';
        }
    });
}

// Función para editar el título de Determinación
function editarDeterminacion() {
    const titulo = document.getElementById('determinacion-title');
    Swal.fire({
        title: 'Editar Título de Determinación',
        input: 'text',
        inputLabel: 'Nuevo título',
        inputValue: titulo.textContent.trim(),
        inputPlaceholder: 'Ingrese el nuevo título',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar un título';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            titulo.textContent = result.value.trim();
        }
    });
}

// Función para editar las instrucciones
function editarInstrucciones() {
    const texto1 = document.getElementById('instrucciones-text-1');
    const texto2 = document.getElementById('instrucciones-text-2');
    
    // Obtener el texto completo sin etiquetas HTML
    const textoCompleto1 = texto1.textContent.trim();
    const textoCompleto2 = texto2.textContent.trim();
    
    // Editar primer párrafo
    Swal.fire({
        title: 'Editar Instrucciones',
        input: 'textarea',
        inputLabel: 'Primer párrafo',
        inputValue: textoCompleto1,
        inputPlaceholder: 'Ingrese el nuevo texto del primer párrafo',
        showCancelButton: true,
        confirmButtonText: 'Siguiente',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar un texto';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            // Preservar el <br /> si existe en el texto original
            const textoConBr = result.value.trim().replace(/\n/g, '<br />');
            texto1.innerHTML = textoConBr;
            
            // Editar segundo párrafo
            Swal.fire({
                title: 'Editar Instrucciones',
                input: 'text',
                inputLabel: 'Segundo párrafo',
                inputValue: textoCompleto2,
                inputPlaceholder: 'Ingrese el nuevo texto del segundo párrafo',
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                inputValidator: (value) => {
                    if (!value || !value.trim()) {
                        return 'Debe ingresar un texto';
                    }
                }
            }).then((result2) => {
                if (result2.isConfirmed && result2.value && result2.value.trim() !== '') {
                    texto2.textContent = result2.value.trim();
                }
            });
        }
    });
}

// Función para editar la imagen de un elemento
function editarImagenElemento(numero) {
    const imagen = document.getElementById('element-' + numero + '-img');
    Swal.fire({
        title: 'Editar Imagen del Elemento ' + numero,
        input: 'text',
        inputLabel: 'URL de la imagen',
        inputValue: imagen.src,
        inputPlaceholder: 'Ingrese la nueva URL de la imagen',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar una URL';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            imagen.src = result.value.trim();
        }
    });
}

// Función para editar el botón (texto y link) de un elemento
function editarBotonElemento(numero) {
    const textoElemento = document.getElementById('element-' + numero + '-text');
    const linkElemento = document.getElementById('element-' + numero + '-link');
    
    const textoActual = textoElemento.textContent.trim();
    const linkActual = linkElemento.href || '';
    
    // Editar texto del botón
    Swal.fire({
        title: 'Editar Botón del Elemento ' + numero,
        input: 'text',
        inputLabel: 'Texto del botón',
        inputValue: textoActual,
        inputPlaceholder: 'Ingrese el nuevo texto del botón',
        showCancelButton: true,
        confirmButtonText: 'Siguiente',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar un texto';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            textoElemento.textContent = result.value.trim();
            
            // Editar link del botón
            Swal.fire({
                title: 'Editar Botón del Elemento ' + numero,
                input: 'text',
                inputLabel: 'URL del enlace',
                inputValue: linkActual,
                inputPlaceholder: 'Ingrese la nueva URL del enlace',
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar'
            }).then((result2) => {
                if (result2.isConfirmed) {
                    if (result2.value && result2.value.trim() !== '') {
                        linkElemento.href = result2.value.trim();
                    } else {
                        linkElemento.href = '#';
                    }
                }
            });
        }
    });
}

// Función para editar el botón "Volver al sitio"
function editarVolverSitio() {
    const textoElemento = document.getElementById('volver-sitio-text');
    const linkElemento = document.getElementById('volver-sitio-link');
    
    const textoActual = textoElemento.textContent.trim();
    const linkActual = linkElemento.href || '';
    
    // Editar texto del botón
    Swal.fire({
        title: 'Editar Botón "Volver al sitio"',
        input: 'text',
        inputLabel: 'Texto del botón',
        inputValue: textoActual,
        inputPlaceholder: 'Ingrese el nuevo texto del botón',
        showCancelButton: true,
        confirmButtonText: 'Siguiente',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
            if (!value || !value.trim()) {
                return 'Debe ingresar un texto';
            }
        }
    }).then((result) => {
        if (result.isConfirmed && result.value && result.value.trim() !== '') {
            textoElemento.textContent = result.value.trim();
            
            // Editar link del botón
            Swal.fire({
                title: 'Editar Botón "Volver al sitio"',
                input: 'text',
                inputLabel: 'URL del enlace',
                inputValue: linkActual,
                inputPlaceholder: 'Ingrese la nueva URL del enlace',
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar'
            }).then((result2) => {
                if (result2.isConfirmed) {
                    if (result2.value && result2.value.trim() !== '') {
                        linkElemento.href = result2.value.trim();
                    } else {
                        linkElemento.href = '#';
                    }
                }
            });
        }
    });
}

// Función para agregar/quitar elementos
function toggleElements() {
    const element1 = document.getElementById('element-1');
    const element2 = document.getElementById('element-2');
    const element3 = document.getElementById('element-3');
    const element4 = document.getElementById('element-4');
    const toggleText = document.getElementById('toggle-elements-text');

    if (elementosVisibles === 1) {
        // Mostrar elemento 2
        element2.classList.remove('hidden');
        elementosVisibles = 2;
        toggleText.textContent = 'Agregar más elementos';
    } else if (elementosVisibles === 2) {
        // Mostrar elemento 3
        element3.classList.remove('hidden');
        elementosVisibles = 3;
        toggleText.textContent = 'Agregar más elementos';
    } else if (elementosVisibles === 3) {
        // Mostrar elemento 4
        element4.classList.remove('hidden');
        elementosVisibles = 4;
        toggleText.textContent = 'Quitar todos los elementos';
    } else if (elementosVisibles === 4) {
        // Ocultar todos los elementos
        element1.classList.add('hidden');
        element2.classList.add('hidden');
        element3.classList.add('hidden');
        element4.classList.add('hidden');
        elementosVisibles = 0;
        toggleText.textContent = 'Agregar elementos';
    } else {
        // Mostrar elemento 1 (volver al estado inicial)
        element1.classList.remove('hidden');
        element2.classList.add('hidden');
        element3.classList.add('hidden');
        element4.classList.add('hidden');
        elementosVisibles = 1;
        toggleText.textContent = 'Agregar más elementos';
    }
}

// Sincronizar los inputs de texto con los color pickers
document.addEventListener('DOMContentLoaded', function() {
    // Sincronizar color picker de botones
    const colorBotones = document.getElementById('color-botones');
    const colorBotonesText = document.getElementById('color-botones-text');
    
    if (colorBotones && colorBotonesText) {
        colorBotones.addEventListener('input', function() {
            colorBotonesText.value = this.value;
            aplicarColorBotones(this.value);
        });
        colorBotonesText.addEventListener('input', function() {
            if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                colorBotones.value = this.value;
                aplicarColorBotones(this.value);
            }
        });
    }

    // Sincronizar color picker de títulos
    const colorTitulos = document.getElementById('color-titulos');
    const colorTitulosText = document.getElementById('color-titulos-text');
    
    if (colorTitulos && colorTitulosText) {
        colorTitulos.addEventListener('input', function() {
            colorTitulosText.value = this.value;
            aplicarColorTitulos(this.value);
        });
        colorTitulosText.addEventListener('input', function() {
            if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                colorTitulos.value = this.value;
                aplicarColorTitulos(this.value);
            }
        });
    }

    // Sincronizar color picker de nota
    const colorNota = document.getElementById('color-nota');
    const colorNotaText = document.getElementById('color-nota-text');
    
    if (colorNota && colorNotaText) {
        colorNota.addEventListener('input', function() {
            colorNotaText.value = this.value;
            aplicarColorNota(this.value);
        });
        colorNotaText.addEventListener('input', function() {
            if (/^#[0-9A-F]{6}$/i.test(this.value)) {
                colorNota.value = this.value;
                aplicarColorNota(this.value);
            }
        });
    }
});

// Exportar funciones al scope global
window.editarIcono = editarIcono;
window.editarTitulo = editarTitulo;
window.editarNota = editarNota;
window.editarDeterminacion = editarDeterminacion;
window.editarInstrucciones = editarInstrucciones;
window.editarImagenElemento = editarImagenElemento;
window.editarBotonElemento = editarBotonElemento;
window.editarVolverSitio = editarVolverSitio;
window.toggleElements = toggleElements;
window.aplicarColorBotones = aplicarColorBotones;
window.aplicarColorTitulos = aplicarColorTitulos;
window.aplicarColorNota = aplicarColorNota;

