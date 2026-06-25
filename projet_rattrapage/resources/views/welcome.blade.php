@extends('layouts.header')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center items-center bg-stone-50 py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-4xl w-full space-y-8 text-center">
        <div class="flex justify-center">
            <div class="p-4 rounded-full bg-gradient-to-br from-teal-600 to-amber-500 shadow-lg">
                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>

        <h1 class="font-display tracking-tight font-bold text-gray-900 text-4xl sm:text-5xl md:text-6xl">
            <span class="block">Rejoignez notre plateforme</span>
            <span class="block text-teal-700">de Bénévolat</span>
        </h1>

        <p class="mt-3 max-w-2xl mx-auto text-base text-stone-500 sm:text-lg md:text-xl">
            Découvrez des événements associatifs, engagez-vous pour des causes qui vous tiennent à cœur, et faites la différence dans votre communauté.
        </p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('login') }}" class="px-8 py-3 border border-transparent text-base font-semibold rounded-lg text-white bg-teal-700 hover:bg-teal-800 md:py-4 md:text-lg md:px-10 transition shadow-sm">
                Se connecter
            </a>
            <a href="{{ route('register') }}" class="px-8 py-3 border border-stone-300 text-base font-semibold rounded-lg text-stone-700 bg-white hover:bg-stone-50 md:py-4 md:text-lg md:px-10 transition shadow-sm">
                Créer un compte
            </a>
        </div>
    </div>

    <div class="max-w-6xl w-full mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 text-center">
            <div class="w-12 h-12 mx-auto bg-teal-50 text-teal-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
            </div>
            <h3 class="font-display text-lg font-semibold text-gray-900 mb-2">Explorez</h3>
            <p class="text-stone-500">Parcourez une multitude d'événements organisés par des associations reconnues.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 text-center">
            <div class="w-12 h-12 mx-auto bg-amber-50 text-amber-700 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <h3 class="font-display text-lg font-semibold text-gray-900 mb-2">Participez</h3>
            <p class="text-stone-500">Inscrivez-vous en un clic aux événements de votre choix en tant que bénévole.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 text-center">
            <div class="w-12 h-12 mx-auto bg-rose-50 text-rose-600 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="font-display text-lg font-semibold text-gray-900 mb-2">Impactez</h3>
            <p class="text-stone-500">Agissez concrètement et suivez vos participations depuis votre espace personnel.</p>
        </div>

    </div>
</div>
@endsection
