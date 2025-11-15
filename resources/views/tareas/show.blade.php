@extends('layouts.app')

@section('title', $tarea->titulo)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl overflow-hidden">
        <!-- Header con gradiente -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-8 text-white">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                <div class="flex-1">
                    <h1 class="text-3xl font-bold mb-2">{{ $tarea->titulo }}</h1>
                    <p class="text-white/80 text-lg">{{ $tarea->descripcion ?: 'Sin descripción' }}</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <span class="px-4 py-2 bg-white/20 rounded-full text-sm font-semibold">
                        <i class="fas fa-flag mr-1"></i>{{ ucfirst($tarea->prioridad) }}
                    </span>
                    <span class="px-4 py-2 bg-white/20 rounded-full text-sm font-semibold">
                        <i class="fas fa-circle mr-1"></i>{{ ucfirst($tarea->estado) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Detalles -->
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Información Principal -->
                <div class="space-y-6">
                    <div class="glass-effect rounded-2xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>Información General
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-white/10">
                                <span class="text-white/70">Estado:</span>
                                <span class="font-semibold text-white">{{ ucfirst($tarea->estado) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/10">
                                <span class="text-white/70">Prioridad:</span>
                                <span class="font-semibold text-white">{{ ucfirst($tarea->prioridad) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/10">
                                <span class="text-white/70">Categoría:</span>
                                <span class="font-semibold text-white">{{ $tarea->categoria ?: 'Sin categoría' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fechas -->
                <div class="space-y-6">
                    <div class="glass-effect rounded-2xl p-6">
                        <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>Fechas
                        </h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center py-2 border-b border-white/10">
                                <span class="text-white/70">Creada:</span>
                                <span class="font-semibold text-white">{{ $tarea->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/10">
                                <span class="text-white/70">Actualizada:</span>
                                <span class="font-semibold text-white">{{ $tarea->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-white/70">Vence:</span>
                                <span class="font-semibold text-white">
                                    {{ $tarea->fecha_vencimiento ? $tarea->fecha_vencimiento->format('d/m/Y') : 'Sin fecha' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4 pt-8">
                <a href="{{ route('tareas.edit', $tarea) }}" 
                   class="px-6 py-3 bg-yellow-500 text-white rounded-xl font-semibold hover:bg-yellow-600 transition duration-300 text-center">
                    <i class="fas fa-edit mr-2"></i>Editar Tarea
                </a>
                <form action="{{ route('tareas.destroy', $tarea) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-6 py-3 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition duration-300 text-center"
                            onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                        <i class="fas fa-trash mr-2"></i>Eliminar Tarea
                    </button>
                </form>
                <a href="{{ route('tareas.index') }}" 
                   class="px-6 py-3 bg-white/20 text-white rounded-xl font-semibold hover:bg-white/30 transition duration-300 text-center">
                    <i class="fas fa-arrow-left mr-2"></i>Volver al Listado
                </a>
            </div>
        </div>
    </div>
</div>
@endsection