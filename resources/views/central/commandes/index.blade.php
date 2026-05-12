<x-app-layout>

<!-- En-tête -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Validation & Expédition</h1>
    <p class="mt-1 text-sm text-gray-500">Validez les quantités et expédiez les commandes aux magasiniers.</p>
</div>

<!-- Statistiques -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-amber-400 rounded-l-xl"></div>
        <div class="pl-2 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">À Valider</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['en_attente_direction'] ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-sky-400 rounded-l-xl"></div>
        <div class="pl-2 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Expédiés</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['en_attente_confirmation'] ?? 0 }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-emerald-400 rounded-l-xl"></div>
        <div class="pl-2 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Confirmées</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['confirmees'] ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Tableau -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Article</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Magasinier</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Action / Qté Finale</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($commandes as $commande)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs font-bold flex-shrink-0">
                                {{ substr($commande->article->nom, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-800">{{ $commande->article->nom }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">Qté demandée : {{ $commande->demande->quantite }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $commande->demande->user->name }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($commande->statut === 'en_attente_direction')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">À valider</span>
                        @elseif($commande->statut === 'en attente de confirmation')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-700">En attente Magasinier</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">{{ ucfirst($commande->statut) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($commande->statut === 'en_attente_direction')
                            <form action="{{ route('central.commandes.valider', $commande) }}" method="POST"
                                  class="inline-flex items-center gap-2">
                                @csrf
                                <input type="number" name="quantite_finale"
                                       value="{{ $commande->quantite }}" min="1"
                                       class="w-20 text-sm border border-gray-300 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-center">
                                <button type="submit"
                                        class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition-colors">
                                    Transmettre
                                </button>
                            </form>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 border border-gray-200 rounded-md text-xs text-gray-700 font-medium">
                                Qté envoyée : {{ $commande->quantite }}
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-14 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <p class="text-sm text-gray-500">Aucune commande à traiter pour le moment.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
