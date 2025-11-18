<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TareaController extends Controller
{
   
    public function index(Request $request)
    {
       $query = Tarea::latest();

        // ✅ Filtro por Estado
        if ($request->filled('estado') && $request->estado !== 'todos') {
            $query->where('estado', $request->estado);
        }

        // ✅ Filtro por Prioridad
        if ($request->filled('prioridad') && $request->prioridad !== 'todas') {
            $query->where('prioridad', $request->prioridad);
        }

        // ✅ Filtro por Vencimiento
        if ($request->filled('vencimiento')) {
            $hoy = Carbon::now()->startOfDay();
            $finSemana = Carbon::now()->addDays(7)->endOfDay();

            switch ($request->vencimiento) {
                case 'vencidas':
                    $query->where('fecha_vencimiento', '<', $hoy)
                          ->where('estado', '!=', 'completada');
                    break;
                case 'hoy':
                    $query->whereDate('fecha_vencimiento', $hoy);
                    break;
                case 'semana':
                    $query->whereBetween('fecha_vencimiento', [$hoy, $finSemana]);
                    break;
            }
        }

        $tareas = $query->get();
        
        return view('tareas.index', compact('tareas'));
    }

    
    public function create()
    {
        return view('tareas.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:pendiente,en progreso,completada',
            'categoria' => 'nullable|string|max:100',
            'fecha_vencimiento' => 'nullable|date',
            'prioridad' => 'required|in:baja,media,alta',
        ]);

        Tarea::create($validated);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea creada exitosamente.');
    }

   
    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

   
    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    
    public function update(Request $request, Tarea $tarea)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:pendiente,en progreso,completada',
            'categoria' => 'nullable|string|max:100',
            'fecha_vencimiento' => 'nullable|date',
            'prioridad' => 'required|in:baja,media,alta',
        ]);

        $tarea->update($validated);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea actualizada exitosamente.');
    }

     public function porEstado()
    {
        $tareas = Tarea::orderBy('fecha_vencimiento')->get();
        $pendientes = $tareas->where('estado', 'pendiente');
        $enProgreso = $tareas->where('estado', 'en progreso');
        $completadas = $tareas->where('estado', 'completada');

        return view('tareas.estado', compact('pendientes', 'enProgreso', 'completadas'));
    }

    
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada exitosamente.');
    }
}