@extends('layouts.header')

@section('content')
<div class="container px-4 py-12 mx-auto max-w-2xl">
    
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Modifier la Catégorie</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-800 underline transition">
            Retour au tableau de bord
        </a>
    </div>

    <div class="p-8 bg-white rounded-xl shadow-sm border border-gray-100">
        
        <!-- JS Errors Container -->
        <div id="js-errors" class="hidden mb-6 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            <span class="font-medium">Oups ! Veuillez corriger ces erreurs :</span>
            <ul id="error-list" class="mt-1.5 ml-4 list-disc list-inside"></ul>
        </div>

        <form id="editCategoryForm" action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Nom de la catégorie</label>
                <input type="text" id="edit_category_name" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="mb-8">
                <label class="block mb-2 text-sm font-medium text-gray-700">Description</label>
                <textarea id="edit_category_desc" name="desc" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old('desc', $category->desc) }}</textarea>
            </div>
            
            <button type="submit" class="w-full px-4 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition font-bold text-lg shadow-sm">
                Mettre à jour
            </button>
        </form>
    </div>

</div>
@endsection