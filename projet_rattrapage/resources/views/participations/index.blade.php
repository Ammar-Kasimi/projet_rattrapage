@extends('layouts.header') @section('content')
<div class="container px-4 py-8 mx-auto max-w-5xl">

    <div class="mb-8 border-b border-stone-200 pb-4">
        <h1 class="font-display text-3xl font-semibold text-stone-900">Mon Planning Bénévole</h1>
        <p class="text-stone-600 mt-2">Retrouvez ici tous les événements auxquels vous êtes inscrit.</p>
    </div>


    @if($events->isEmpty())
    <div class="p-8 text-center bg-white rounded-2xl border border-stone-200 shadow-sm">
        <svg class="w-16 h-16 mx-auto text-stone-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        <h2 class="font-display text-xl font-semibold text-stone-700 mb-2">Aucun événement prévu</h2>
        <p class="text-stone-500 mb-6">Vous ne participez à aucun événement pour le moment.</p>
        <a href="{{ route('events.index') }}" class="px-6 py-2 text-white bg-teal-700 rounded-lg hover:bg-teal-800 transition font-medium">
            Découvrir les missions
        </a>
    </div>


    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
        <div class="flex flex-col bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden hover:shadow-md transition">
            <div class="p-6 flex-grow">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-amber-800 bg-amber-100 rounded-full">
                        {{ $event->category->name }}
                    </span>
                </div>

                <h2 class="font-display text-xl font-semibold text-stone-900 mb-2 line-clamp-2">
                    {{ $event->title }}
                </h2>

                <div class="space-y-2 mt-4 text-sm text-stone-600">
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

            <div class="p-4 bg-stone-50 border-t border-stone-100 text-center">
                <a href="{{ route('events.show', $event) }}" class="text-sm font-semibold text-teal-700 hover:text-teal-800">
                    Voir les détails de l'événement &rarr;
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
