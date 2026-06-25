@extends('layouts.header')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-stone-50 px-4">
    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-md border border-stone-100">

        <div class="flex justify-center mb-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-teal-50 text-teal-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm0 0c-3.314 0-6 1.79-6 4v1h12v-1c0-2.21-2.686-4-6-4z"></path>
                </svg>
            </div>
        </div>

        <h2 class="mb-6 font-display text-2xl font-semibold text-center text-stone-800">Connexion</h2>

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

        <form id="loginForm" action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-stone-700">Adresse Email</label>
                <input type="email" name="email" id="login_email" required
                       class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-stone-700">Mot de passe</label>
                <input type="password" name="password" id="login_password" required
                       class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
            </div>

            <button type="submit" class="w-full px-4 py-2.5 font-semibold text-white bg-teal-700 rounded-lg shadow-sm hover:bg-teal-800 transition">
                Se Connecter
            </button>
        </form>

        <p class="mt-4 text-sm text-center text-stone-600">
            Pas encore de compte ? <a href="{{ route('register') }}" class="text-teal-700 font-medium hover:underline">S'inscrire</a>
        </p>

    </div>
</div>
@endsection
