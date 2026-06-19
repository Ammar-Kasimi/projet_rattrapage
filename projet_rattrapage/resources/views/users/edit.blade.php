@extends('layouts.header')

@section('content')
<div class="container px-4 py-8 mx-auto max-w-4xl">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Mon Profil</h1>
        <a href="{{ Auth::user()->role=='admin' ?route('admin.dashboard') : route('events.index') }}" class="text-gray-600 hover:text-blue-600">&larr; Retour à l'accueil</a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500 rounded">
            <ul class="pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
        
        <div class="md:col-span-2">
            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="p-8 bg-white rounded-lg shadow-md">
                @csrf
                @method('PUT') 
                
                <h2 class="pb-2 mb-6 text-xl font-bold text-blue-600 border-b">Informations Personnelles</h2>
                
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Nom d'utilisateur</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Adresse Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Âge</label>
                        <input type="number" name="age" value="{{ old('age', $user->age) }}" min="1"  class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">Genre</label>
                        <select name="gender" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled {{ is_null($user->gender) ? 'selected' : '' }}>Choisir...</option>
                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Homme</option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Femme</option>
                        </select>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Photo de profil</label>
                    
                    @if($user->pic)
                        <div class="flex items-center gap-4 mb-4">
                            <img src="{{ asset('storage/' . $user->pic) }}" alt="Profil" class="object-cover w-20 h-20 border border-gray-200 rounded-full shadow-sm">
                            <span class="text-sm text-gray-500">Image actuelle</span>
                        </div>
                    @endif

                    <input type="file" name="pic" id="pic" accept="image/*" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-bold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <div class="md:col-span-1">
            <form action="{{ route('users.password.update') }}" method="POST" class="p-8 bg-white rounded-lg shadow-md">
                @csrf
                @method('PUT')
                
                <h2 class="pb-2 mb-6 text-xl font-bold text-red-600 border-b">Sécurité</h2>
                
                <div class="mb-4">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Minimum 8 caractères">
                </div>

                <div class="mb-8">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-red-600 rounded-lg shadow hover:bg-red-700">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection