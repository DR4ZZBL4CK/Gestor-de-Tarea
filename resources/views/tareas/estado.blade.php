@extends('layouts.app')

@section('title', 'Vista por Estado')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-semibold mb-6">Vista por Estado</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
       
        <div class="bg-white/10 rounded-2xl p-5 shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Pendientes</h3>
                <span class="text-sm bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full">{{ $pendientes->count() }}</span>
            </div>

            <div class="space-y-3">
                @forelse($pendientes as $t)
                    <div class="bg-white rounded-lg p-4 text-sm text-gray-700">
                        <div class="font-medium">{{ $t->titulo }}</div>
                        <div class="text-xs text-gray-500 mt-1">Vence: {{ $t->fecha_vencimiento ? \Carbon\Carbon::parse($t->fecha_vencimiento)->format('d/m/Y') : 'Sin fecha' }}</div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">No hay tareas pendientes.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white/10 rounded-2xl p-5 shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">En Progreso</h3>
                <span class="text-sm bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full">{{ $enProgreso->count() }}</span>
            </div>

            <div class="space-y-3">
                @forelse($enProgreso as $t)
                    <div class="bg-white rounded-lg p-4 text-sm text-gray-700">
                        <div class="font-medium">{{ $t->titulo }}</div>
                        <div class="text-xs text-gray-500 mt-1">Vence: {{ $t->fecha_vencimiento ? \Carbon\Carbon::parse($t->fecha_vencimiento)->format('d/m/Y') : 'Sin fecha' }}</div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">No hay tareas en progreso.</p>
                @endforelse
            </div>
        </div>

      
        <div class="bg-white/10 rounded-2xl p-5 shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold">Completadas</h3>
                <span class="text-sm bg-green-100 text-green-800 px-3 py-1 rounded-full">{{ $completadas->count() }}</span>
            </div>

            <div class="space-y-3">
                @forelse($completadas as $t)
                    <div class="bg-white rounded-lg p-4 text-sm text-gray-700">
                        <div class="font-medium">{{ $t->titulo }}</div>
                        <div class="text-xs text-gray-500 mt-1">Completada: {{ $t->updated_at ? \Carbon\Carbon::parse($t->updated_at)->format('d/m/Y') : '-' }}</div>
                    </div>
                @empty
                    <p class="text-sm text-gray-400">No hay tareas completadas.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('tareas.index') }}" class="px-4 py-2 bg-white text-purple-600 rounded-lg">Volver</a>
    </div>
</div>
@endsection