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
        
        // ⚠️ YA NO ES NECESARIO LLAMAR A init()
        // Los event listeners están configurados globalmente
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

// ==========================================================
// Utilidad global: forzar recarga a la página 1 por AJAX
// ==========================================================
if (!window.goToFirstPage) {
	window.goToFirstPage = async function(tabla) {
		try {
			// Evitar múltiples peticiones simultáneas por tabla
			window._paginationAbortControllers = window._paginationAbortControllers || {};
			if (window._paginationAbortControllers[tabla]) {
				window._paginationAbortControllers[tabla].abort();
			}
			const abortController = new AbortController();
			window._paginationAbortControllers[tabla] = abortController;

			// Localiza el wrapper correspondiente (id contiene el nombre de la tabla)
			const wrapper = document.querySelector(`.partial-wrapper[id*="${tabla}"]`);
			if (!wrapper) {
				console.warn('⚠️ No se encontró wrapper para la tabla:', tabla);
				return;
			}

			// Mapeo de tabla al parámetro de página correcto
			const pageParamMap = {
				'preguntas': 'page_preguntas',
				'frases': 'page_frases',
				'verbos': 'page_verbos'
			};
			const pageParam = pageParamMap[tabla] || 'page';

			// Busca cualquier enlace de paginación para obtener la URL base
			const nav = wrapper.querySelector('nav[aria-label="Pagination Navigation"]');
			let targetUrl;
			
			if (nav) {
				// Busca cualquier enlace de paginación (puede ser el primero, el anterior, etc.)
				const anyLink = nav.querySelector('a');
				if (anyLink) {
					const u = new URL(anyLink.href);
					// Elimina todos los parámetros de página existentes
					u.searchParams.delete('page_preguntas');
					u.searchParams.delete('page_frases');
					u.searchParams.delete('page_verbos');
					u.searchParams.delete('page');
					// Establece el parámetro correcto a 1
					u.searchParams.set(pageParam, '1');
					u.searchParams.set('tabla', tabla);
					targetUrl = u.toString();
				} else {
					// Si no hay enlaces, construye desde la URL actual
					const u = new URL(window.location.href);
					u.searchParams.delete('page_preguntas');
					u.searchParams.delete('page_frases');
					u.searchParams.delete('page_verbos');
					u.searchParams.delete('page');
					u.searchParams.set(pageParam, '1');
					u.searchParams.set('tabla', tabla);
					targetUrl = u.toString();
				}
			} else {
				// Fallback: construye desde la URL actual
				const u = new URL(window.location.href);
				u.searchParams.delete('page_preguntas');
				u.searchParams.delete('page_frases');
				u.searchParams.delete('page_verbos');
				u.searchParams.delete('page');
				u.searchParams.set(pageParam, '1');
				u.searchParams.set('tabla', tabla);
				targetUrl = u.toString();
			}

			console.log('🔄 Forzando página 1 para tabla:', tabla, 'URL:', targetUrl);

			const res = await fetch(targetUrl, {
				headers: { 'X-Requested-With': 'XMLHttpRequest' },
				signal: abortController.signal
			});
			if (!res.ok) {
				console.error('❌ Error HTTP al cargar página 1:', res.status);
				return;
			}

			const html = await res.text();
			wrapper.innerHTML = html;

			console.log('✅ Página 1 cargada correctamente para tabla:', tabla);

			// Scroll suave al inicio del wrapper
			setTimeout(() => {
				const rect = wrapper.getBoundingClientRect();
				const scrollPos = rect.top + window.scrollY - 100;
				window.scrollTo({ top: scrollPos, behavior: 'smooth' });
			}, 150);
		} catch (err) {
			if (err.name === 'AbortError') {
				console.log('⏹️ Petición de paginación abortada para tabla:', tabla);
				return;
			}
			console.error('💥 Error forzando página 1:', err);
		}
	};
}