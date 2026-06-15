@extends('layouts.header')
@section('content')
<div class="container px-4 py-8 mx-auto max-w-7xl">

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Tableau de Bord</h1>
        <a href="{{ route('events.create') }}" class="px-4 py-2 font-bold text-white bg-green-600 rounded hover:bg-green-700">
            + Nouvel Événement
        </a>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-8">
        <div class="p-6 bg-white rounded-lg shadow border-l-4 border-blue-500">
            <h3 class="text-gray-500">Total Événements</h3>
            <p class="text-3xl font-bold">{{ $events->count() }}</p>
        </div>
        <div class="p-6 bg-white rounded-lg shadow border-l-4 border-purple-500">
            <h3 class="text-gray-500">Total Catégories</h3>
            <p class="text-3xl font-bold">{{ $categories->count() }}</p>
        </div>
    </div>

    <div class="p-6 mb-8 bg-white rounded-lg shadow">
        <h2 class="mb-4 text-xl font-bold">Gestion des Événements</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-3">Titre</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Catégorie</th>
                        <th class="p-3">Inscrits</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3 font-medium text-gray-900">{{ $event->title }}</td>
                        <td class="p-3 text-gray-600">{{ $event->date }}</td> 
                        <td class="p-3 text-gray-600">{{ $event->category->name }}</td>
                        <td class="p-3 text-gray-600">{{ $event->volunteers_count }} / {{ $event->max_volunteers }}</td>
                        <td class="p-3 flex space-x-3">
                            <a href="{{ route('events.edit', $event) }}" class="text-blue-500 hover:underline">Modifier</a>

                            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet événement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-4 text-xl font-bold">Ajouter une Catégorie</h2>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nom</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border rounded">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Description</label>
                    <textarea name="desc" required class="w-full px-3 py-2 border rounded"></textarea>
                </div>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                    Enregistrer
                </button>
            </form>
        </div>

        <div class="p-6 bg-white rounded-lg shadow">
            <h2 class="mb-4 text-xl font-bold">Catégories Existantes</h2>
            <ul class="divide-y">
                @foreach($categories as $category)
                <li class="flex items-center justify-between py-3">
                    <div>
                        <span class="font-bold">{{ $category->name }}</span>
                        <p class="text-sm text-gray-500">{{ $category->desc }}</p>
                    </div>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">X</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>

    </div>

</div>
@endsection