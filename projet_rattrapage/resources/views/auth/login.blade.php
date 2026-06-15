
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Connexion</h2>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Adresse Email</label>
                <input type="email" name="email" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" required 
                       class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                Se Connecter
            </button>
        </form>

        <p class="mt-4 text-sm text-center text-gray-600">
            Pas encore de compte ? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">S'inscrire</a>
        </p>

    </div>
</div>