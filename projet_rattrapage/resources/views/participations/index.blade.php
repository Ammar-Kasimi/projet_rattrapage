@extends('layouts.header') @section('content')
<div class="container px-4 py-8 mx-auto max-w-5xl">

    <div class="mb-8 border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800">Mon Planning Bénévole</h1>
        <p class="text-gray-600 mt-2">Retrouvez ici tous les événements auxquels vous êtes inscrit.</p>
    </div>


    @if($events->isEmpty())
    <div class="p-8 text-center bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Aucun événement prévu</h2>
        <p class="text-gray-500 mb-6">Vous ne participez à aucun événement pour le moment.</p>
        <a href="{{ route('events.index') }}" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
            Découvrir les missions
        </a>
    </div>


    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="flex flex-col bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition">
            <div class="p-6 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                        {{ $event->category->name }}
                    </span>
                </div>

                <h2 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2">
                    {{ $event->title }}
                </h2>

                <div class="space-y-2 mt-4 text-sm text-gray-600">
                    <p class="flex items-center">
                        <span class="mr-2">📅</span>
                        {{ $event->date }}
                    </p>
                    <p class="flex items-center">
                        <span class="mr-2">📍</span>
                        {{ $event->address->city }}
                    </p>
                </div>
            </div>

            <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                <a href="{{ route('events.show', $event) }}" class="text-sm font-semibold text-blue-600 hover:text-blue-800">
                    Voir les détails de l'événement &rarr;
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection