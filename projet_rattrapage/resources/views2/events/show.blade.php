@extends('layouts.header')

@section('content')
<div class="container px-4 py-6 mx-auto max-w-5xl">
    @if(Auth::check() && Auth::user()->role=='admin')
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 hover:underline inline-flex items-center gap-1 font-medium text-sm">
            &larr; Retour au dashboard
        </a>
    </div>
    @else
    <div class="mb-4">
        <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline inline-flex items-center gap-1 font-medium text-sm">
            &larr; Retour aux événements
        </a>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 text-sm text-red-800 bg-red-100 border border-red-300 rounded-lg shadow-sm">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    <div class="overflow-hidden bg-white rounded-lg shadow-lg p-6 md:p-8">

        <div class="mb-6 flex items-center gap-3">
            <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">
                {{ $event->category->name }}
            </span>
            @if($event->date->isPast())
            <span class="px-3 py-1 text-sm font-semibold text-red-800 bg-red-100 rounded-full">
                Terminé
            </span>
            @endif
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mt-2 mb-6">{{ $event->title }}</h1>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

            <div class="md:col-span-2">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Description</h2>
                <p class="text-gray-700 mb-6 whitespace-pre-line">{{ $event->desc }}</p>

                <h2 class="text-xl font-bold text-gray-800 mb-2">Localisation</h2>
                <p class="text-gray-700">{{ $event->address->location }}</p>
                <p class="text-gray-700">{{ $event->address->postal_code }} {{ $event->address->city }}</p>
                <p class="text-gray-500">{{ $event->address->country }}</p>
            </div>

            <div class="p-6 bg-gray-50 rounded-xl border border-gray-200 h-fit">
                <div class="mb-4">
                    <p class="text-sm text-gray-500">Date de l'événement</p>
                    <p class="font-semibold text-gray-800">{{ $event->date->format('d/m/Y') }}</p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-500">Places occupées</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $event->volunteers->count() }} / {{ $event->max_volunteers }}
                    </p>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    @auth
                    @if(Auth::user()->role == 'admin')
                    <a href="{{ route('events.edit', $event) }}" class="block w-full py-2 text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        Modifier l'événement
                    </a>
                    @else
                    @if($event->date->isPast())
                    <button disabled class="w-full py-2 text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed italic">
                        ✖ Événement terminé
                    </button>
                    @elseif(Auth::user()->participations->contains('id', $event->id))
                    <form action="{{ route('participations.destroy', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-2 text-center text-red-600 bg-white border border-red-600 rounded-lg hover:bg-red-50 transition" onclick="return confirm('Êtes-vous sûr de vouloir annuler votre inscription ?')">
                            Se désinscrire
                        </button>
                    </form>
                    @elseif($event->volunteers_count >= $event->max_volunteers)
                    <button disabled class="w-full py-2 text-gray-600 bg-gray-200 rounded-lg cursor-not-allowed">
                        Événement Complet
                    </button>
                    @else
                    <form action="{{ route('participations.store', $event) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-2 text-center text-white bg-green-600 rounded-lg hover:bg-green-700 transition">
                            S'inscrire
                        </button>
                    </form>
                    @endif
                    @endif
                    @endauth

                    @guest
                    @if($event->date->isPast())
                    <button disabled class="w-full py-2 text-gray-500 bg-gray-200 rounded-lg cursor-not-allowed italic">
                        ✖ Événement terminé
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="block w-full py-2 text-center text-blue-600 bg-white border border-blue-600 rounded-lg hover:bg-blue-50 transition">
                        Connectez-vous pour participer
                    </a>
                    @endif
                    @endguest
                </div>
            </div>
        </div>

        @auth
        @if(Auth::user()->role == 'admin')
        <div class="mt-10 pt-8 border-t border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Liste des Bénévoles Inscrits</h2>

            @if($event->volunteers->isEmpty())
            <div class="p-6 text-center bg-gray-50 rounded-lg border border-gray-200">
                <p class="text-gray-500 italic">Aucun bénévole n'est inscrit pour le moment.</p>
            </div>
            @else
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="w-full text-left border-collapse bg-white">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="p-4 text-sm font-semibold text-gray-700">Nom complet</th>
                            <th class="p-4 text-sm font-semibold text-gray-700">Adresse Email</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($event->volunteers as $volunteer)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-900 font-medium">{{ $volunteer->username }}</td>
                            <td class="p-4 text-gray-600">{{ $volunteer->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        @endif
        @endauth

    </div>
</div>
@endsection