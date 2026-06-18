@extends('layouts.header')

@section('content')
<div class="container px-4 py-8 mx-auto max-w-4xl">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Créer un Nouvel Événement</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-600">&larr; Retour</a>
    </div>

    @if ($errors->any())
        <div class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500 rounded">
            <ul class="pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-lg shadow-md">
        @csrf

        <h2 class="pb-2 mb-4 text-xl font-bold text-blue-600 border-b">1. Informations de l'événement</h2>
        
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
            
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Titre de l'événement</label>
                <input type="text" name="title" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Catégorie</label>
                <select name="category_id" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Choisir une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Nombre max de bénévoles</label>
                <input type="number" name="max_volunteers" min="1" max="10000" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
            <textarea name="desc" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <div class="mb-8">
            <label class="block mb-2 text-sm font-medium text-gray-700">Photo de l'événement (Optionnelle)</label>
            <input type="file" name="picture" id="picture" accept="image/*" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <h2 class="pb-2 mb-4 text-xl font-bold text-green-600 border-b">2. Localisation</h2>
        
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
            
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-700">Adresse / Rue</label>
                <input type="text" name="location" required class="w-full px-4 py-2 border rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Ville</label>
                <input type="text" name="city" required class="w-full px-4 py-2 border rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Code Postal</label>
                <input type="text" name="postal_code" id="postal_code" required class="w-full px-4 py-2 border rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-700">Pays</label>
                <input type="text" name="country" value="Maroc" required class="w-full px-4 py-2 border rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>
        </div>

        <div class="flex justify-end mt-8">
            <button type="submit" class="px-6 py-3 font-bold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700">
                Enregistrer l'événement
            </button>
        </div>

    </form>
</div>
@vite(['resources/js/form_validations.js'])
@endsection