@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fas fa-edit text-purple-600 text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Editar Tarea</h2>
            <p class="text-white/70 mt-2">Actualiza los detalles de tu tarea</p>
        </div>

        <form action="{{ route('tareas.update', $tarea) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Título -->
            <div class="glass-effect rounded-2xl p-6">
                <label for="titulo" class="block text-sm font-medium text-white mb-3">
                    <i class="fas fa-heading mr-2"></i>Título de la Tarea *
                </label>
                <input type="text" 
                       id="titulo" 
                       name="titulo" 
                       value="{{ old('titulo', $tarea->titulo) }}"
                       class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition duration-300"
                       placeholder="Ej: Reunión de equipo..."
                       required>
            </div>

            <!-- Descripción -->
            <div class="glass-effect rounded-2xl p-6">
                <label for="descripcion" class="block text-sm font-medium text-white mb-3">
                    <i class="fas fa-align-left mr-2"></i>Descripción
                </label>
                <textarea id="descripcion" 
                          name="descripcion" 
                          rows="4"
                          class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition duration-300"
                          placeholder="Describe los detalles de la tarea...">{{ old('descripcion', $tarea->descripcion) }}</textarea>
            </div>

            <!-- Estado y Prioridad -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="glass-effect rounded-2xl p-6">
                    <label for="estado" class="block text-sm font-medium text-white mb-3">
                        <i class="fas fa-play-circle mr-2"></i>Estado *
                    </label>
                    <select id="estado" 
                            name="estado"
                            class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition duration-300"
                            required>
                        <option value="pendiente" {{ old('estado', $tarea->estado) == 'pendiente' ? 'selected' : '' }}>⏳ Pendiente</option>
                        <option value="en progreso" {{ old('estado', $tarea->estado) == 'en progreso' ? 'selected' : '' }}>🚀 En Progreso</option>
                        <option value="completada" {{ old('estado', $tarea->estado) == 'completada' ? 'selected' : '' }}>✅ Completada</option>
                    </select>
                </div>

                <div class="glass-effect rounded-2xl p-6">
                    <label for="prioridad" class="block text-sm font-medium text-white mb-3">
                        <i class="fas fa-flag mr-2"></i>Prioridad *
                    </label>
                    <select id="prioridad" 
                            name="prioridad"
                            class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition duration-300"
                            required>
                        <option value="baja" {{ old('prioridad', $tarea->prioridad) == 'baja' ? 'selected' : '' }}>🟢 Baja</option>
                        <option value="media" {{ old('prioridad', $tarea->prioridad) == 'media' ? 'selected' : '' }}>🟡 Media</option>
                        <option value="alta" {{ old('prioridad', $tarea->prioridad) == 'alta' ? 'selected' : '' }}>🔴 Alta</option>
                    </select>
                </div>
            </div>

            <!-- Categoría y Fecha -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="glass-effect rounded-2xl p-6">
                    <label for="categoria" class="block text-sm font-medium text-white mb-3">
                        <i class="fas fa-tag mr-2"></i>Categoría
                    </label>
                    <input type="text" 
                           id="categoria" 
                           name="categoria" 
                           value="{{ old('categoria', $tarea->categoria) }}"
                           class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition duration-300"
                           placeholder="Ej: Trabajo, Personal...">
                </div>

                <div class="glass-effect rounded-2xl p-6">
                    <label for="fecha_vencimiento" class="block text-sm font-medium text-white mb-3">
                        <i class="fas fa-calendar-day mr-2"></i>Fecha de Vencimiento
                    </label>
                    <input type="date" 
                           id="fecha_vencimiento" 
                           name="fecha_vencimiento" 
                           value="{{ old('fecha_vencimiento', $tarea->fecha_vencimiento ? $tarea->fecha_vencimiento->format('Y-m-d') : '') }}"
                           class="w-full px-4 py-3 rounded-xl border border-white/20 bg-white/10 text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent transition duration-300">
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                <a href="{{ route('tareas.index') }}" 
                   class="px-8 py-3 bg-white/20 text-white rounded-xl font-semibold hover:bg-white/30 transition duration-300 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>Cancelar
                </a>
                <button type="submit" 
                        class="px-8 py-3 bg-green-500 text-white rounded-xl font-semibold hover:bg-green-600 transition duration-300 text-center">
                    <i class="fas fa-save mr-2"></i>Actualizar Tarea
                </button>
            </div>
        </form>
    </div>
</div>
@endsection