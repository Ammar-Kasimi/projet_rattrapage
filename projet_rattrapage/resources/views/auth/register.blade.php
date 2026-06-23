@extends('layouts.header')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Créer un compte</h2>
        
        @if ($errors->any())
            <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="js-errors" class="hidden p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            <ul id="error-list" class="pl-5 list-disc"></ul>
        </div>

        <form id="registerForm" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="username" id="username" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Adresse Email</label>
                <input type="email" name="email" id="email" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Âge (Optionnel)</label>
                <input type="number" name="age" id="age" min="1" 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Genre (Optionnel)</label>
                <select name="gender" id="gender" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="" selected>Choisir...</option>
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" id="password" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-green-600 rounded-lg hover:bg-green-700">
                S'inscrire
            </button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            Déjà inscrit ? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Se connecter</a>
        </p>

    </div>
</div>
@endsection