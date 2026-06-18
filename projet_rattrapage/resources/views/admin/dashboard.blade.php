@extends('layouts.header')

@section('content')
<div class="container px-4 py-8 mx-auto max-w-7xl">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tableau de Bord</h1>
        <a href="{{ route('events.create') }}" class="px-4 py-2 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 transition shadow-sm">
            + Nouvel Événement
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500">
            <h3 class="text-gray-500 font-medium">Total Événements</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $events->count() }}</p>
        </div>
        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-purple-500">
            <h3 class="text-gray-500 font-medium">Total Catégories</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $categories->count() }}</p>
        </div>
    </div>

    <div class="p-6 mb-8 bg-white rounded-xl shadow-sm border border-gray-100">
        <h2 class="mb-6 text-xl font-bold text-gray-800">Gestion des Événements</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="p-4 font-semibold text-gray-700">Titre</th>
                        <th class="p-4 font-semibold text-gray-700">Date</th>
                        <th class="p-4 font-semibold text-gray-700">Catégorie</th>
                        <th class="p-4 font-semibold text-gray-700">Inscrits</th>
                        <th class="p-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($events as $event)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 font-medium text-gray-900">
                            <a href="{{ route('events.show', $event) }}" class="hover:text-blue-600 hover:underline">
                                {{ $event->title }}
                            </a>
                        </td>
                        <td class="p-4 text-gray-600">{{ $event->date}}</td> 
                        <td class="p-4 text-gray-600">
                            <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full">
                                {{ $event->category->name }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-600 font-medium">
                            {{ $event->volunteers_count }} / {{ $event->max_volunteers }}
                        </td>
                        <td class="p-4 flex space-x-4">
                            <a href="{{ route('events.show', $event) }}" class="text-green-600 hover:text-green-800 font-medium hover:underline">Voir</a>
                            
                            <a href="{{ route('events.edit', $event) }}" class="text-blue-600 hover:text-blue-800 font-medium hover:underline">Modifier</a>

                            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet événement ?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500 italic">
                            Aucun événement n'a été créé pour le moment.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
            <h2 class="mb-6 text-xl font-bold text-gray-800">Ajouter une Catégorie</h2>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nom de la catégorie</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                    <textarea name="desc" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition font-medium">
                    Enregistrer la catégorie
                </button>
            </form>
        </div>

        <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
            <h2 class="mb-6 text-xl font-bold text-gray-800">Catégories Existantes</h2>
            
            @if($categories->isEmpty())
                <p class="text-gray-500 italic text-center py-4">Aucune catégorie disponible.</p>
            @else
                <ul class="divide-y divide-gray-100">
                    @foreach($categories as $category)
                    <li class="flex items-start justify-between py-4">
                        <div>
                            <span class="font-bold text-gray-800 block">{{ $category->name }}</span>
                            <p class="text-sm text-gray-500 mt-1">{{ $category->desc }}</p>
                        </div>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?');" class="ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded transition" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>

</div>
@endsection