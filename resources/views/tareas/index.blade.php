@extends('layouts.app')

@section('title', 'Dashboard - Mis Tareas')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="glass-effect rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Total Tareas</p>
                    <p class="text-3xl font-bold">{{ $tareas->count() }}</p>
                </div>
                <i class="fas fa-tasks text-2xl opacity-60"></i>
            </div>
        </div>
        
        <div class="glass-effect rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Pendientes</p>
                    <p class="text-3xl font-bold">{{ $tareas->where('estado', 'pendiente')->count() }}</p>
                </div>
                <i class="fas fa-clock text-2xl opacity-60"></i>
            </div>
        </div>
        
        <div class="glass-effect rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">En Progreso</p>
                    <p class="text-3xl font-bold">{{ $tareas->where('estado', 'en progreso')->count() }}</p>
                </div>
                <i class="fas fa-spinner text-2xl opacity-60"></i>
            </div>
        </div>
        
        <div class="glass-effect rounded-2xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80">Completadas</p>
                    <p class="text-3xl font-bold">{{ $tareas->where('estado', 'completada')->count() }}</p>
                </div>
                <i class="fas fa-check-circle text-2xl opacity-60"></i>
            </div>
        </div>
    </div>

    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl p-6 mb-6">
        <form method="GET" action="{{ route('tareas.index') }}" id="filterForm">
            <div class="flex flex-col md:flex-row gap-4">
                
             
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-white/50"></i>
                    </div>
                    <input 
                        type="text" 
                        id="buscarInput" 
                        name="buscar" 
                        value="{{ request('buscar') }}"
                        placeholder="Buscar tareas..."
                        class="w-full pl-12 pr-4 py-3 bg-white/20 border border-white/30 rounded-xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/50 transition duration-300"
                    >
                </div>

              
                <div class="relative">
                    <select 
                        name="estado" 
                        id="estadoFiltro"
                        onchange="document.getElementById('filterForm').submit()"
                        class="appearance-none pl-10 pr-10 py-3 bg-white/20 border border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 transition duration-300 cursor-pointer">
                        <option value="todos" class="bg-purple-900">📊 Estado</option>
                        <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }} class="bg-purple-900">⏳ Pendientes</option>
                        <option value="en progreso" {{ request('estado') === 'en progreso' ? 'selected' : '' }} class="bg-purple-900">🔄 En Progreso</option>
                        <option value="completada" {{ request('estado') === 'completada' ? 'selected' : '' }} class="bg-purple-900">✅ Completadas</option>
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-filter text-white/50"></i>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-white/50 text-sm"></i>
                    </div>
                </div>

                
                <div class="relative">
                    <select 
                        name="prioridad" 
                        id="prioridadFiltro"
                        onchange="document.getElementById('filterForm').submit()"
                        class="appearance-none pl-10 pr-10 py-3 bg-white/20 border border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 transition duration-300 cursor-pointer">
                        <option value="todas" class="bg-purple-900">⚡ Prioridad</option>
                        <option value="alta" {{ request('prioridad') === 'alta' ? 'selected' : '' }} class="bg-purple-900">🔴 Alta</option>
                        <option value="media" {{ request('prioridad') === 'media' ? 'selected' : '' }} class="bg-purple-900">🟡 Media</option>
                        <option value="baja" {{ request('prioridad') === 'baja' ? 'selected' : '' }} class="bg-purple-900">🟢 Baja</option>
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-flag text-white/50"></i>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-white/50 text-sm"></i>
                    </div>
                </div>

               
                <div class="relative">
                    <select 
                        name="vencimiento" 
                         id="vencimientoFiltro"
                        onchange="document.getElementById('filterForm').submit()"
                        class="appearance-none pl-10 pr-10 py-3 bg-white/20 border border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 transition duration-300 cursor-pointer">
                        <option value="" class="bg-purple-900">📅 Fecha</option>
                        <option value="vencidas" {{ request('vencimiento') === 'vencidas' ? 'selected' : '' }} class="bg-purple-900">⚠️ Vencidas</option>
                        <option value="hoy" {{ request('vencimiento') === 'hoy' ? 'selected' : '' }} class="bg-purple-900">📌 Hoy</option>
                        <option value="semana" {{ request('vencimiento') === 'semana' ? 'selected' : '' }} class="bg-purple-900">📆 Esta semana</option>
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-calendar text-white/50"></i>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-white/50 text-sm"></i>
                    </div>
                </div>

                
               
                @if(request()->hasAny(['buscar', 'estado', 'prioridad', 'vencimiento']))
                    <a 
                        href="{{ route('tareas.index') }}"
                        class="px-6 py-3 bg-red-500/80 text-white rounded-xl font-semibold hover:bg-red-600 transition duration-300 shadow-lg whitespace-nowrap flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>Limpiar
                    </a>
                @endif
            </div>
        </form>
    </div>

  
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl p-6">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-white">
                <i class="fas fa-list-check mr-3"></i>Mis Tareas
            </h2>
            
            <div class="flex space-x-3">
                <a href="{{ route('tareas.create') }}" 
                   class="hidden md:inline-flex items-center px-6 py-3 bg-white text-purple-600 rounded-xl font-semibold hover:bg-purple-50 transition duration-300 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Nueva Tarea
                </a>
            </div>
        </div>

        @if($tareas->count() > 0)
            <div  id="tareasContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tareas as $tarea)
                    <div class="task-card bg-white rounded-2xl shadow-lg overflow-hidden border-l-4 
                        @if($tarea->estado == 'pendiente') border-red-500
                        @elseif($tarea->estado == 'en progreso') border-yellow-500
                        @else border-green-500
                        @endif"
                        data-titulo="{{ strtolower($tarea->titulo) }}"
                        data-descripcion="{{ strtolower($tarea->descripcion ?? '') }}"
                        data-categoria="{{ strtolower($tarea->categoria ?? '') }}"
                        data-estado="{{ strtolower($tarea->estado) }}"
                        data-prioridad="{{ strtolower($tarea->prioridad) }}">
                        
                        <div class="p-6">
                            
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $tarea->titulo }}</h3>
                                <span class="text-xs px-3 py-1 rounded-full font-semibold
                                    @if($tarea->prioridad == 'alta') bg-red-100 text-red-800
                                    @elseif($tarea->prioridad == 'media') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    <i class="fas fa-flag mr-1"></i>{{ ucfirst($tarea->prioridad) }}
                                </span>
                            </div>

                            <p class="text-gray-600 mb-4 text-sm leading-relaxed">
                                {{ $tarea->descripcion ?: 'Sin descripción' }}
                            </p>

                           
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-tag mr-2"></i>
                                    <span>{{ $tarea->categoria ?: 'Sin categoría' }}</span>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $tarea->fecha_vencimiento ? $tarea->fecha_vencimiento->format('d/m/Y') : 'Sin fecha' }}</span>
                                </div>
                                
                                <div class="flex items-center text-sm">
                                    <i class="fas fa-circle mr-2 
                                        @if($tarea->estado == 'pendiente') text-red-500
                                        @elseif($tarea->estado == 'en progreso') text-yellow-500
                                        @else text-green-500
                                        @endif"></i>
                                    <span class="font-medium">{{ ucfirst($tarea->estado) }}</span>
                                </div>
                            </div>

                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <div class="flex space-x-2">
                                    <a href="{{ route('tareas.show', $tarea) }}" 
                                       class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-200 transition duration-300">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('tareas.edit', $tarea) }}" 
                                       class="w-8 h-8 bg-green-100 text-green-600 rounded-lg flex items-center justify-center hover:bg-green-200 transition duration-300">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                </div>
                                
                                <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-8 h-8 bg-red-100 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-200 transition duration-300"
                                            onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
           
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-inbox text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white mb-2">No hay tareas registradas</h3>
                <p class="text-white/70 mb-6">Comienza organizando tus tareas creando la primera</p>
                <a href="{{ route('tareas.create') }}" 
                   class="inline-flex items-center px-8 py-3 bg-white text-purple-600 rounded-xl font-semibold hover:bg-purple-50 transition duration-300 shadow-lg">
                    <i class="fas fa-plus mr-2"></i>Crear primera tarea
                </a>
            </div>
        @endif
    </div>
