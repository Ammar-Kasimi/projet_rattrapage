@extends('layouts.header')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-stone-50 px-4">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-md border border-stone-100">

        <div class="flex justify-center mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 text-emerald-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-3a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
        </div>

        <h2 class="mb-6 font-display text-2xl font-semibold text-center text-stone-800">Créer un compte</h2>

        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-rose-700 bg-rose-50 border border-rose-200 rounded-xl">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="js-errors" class="hidden p-4 mb-4 text-sm text-rose-700 bg-rose-50 border border-rose-200 rounded-xl">
            <ul id="error-list" class="pl-5 list-disc"></ul>
        </div>

        <form id="registerForm" action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-stone-700">Nom complet</label>
                <input type="text" name="username" id="username" required
                       class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-stone-700">Adresse Email</label>
                <input type="email" name="email" id="email" required
                       class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-stone-700">Âge (Optionnel)</label>
                <input type="number" name="age" id="age" min="1"
                       class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-stone-700">Genre (Optionnel)</label>
                <select name="gender" id="gender" class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
                    <option value="" selected>Choisir...</option>
                    <option value="male">Homme</option>
                    <option value="female">Femme</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-stone-700">Mot de passe</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-stone-700">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <button type="submit" class="w-full px-4 py-2.5 font-semibold text-white bg-emerald-600 rounded-lg shadow-sm hover:bg-emerald-700 transition">
                S'inscrire
            </button>
        </form>

        <p class="mt-4 text-sm text-center text-stone-600">
            Déjà inscrit ? <a href="{{ route('login') }}" class="text-teal-700 font-medium hover:underline">Se connecter</a>
        </p>

    </div>
</div>
@endsection
