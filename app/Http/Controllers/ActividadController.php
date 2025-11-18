<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
    public function create()
    {
        $nota_id = request('nota_id');
        
        return view('actividades.create', ['nota_id' => $nota_id]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nota_id' => 'required|exists:notas,id',
            'descripcion' => 'required|string|max:255',
        ]);

        Actividad::create([
            'nota_id' => $request->nota_id,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('notas.index')
                         ->with('success', 'Actividad agregada exitosamente.');
    }

    public function edit(Actividad $actividad)
    {
        return view('actividades.edit', compact('actividad'));
    }

    public function update(Request $request, Actividad $actividad)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        $actividad->update([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('notas.index')->with('success', 'Actividad actualizada.');
    }

    public function toggleComplete(Actividad $actividad)
    {
        $actividad->completada = !$actividad->completada;
        $actividad->save();

        return back()->with('success', 'Estado de actividad cambiado.');
    }

    public function destroy(Actividad $actividad)
    {
        $actividad->delete();
        
        return back()->with('success', 'Actividad eliminada.');
    }

    public function index()
    {
        //
    }
    public function show(Actividad $actividad)
    {
        //
    }
}