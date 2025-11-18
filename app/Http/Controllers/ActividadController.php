<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::table('actividades')->insert([
            'nota_id' => $request->nota_id,
            'descripcion' => $request->descripcion,
            'completada' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('notas.index')
                         ->with('success', 'Actividad agregada exitosamente.');
    }

    public function edit($id)
    {
        $actividad = DB::table('actividades')->where('id', $id)->first();

        return view('actividades.edit', compact('actividad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
        ]);

        DB::table('actividades')
            ->where('id', $id)
            ->update([
                'descripcion' => $request->descripcion,
                'updated_at' => now(),
            ]);

        return redirect()->route('notas.index')->with('success', 'Actividad actualizada.');
    }

    public function toggleComplete($id)
    {
        // Obtener estado actual
        $actividad = DB::table('actividades')->where('id', $id)->first();

        DB::table('actividades')
            ->where('id', $id)
            ->update([
                'completada' => !$actividad->completada,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Estado de actividad cambiado.');
    }

    public function destroy($id)
    {
        DB::table('actividades')->where('id', $id)->delete();

        return back()->with('success', 'Actividad eliminada.');
    }
}
