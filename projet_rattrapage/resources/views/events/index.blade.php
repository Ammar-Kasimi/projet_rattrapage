@extends('layouts.header')
@section('content')
<div class="container px-4 py-8 mx-auto max-w-7xl">

    <h1 class="mb-8 text-3xl font-bold text-gray-800">Événements de Bénévolat</h1>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">

        @foreach($events as $event)
        <div class="overflow-hidden bg-white rounded-lg shadow-lg">
            <div class="p-6">
                <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                    {{ $event->category->name }}
                </span>

                <h2 class="mt-3 text-xl font-bold text-gray-800">{{ $event->title }}</h2>
                <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $event->desc }}</p>

                <div class="mt-4 space-y-2 text-sm text-gray-600">
                    <p><strong>Lieu:</strong> {{ $event->address->city }}, {{ $event->address->location }}</p>
                    <p><strong>Bénévoles:</strong> {{ $event->volunteers_count }} / {{ $event->max_volunteers }}</p>
                </div>

                <div class="mt-6">
                    <a href="{{ route('events.show', $event) }}" class="block w-full px-4 py-2 text-center text-white bg-blue-600 rounded hover:bg-blue-700">
                        Voir les détails
                    </a>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>
@endsection