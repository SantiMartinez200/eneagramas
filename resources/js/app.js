// resources/js/app.js

// ✅ CARGAR SWEETALERT2 PRIMERO
import Swal from 'sweetalert2';
window.Swal = Swal;

// ✅ CARGAR UTILIDADES (dependen de Swal)
import './sweetAlerts.js';
import './errorInputs.js';

// ✅ CARGAR MÓDULOS DE ENEAGRAMAS
import './eneagramas/crearFrase.js';
import './eneagramas/crearPregunta.js';
import './eneagramas/crearVerbo.js';
import './eneagramas/paginacionPreguntas.js';

console.log('✅ App.js cargado - Módulos importados');

// ============================================
// 🔥 DEBUG: Verificar después de navegación
// ============================================
document.addEventListener('livewire:navigated', () => {
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    console.log('🔄 LIVEWIRE NAVEGÓ - Verificando...');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    
    // Verificar qué botones hay en el DOM
    const btnCrear = document.querySelector('.btn-crear');
    const btnCrearFrase = document.querySelector('.btn-crear-frase');
    const btnCrearVerbo = document.querySelector('.btn-crear-verbo');
    
    console.log('🔍 Botones encontrados:', {
        'btn-crear (preguntas)': !!btnCrear,
        'btn-crear-frase': !!btnCrearFrase,
        'btn-crear-verbo': !!btnCrearVerbo
    });
    
    // Verificar inputs
    const inputPregunta = document.querySelector('input[name="nueva_pregunta"]');
    const inputFrase = document.querySelector('input[name="nueva_frase"]');
    const inputVerbo = document.querySelector('input[name="nuevo_verbo"]');
    const eneagramaId = document.querySelector('input[name="eneagrama_usuario_id"]');
    
    console.log('📝 Inputs encontrados:', {
        'nueva_pregunta': !!inputPregunta,
        'nueva_frase': !!inputFrase,
        'nuevo_verbo': !!inputVerbo,
        'eneagrama_usuario_id': !!eneagramaId,
        'eneagrama_id_value': eneagramaId?.value || 'N/A'
    });
    
    // Verificar que los handlers estén disponibles
    console.log('🎯 Handlers disponibles:', {
        '_handleClickPregunta': typeof window._handleClickPregunta !== 'undefined',
        '_handleClickFrase': typeof window._handleClickFrase !== 'undefined',
        '_handleClickVerbo': typeof window._handleClickVerbo !== 'undefined'
    });
    
    console.log('✅ Event listeners están activos (delegación global)');
    console.log('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n');
});

// Verificación inicial
document.addEventListener('DOMContentLoaded', () => {
    console.log('⚡ DOM cargado inicialmente');
    console.log('✅ SweetAlert2:', typeof Swal !== 'undefined' ? 'OK' : 'ERROR');
    console.log('✅ fireSweetAlert2Simple:', typeof window.fireSweetAlert2Simple !== 'undefined' ? 'OK' : 'ERROR');
});