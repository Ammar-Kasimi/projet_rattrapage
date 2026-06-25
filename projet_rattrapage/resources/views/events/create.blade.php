@extends('layouts.header')

@section('content')
<div class="container px-4 py-8 mx-auto max-w-4xl">

    <div class="flex items-center justify-between mb-6">
        <h1 class="font-display text-3xl font-semibold text-stone-900">Créer un Nouvel Événement</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-stone-600 hover:text-teal-700 transition">&larr; Retour</a>
    </div>

    @if ($errors->any())
    <div class="p-4 mb-6 text-sm text-rose-700 bg-rose-50 border border-rose-200 rounded-xl">
        <ul class="pl-5 list-disc">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div id="js-errors" class="hidden p-4 mb-6 text-sm text-rose-700 bg-rose-50 border border-rose-200 rounded-xl">
        <ul id="error-list" class="pl-5 list-disc"></ul>
    </div>

    <form id="eventForm" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-2xl border border-stone-100 shadow-sm">
        @csrf

        <h2 class="pb-2 mb-4 text-xl font-display font-semibold text-teal-700 border-b border-stone-200">1. Informations de l'événement</h2>

        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">

            <div>
                <label class="block mb-2 text-sm font-medium text-stone-700">Titre de l'événement</label>
                <input type="text" name="title" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-stone-700">Catégorie</label>
                <select name="category_id" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
                    <option value="" disabled selected>Choisir une catégorie</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-stone-700">Date</label>
                <input type="date" name="date" id="date" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-stone-700">Nombre max de bénévoles</label>
                <input type="number" name="max_volunteers" id="max_volunteers" min="1" max="10000" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-stone-700">Description</label>
            <textarea name="desc" rows="4" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition"></textarea>
        </div>

        <div class="mb-8">
            <label class="block mb-2 text-sm font-medium text-stone-700">Photo de l'événement (Optionnelle)</label>
            <input type="file" name="picture" id="picture" accept="image/*" class="w-full px-4 py-2 bg-white border border-stone-300 rounded-lg focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
        </div>

        <h2 class="pb-2 mb-4 text-xl font-display font-semibold text-amber-700 border-b border-stone-200">2. Localisation</h2>

        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">

            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-stone-700">Adresse / Rue</label>
                <input type="text" name="location" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-amber-600 focus:ring-2 focus:ring-amber-600/20 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-stone-700">Ville</label>
                <input type="text" name="city" id="ville" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-amber-600 focus:ring-2 focus:ring-amber-600/20 transition">
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-stone-700">Code Postal</label>
                <input type="text" name="postal_code" id="postal_code" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-amber-600 focus:ring-2 focus:ring-amber-600/20 transition">
            </div>

            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-stone-700">Pays</label>
                <input type="text" name="country" id="pays" value="Maroc" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-amber-600 focus:ring-2 focus:ring-amber-600/20 transition">
            </div>
        </div>

        <div class="flex justify-end mt-8">
            <button type="submit" class="px-6 py-3 font-semibold text-white bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700 transition">
                Enregistrer l'événement
            </button>
        </div>

    </form>
</div>
@vite(['resources/js/form_validations.js'])
@endsection