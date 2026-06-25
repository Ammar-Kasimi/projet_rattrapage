<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme de Bénévolat</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        .font-display { font-family: 'Fraunces', Georgia, serif; }
        .brand-stripe {
            height: 6px;
            background: repeating-linear-gradient(45deg, #0f766e 0 10px, #b45309 10px 20px);
        }
    </style>
</head>
<body class="bg-stone-50 text-stone-900 flex flex-col min-h-screen antialiased">

    <nav class="bg-white border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

            <a href="{{ route('events.index') }}" class="flex items-center gap-2 text-xl font-display font-bold text-teal-800 shrink-0">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-teal-700 text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2.5 5.5L20 9l-4 4 1 6-5-3-5 3 1-6-4-4 5.5-1.5z"></path>
                    </svg>
                </span>
                Tous Engagés
            </a>

            <div class="hidden md:flex items-center space-x-6 mx-6">
                <a href="{{ route('events.index') }}" class="text-stone-600 hover:text-teal-700 font-medium transition">
                    Événements
                </a>

                @auth
                    @if(Auth::user()->role === 'volunteer')
                        <a href="{{ route('participations.index') }}" class="text-stone-600 hover:text-teal-700 font-medium flex items-center gap-1 transition">
                            📅 Mon Planning
                        </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-stone-600 hover:text-teal-700 font-medium flex items-center gap-1 transition">
                            ⚙️ Tableau de Bord
                        </a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center">
                @auth
                    <a href="{{ route('users.edit', Auth::user()) }}" class="flex items-center gap-2 mr-3 rounded-lg px-2 py-1.5 text-sm font-medium text-stone-600 hover:bg-stone-50 hover:text-teal-700 transition">
                        @if(Auth::user()->pic)
                            <img src="{{ asset('storage/' . Auth::user()->pic) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover ring-2 ring-teal-100">
                        @else
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-teal-50 text-base">👤</span>
                        @endif

                        {{ Auth::user()->username }}
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        @method('POST')
                        <button type="submit" class="rounded-lg px-3 py-1.5 text-sm font-medium text-rose-600 hover:bg-rose-50 transition">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-3 text-sm font-medium text-teal-700 hover:text-teal-800 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-teal-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-teal-800 transition">S'inscrire</a>
                @endauth
            </div>
        </div>
        <div class="brand-stripe"></div>
    </nav>

    <main class="flex-grow bg-stone-50">
        @yield('content')
    </main>

</body>
</html>
