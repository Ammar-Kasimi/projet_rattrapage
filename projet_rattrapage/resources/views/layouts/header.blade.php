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
            
            <a href="{{ route('events.index') }}" class="text-xl font-bold text-blue-600">
                BénévolatHub
            </a>

            <div>
                @auth
                    <span class="text-gray-600 mr-4">Bonjour, {{ Auth::user()->name }}</span>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline font-medium">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline mr-4 font-medium">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 font-medium">S'inscrire</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    

</body>
</html>