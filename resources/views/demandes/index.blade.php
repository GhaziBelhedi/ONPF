<x-app-layout>
@php
    $total    = $demandes->count();
    $enAttente = $demandes->where('statut', 'en attente')->count();
    $validees  = $demandes->where('statut', 'validée')->count();
    $rejetees  = $demandes->where('statut', 'rejetée')->count();
@endphp

<!-- En-tête -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Mes Demandes</h1>
        <p class="mt-1 text-sm text-gray-500">Historique de vos demandes de réapprovisionnement.</p>
    </div>
    <a href="{{ route('demandes.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Nouvelle Demande
    </a>
</div>

<!-- Statistiques -->
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-indigo-400 rounded-l-xl"></div>
        <div class="pl-2">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $total }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-amber-400 rounded-l-xl"></div>
        <div class="pl-2">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">En attente</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $enAttente }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-emerald-400 rounded-l-xl"></div>
        <div class="pl-2">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Validées</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $validees }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-red-400 rounded-l-xl"></div>
        <div class="pl-2">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Rejetées</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $rejetees }}</p>
        </div>
    </div>
</div>

<!-- Tableau -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Article</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Qté Demandée</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Qté Approuvée</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Bon de Sortie</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($demandes as $demande)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                        {{ $demande->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs font-bold flex-shrink-0">
                                {{ substr($demande->article->nom, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-800">{{ $demande->article->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-medium text-gray-700">{{ $demande->quantite }}</td>
                    <td class="px-6 py-4 text-center text-sm font-semibold text-indigo-600">
                        {{ $demande->commande ? $demande->commande->quantite : '—' }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($demande->statut === 'en attente')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">En attente</span>
                        @elseif($demande->statut === 'validée')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Validée</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">Rejetée</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-sm">
                        @if($demande->commande)
                            <a href="{{ route('magasinier.commandes.index') }}"
                               class="text-indigo-600 hover:text-indigo-800 font-medium underline-offset-2 hover:underline">
                                Voir le bon
                            </a>
                        @else
                            <span class="text-gray-400 text-xs italic">Non généré</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-sm text-gray-500">Aucune demande trouvée.</p>
                        <a href="{{ route('demandes.create') }}" class="mt-2 inline-block text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                            Créer votre première demande
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
