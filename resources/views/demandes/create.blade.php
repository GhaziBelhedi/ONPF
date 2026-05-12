<x-app-layout>

<!-- En-tête -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Nouvelle Demande</h1>
    <p class="mt-1 text-sm text-gray-500">Remplissez le formulaire pour soumettre une demande de réapprovisionnement.</p>
</div>

<div class="max-w-xl">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-700">Informations de la demande</h2>
        </div>
        <form action="{{ route('demandes.store') }}" method="POST" class="px-6 py-5 space-y-5">
            @csrf

            <!-- Article -->
            <div>
                <label for="article_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Article <span class="text-red-500">*</span>
                </label>
                <select id="article_id" name="article_id" required
                        class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-white">
                    <option value="">Sélectionnez un article</option>
                    @foreach($articles as $article)
                        <option value="{{ $article->id }}" {{ old('article_id') == $article->id ? 'selected' : '' }}>
                            {{ $article->nom }} — Stock magasin : {{ $article->quantite_magasin }}
                        </option>
                    @endforeach
                </select>
                @error('article_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Quantité -->
            <div>
                <label for="quantite" class="block text-sm font-medium text-gray-700 mb-1">
                    Quantité souhaitée <span class="text-red-500">*</span>
                </label>
                <input type="number" name="quantite" id="quantite" min="1"
                       value="{{ old('quantite') }}" required
                       class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('quantite')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('demandes.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Annuler
                </a>
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors shadow-sm">
                    Envoyer la Demande
                </button>
            </div>
        </form>
    </div>
</div>

</x-app-layout>
