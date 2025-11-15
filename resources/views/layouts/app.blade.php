<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestor de Tareas Pro')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .task-card {
            transition: all 0.3s ease;
            transform: translateY(0);
        }
        
        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .floating-btn {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body class="min-h-screen gradient-bg">
    <!-- Navbar -->
    <nav class="glass-effect shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-lg">
                        <i class="fas fa-tasks text-purple-600 text-xl"></i>
                    </div>
                    <span class="text-white font-bold text-xl">TaskFlow</span>
                </div>
                
                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('tareas.index') }}" 
                       class="text-white hover:text-purple-200 transition duration-300 font-medium">
                        <i class="fas fa-home mr-2"></i>Inicio
                    </a>
                    <a href="{{ route('tareas.create') }}" 
                       class="bg-white text-purple-600 px-4 py-2 rounded-lg font-semibold hover:bg-purple-50 transition duration-300 shadow-lg">
                        <i class="fas fa-plus mr-2"></i>Nueva Tarea
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-8">
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-6">
                <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg animate-pulse">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-xl"></i>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Floating Action Button (Mobile) -->
    <div class="md:hidden fixed bottom-6 right-6">
        <a href="{{ route('tareas.create') }}" 
           class="floating-btn w-14 h-14 bg-white rounded-full shadow-2xl flex items-center justify-center text-purple-600 text-xl hover:bg-purple-50 transition duration-300">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <!-- Footer -->
    <footer class="glass-effect mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <div class="text-center text-white">
                <p class="text-sm opacity-80">
                    
                    2025 Gestor de tarea. todos los derechos reservados
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Animaciones adicionales
        document.addEventListener('DOMContentLoaded', function() {
            // Efecto de aparición suave para las tarjetas
            const cards = document.querySelectorAll('.task-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>