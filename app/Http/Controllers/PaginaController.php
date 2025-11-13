<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'styles' => 'required',
            'descripcion' => 'required|string|max:255',
        ]);

        $pagina = Pagina::create($validated);

        return redirect()->route('paginas.index')->with('success', 'Pagina creada exitosamente.');
    }
}
