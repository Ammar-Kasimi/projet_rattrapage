@extends('layouts.header')

@section('content')
<div class="container px-4 py-12 mx-auto max-w-2xl">

    <div class="flex items-center justify-between mb-8">
        <h1 class="font-display text-3xl font-semibold text-stone-900">Modifier la Catégorie</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-stone-500 hover:text-teal-700 underline transition">
            Retour au tableau de bord
        </a>
    </div>

    <div class="p-8 bg-white rounded-2xl shadow-sm border border-stone-100">

        <!-- JS Errors Container -->
        <div id="js-errors" class="hidden mb-6 p-4 text-sm text-rose-700 bg-rose-50 rounded-xl border border-rose-200" role="alert">
            <span class="font-medium">Oups ! Veuillez corriger ces erreurs :</span>
            <ul id="error-list" class="mt-1.5 ml-4 list-disc list-inside"></ul>
        </div>

        <form id="editCategoryForm" action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-stone-700">Nom de la catégorie</label>
                <input type="text" id="edit_category_name" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div class="mb-8">
                <label class="block mb-2 text-sm font-medium text-stone-700">Description</label>
                <textarea id="edit_category_desc" name="desc" rows="4" class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">{{ old('desc', $category->desc) }}</textarea>
            </div>

            <button type="submit" class="w-full px-4 py-3 text-white bg-teal-700 rounded-lg hover:bg-teal-800 transition font-bold text-lg shadow-sm">
                Mettre à jour
            </button>
        </form>
    </div>

</div>
@endsection
