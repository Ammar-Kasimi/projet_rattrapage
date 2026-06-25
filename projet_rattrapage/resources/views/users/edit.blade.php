@extends('layouts.header')

@section('content')
<div class="container px-4 py-8 mx-auto max-w-4xl">

    <div class="flex items-center justify-between mb-6">
        <h1 class="font-display text-3xl font-semibold text-stone-900">Mon Profil</h1>
        <a href="{{ Auth::user()->role=='admin' ? route('admin.dashboard') : route('events.index') }}" class="text-stone-600 hover:text-teal-700 transition">&larr; Retour à l'accueil</a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-sm text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

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

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

        <div class="md:col-span-2">
            <form id="editProfileForm" action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-2xl border border-stone-100 shadow-sm">
                @csrf
                @method('PUT')

                <h2 class="pb-2 mb-6 text-xl font-display font-semibold text-teal-700 border-b border-stone-200">Informations Personnelles</h2>

                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-stone-700">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" value="{{ old('username', $user->username) }}" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-stone-700">Adresse Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-stone-700">Âge</label>
                        <input type="number" name="age" id="age" value="{{ old('age', $user->age) }}" min="1"  class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-stone-700">Genre</label>
                        <select name="gender" id="gender" class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition">
                            <option value="" disabled {{ is_null($user->gender) ? 'selected' : '' }}>Choisir...</option>
                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Homme</option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Femme</option>
                        </select>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block mb-2 text-sm font-medium text-stone-700">Photo de profil</label>

                    @if($user->pic)
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('storage/' . $user->pic) }}" alt="Profil" class="object-cover w-20 h-20 border border-stone-200 rounded-full shadow-sm">
                            <span class="text-sm text-stone-500">Image actuelle</span>
                        </div>
                    @endif

                    <input type="file" name="pic" id="pic" accept="image/*" class="w-full px-4 py-2 bg-white border border-stone-300 rounded-lg focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-600/20 transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2.5 font-semibold text-white bg-teal-700 rounded-lg shadow-sm hover:bg-teal-800 transition">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <div class="md:col-span-1">
            <form id="editPasswordForm" action="{{ route('users.password.update') }}" method="POST" class="p-8 bg-white rounded-2xl border border-stone-100 shadow-sm">
                @csrf
                @method('PUT')

                <h2 class="pb-2 mb-6 text-xl font-display font-semibold text-rose-600 border-b border-stone-200">Sécurité</h2>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-stone-700">Nouveau mot de passe</label>
                    <input type="password" name="password" id="password" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 placeholder:text-stone-400 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition" placeholder="Minimum 8 caractères">
                </div>

                <div class="mb-8">
                    <label class="block mb-2 text-sm font-medium text-stone-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full px-4 py-2.5 border border-stone-300 rounded-lg text-stone-900 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-500/20 transition">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="w-full px-4 py-2.5 font-semibold text-white bg-rose-600 rounded-lg shadow-sm hover:bg-rose-700 transition">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
