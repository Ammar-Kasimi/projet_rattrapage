<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Bénévolat</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900 flex flex-col min-h-screen">

    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            
            <a href="{{ route('events.index') }}" class="text-xl font-bold text-blue-600 shrink-0">
                BénévolatHub
            </a>

            <div class="hidden md:flex items-center space-x-6 mx-6">
                <a href="{{ route('events.index') }}" class="text-gray-600 hover:text-blue-600 font-medium transition">
                    Événements
                </a>

                @auth
                    @if(Auth::user()->role === 'volunteer')
                        <a href="{{ route('participations.index') }}" class="text-gray-600 hover:text-blue-600 font-medium flex items-center gap-1 transition">
                            📅 Mon Planning
                        </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        @endif
                @endauth
            </div>

            <div class="flex items-center">
                @auth
                    <a href="{{ route('users.edit',Auth::user()) }}" class="text-gray-600 hover:text-blue-600 mr-4 text-sm font-medium flex items-center gap-1 transition">
                        👤 {{ Auth::user()->username }}
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="text-red-600 hover:underline font-medium transition">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline mr-4 font-medium transition">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium transition">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

</body>
</html>