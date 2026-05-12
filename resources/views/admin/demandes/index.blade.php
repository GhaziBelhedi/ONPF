<x-app-layout>
@php
    $total     = $demandes->count();
    $enAttente = $demandes->where('statut', 'en attente')->count();
    $validees  = $demandes->where('statut', 'validée')->count();
    $rejetees  = $demandes->where('statut', 'rejetée')->count();
@endphp

<!-- En-tête -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Demandes Reçues</h1>
    <p class="mt-1 text-sm text-gray-500">Gérez et validez les demandes d'articles soumises par les magasiniers.</p>
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Article</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Qté Demandée</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Magasinier</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($demandes as $demande)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold flex-shrink-0">
                                {{ substr($demande->article->nom, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-800">{{ $demande->article->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="text-lg font-bold text-gray-700">{{ $demande->quantite }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                        {{ $demande->user->name }}
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
                    <td class="px-6 py-4 text-center text-xs text-gray-500 whitespace-nowrap">
                        {{ $demande->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($demande->statut === 'en attente')
                            <div class="flex flex-col items-center gap-2">
                                <form action="{{ route('admin.demandes.valider', $demande) }}" method="POST"
                                      class="flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="quantite_approuvee"
                                           value="{{ $demande->quantite }}" min="1" max="{{ $demande->quantite }}"
                                           class="w-20 text-sm border border-gray-300 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-center">
                                    <button type="submit"
                                            class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg transition-colors">
                                        Valider
                                    </button>
                                </form>
                                <form action="{{ route('admin.demandes.rejeter', $demande) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="text-xs text-red-500 hover:text-red-700 font-medium transition-colors">
                                        Rejeter
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="text-center text-xs text-gray-400 italic">Traitée</div>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-sm text-gray-500">Aucune demande reçue pour le moment.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
