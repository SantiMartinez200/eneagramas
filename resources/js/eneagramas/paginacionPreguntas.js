document.addEventListener('click', async function (e) {
    // busca links dentro del nav de paginación
    const link = e.target.closest('nav[aria-label="Pagination Navigation"] a');
    if (!link) return;

    console.log('🔗 Click detectado en link de paginación:', link.href);
    e.preventDefault();

    // detecta el contenedor parcial más cercano
    const wrapper = link.closest('.partial-wrapper');
    if (!wrapper) {
        console.warn('⚠️ No se encontró .partial-wrapper');
        return;
    }
    console.log('📦 Wrapper detectado:', wrapper.id);

    // determina qué tabla es
    const tabla =
        wrapper.id.includes('preguntas') ? 'preguntas' :
        wrapper.id.includes('frases') ? 'frases' :
        wrapper.id.includes('verbos') ? 'verbos' : '';

    console.log('📋 Tabla detectada:', tabla);

    // agrega parámetro de tabla
    const url = `${link.href}${link.href.includes('?') ? '&' : '?'}tabla=${tabla}`;
    console.log('🌐 URL final:', url);

    try {
        const res = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        if (!res.ok) {
            console.error('❌ Error HTTP:', res.status);
            return;
        }

        const html = await res.text();
        wrapper.innerHTML = html;
        console.log('✅ Partial actualizado correctamente.');

        // Esperamos al render antes de scrollear
        setTimeout(() => {
            const rect = wrapper.getBoundingClientRect();
            const scrollPos = rect.top + window.scrollY - 100;

            console.log('📏 Posición wrapper:', rect.top);
            console.log('🧭 Scroll final:', scrollPos);

            window.scrollTo({
                top: scrollPos,
                behavior: 'smooth'
            });

            console.log('🌀 Scroll ejecutado.');
        }, 250);
    } catch (err) {
        console.error('💥 Error en fetch/render:', err);
    }
});
