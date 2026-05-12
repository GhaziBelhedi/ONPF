<x-app-layout>
@php
    $total      = $commandes->count();
    $enCours    = $commandes->whereIn('statut', ['en_attente_direction', 'en attente de confirmation'])->count();
    $confirmees = $commandes->where('statut', 'confirmée')->count();
    $conformes  = $commandes->where('statut', 'confirmée')->where('qualite_conforme', true)->count();
@endphp

<!-- En-tête -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Commandes Générées</h1>
    <p class="mt-1 text-sm text-gray-500">Suivi de toutes les commandes transmises à la Direction Centrale.</p>
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
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">En cours</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $enCours }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-emerald-400 rounded-l-xl"></div>
        <div class="pl-2">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Confirmées</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $confirmees }}</p>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-sky-400 rounded-l-xl"></div>
        <div class="pl-2">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Conformes</p>
            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $conformes }}</p>
        </div>
    </div>
</div>

<!-- Tableau -->
<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Réf.</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Article</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantité</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Qualité</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse($commandes as $commande)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-xs font-mono font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">
                            #{{ str_pad($commande->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 text-xs font-bold flex-shrink-0">
                                {{ substr($commande->article->nom, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-gray-800">{{ $commande->article->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-semibold text-indigo-600">
                        {{ $commande->quantite }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($commande->statut === 'en_attente_direction')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">À valider (Direction)</span>
                        @elseif($commande->statut === 'en attente de confirmation')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-700">En attente Magasinier</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">{{ ucfirst($commande->statut) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-sm">
                        @if($commande->statut === 'confirmée')
                            @if($commande->qualite_conforme)
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-medium text-xs">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Conforme
                                    <span class="text-gray-400 font-normal">({{ $commande->confirmed_at->format('d/m/Y') }})</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-red-600 font-medium text-xs">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Non Conforme
                                    <span class="text-gray-400 font-normal">({{ $commande->confirmed_at->format('d/m/Y') }})</span>
                                </span>
                            @endif
                        @else
                            <span class="text-xs text-gray-400 italic">En attente...</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-xs text-gray-500 whitespace-nowrap">
                        {{ $commande->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-14 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-gray-500">Aucune commande générée pour le moment.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>
