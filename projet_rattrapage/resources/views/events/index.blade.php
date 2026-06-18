@extends('layouts.header')
@section('content')
<div class="container px-4 py-8 mx-auto max-w-7xl">

    <h1 class="mb-8 text-3xl font-bold text-gray-800">Événements de Bénévolat</h1>

    <form action="{{ route('events.index') }}" method="GET" class="flex items-center gap-4 mb-8">
        <label for="category_id" class="font-medium text-gray-700">Filtrer par catégorie :</label>

        <select name="category_id" id="category_id" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>

        <button type="submit" class="px-4 py-2 text-white bg-gray-800 rounded-lg hover:bg-gray-700">
            Filtrer
        </button>

        @if(request()->filled('category_id'))
        <a href="{{ route('events.index') }}" class="text-sm text-red-600 hover:underline">Effacer le filtre</a>
        @endif
    </form>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        @foreach($events as $event)
        @php
        $isPast = $event->date->isPast();
        @endphp

        <div class="overflow-hidden rounded-lg transition-all duration-300 {{ $isPast ? 'bg-gray-50 border border-gray-200 opacity-60 shadow-sm' : 'bg-white shadow-lg hover:shadow-xl hover:-translate-y-1' }}">
            
            @if($event->picture)
                <img src="{{ asset('storage/' . $event->picture) }}" class="object-cover w-full h-48">
            @endif

            <div class="p-6">
                <div class="flex items-start justify-between mb-3">
                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $isPast ? 'text-gray-600 bg-gray-200' : 'text-blue-800 bg-blue-100' }}">
                        {{ $event->category->name }}
                    </span>

                    @if($isPast)
                    <span class="px-3 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Terminé
                    </span>
                    @endif
                </div>

                <h2 class="mt-3 text-xl font-bold {{ $isPast ? 'text-gray-600' : 'text-gray-800' }}">
                    {{ $event->title }}
                </h2>
                <p class="mt-2 text-sm line-clamp-2 {{ $isPast ? 'text-gray-500' : 'text-gray-600' }}">
                    {{ $event->desc }}
                </p>

                <div class="mt-4 space-y-2 text-sm {{ $isPast ? 'text-gray-500' : 'text-gray-600' }}">
                    <p><strong>Date:</strong> {{ $event->date->format('d/m/Y') }}</p>
                    <p><strong>Lieu:</strong> {{ $event->address->city }}, {{ $event->address->location }}</p>
                    <p><strong>Bénévoles:</strong> {{ $event->volunteers_count }} / {{ $event->max_volunteers }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('events.show', $event) }}"
                        class="block w-full px-4 py-2 text-center text-white rounded transition-colors {{ $isPast ? 'bg-gray-400 hover:bg-gray-500' : 'bg-blue-600 hover:bg-blue-700' }}">
                        {{ $isPast ? 'Voir l\'historique' : 'Voir les détails' }}
                    </a>
                </div>
            </div>
        </div>
        @endforeach

    </div> 
</div> 
@endsection