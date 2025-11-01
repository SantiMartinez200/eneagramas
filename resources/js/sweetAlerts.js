// resources/js/sweetAlerts.js

window.fireSweetAlert2Simple = function(tipo, titulo, mensaje, timer = null, toast = false) {
    Swal.fire({
        icon: tipo,
        title: titulo,
        text: mensaje,
        timer: timer,
        toast: toast,
        showConfirmButton: !toast
    });
}

window.fireSweetAlert2Html = function(tipo, titulo, mensaje, timer = null, toast = false) {
    Swal.fire({
        icon: tipo,
        title: titulo,
        html: mensaje,
        timer: timer,
        toast: toast,
        showConfirmButton: !toast
    });
}

window.fireSweetAlert2Buttons = function(tipo, titulo, mensaje, timer = null, toast = false) {
    Swal.fire({
        icon: tipo,
        title: titulo,
        text: mensaje,
        timer: timer,
        toast: toast,
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    });
}