</div>


<script>
    
    const estadoFiltro = document.getElementById('estadoFiltro').value || '';
    const prioridadFiltro = document.getElementById('prioridadFiltro').value || '';
    const vencimientoFiltro = document.getElementById('vencimientoFiltro').value || '';

    const buscarInput = document.getElementById('buscarInput');
    const tareasContainer = document.getElementById('tareasContainer');
    const tarjetas = document.querySelectorAll('.task-card');

    buscarInput.addEventListener('input', (e) => {
        const busqueda = e.target.value.toLowerCase();
        let tarjetasVisiblesCount = 0;

        tarjetas.forEach(tarjeta => {
            const titulo = tarjeta.getAttribute('data-titulo');
            const descripcion = tarjeta.getAttribute('data-descripcion');
            const categoria = tarjeta.getAttribute('data-categoria');
            const estado = tarjeta.getAttribute('data-estado');
            const prioridad = tarjeta.getAttribute('data-prioridad');

            const coincideTexto = titulo.includes(busqueda) || 
                                descripcion.includes(busqueda) || 
                                categoria.includes(busqueda);

           
            const coincideEstado = estadoFiltro === 'todos' || estadoFiltro === '' || estado === estadoFiltro;
            const coincidePrioridad = prioridadFiltro === 'todas' || prioridadFiltro === '' || prioridad === prioridadFiltro;

            
            const mostrar = coincideTexto && coincideEstado && coincidePrioridad;
            tarjeta.style.display = mostrar ? 'block' : 'none';

            if (mostrar) tarjetasVisiblesCount++;
        });

        if (tarjetasVisiblesCount === 0 && busqueda.length > 0) {
            if (!document.getElementById('noResults')) {
                const mensaje = document.createElement('div');
                mensaje.id = 'noResults';
                mensaje.className = 'col-span-full text-center py-8';
                mensaje.innerHTML = '<p class="text-white/70 text-lg">No se encontraron tareas que coincidan con tu búsqueda</p>';
                tareasContainer.appendChild(mensaje);
            }
        } else {
            const noResults = document.getElementById('noResults');
            if (noResults) noResults.remove();
        }
    });
</script>

@endsection