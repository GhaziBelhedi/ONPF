<x-app-layout>

<!-- En-tête -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Ajouter un Article</h1>
    <p class="mt-1 text-sm text-gray-500">Renseignez les informations du nouvel article et ses niveaux de stock initiaux.</p>
</div>

<div class="max-w-xl">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-700">Informations de l'article</h2>
        </div>
        <form method="POST" action="{{ route('articles.store') }}" class="px-6 py-5 space-y-5">
            @csrf

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">
                    Nom de l'article <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required autofocus
                       class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('nom')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stocks initiaux -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="quantite_magasin" class="block text-sm font-medium text-gray-700 mb-1">
                        Stock Magasinier <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="quantite_magasin" name="quantite_magasin"
                           value="{{ old('quantite_magasin', 0) }}" required min="0"
                           class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('quantite_magasin')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="quantite_centrale" class="block text-sm font-medium text-gray-700 mb-1">
                        Stock Dir. Centrale <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="quantite_centrale" name="quantite_centrale"
                           value="{{ old('quantite_centrale', 0) }}" required min="0"
                           class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('quantite_centrale')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Seuil minimum -->
            <div>
                <label for="seuil_minimum" class="block text-sm font-medium text-gray-700 mb-1">
                    Seuil Minimum (alerte stock faible) <span class="text-red-500">*</span>
                </label>
                <input type="number" id="seuil_minimum" name="seuil_minimum"
                       value="{{ old('seuil_minimum', 10) }}" required min="0"
                       class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('seuil_minimum')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('articles.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Annuler
                </a>
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors shadow-sm">
                    Enregistrer l'article
                </button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
