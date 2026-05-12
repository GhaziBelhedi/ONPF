<x-app-layout>
@php
    $aConfirmer = $commandes->where('statut', 'en attente de confirmation')->count();
    $confirmees = $commandes->where('statut', 'confirmée')->count();
    $enAttente  = $commandes->where('statut', 'en_attente_direction')->count();
@endphp

<!-- En-tête -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Bons de Sortie</h1>
    <p class="mt-1 text-sm text-gray-500">Contrôlez la réception et la qualité des articles expédiés par la Direction Centrale.</p>
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
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">En attente Direction</p>
                <p class="text-2xl font-bold text-gray-800">{{ $enAttente }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-sky-400 rounded-l-xl"></div>
        <div class="pl-2 flex items-center gap-4">
            <div class="w-10 h-10 rounded-full bg-sky-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">À Confirmer</p>
                <p class="text-2xl font-bold text-gray-800">{{ $aConfirmer }}</p>
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
                <p class="text-2xl font-bold text-gray-800">{{ $confirmees }}</p>
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
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Qté Approuvée</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Contrôle Qualité</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
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
                            <span class="text-sm font-medium text-gray-800">{{ $commande->article->nom }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-semibold text-indigo-600">
                        {{ $commande->quantite }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($commande->statut === 'en attente de confirmation')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-700">À confirmer</span>
                        @elseif($commande->statut === 'confirmée')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">Confirmé</span>
                        @elseif($commande->statut === 'en_attente_direction')
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">En attente Direction</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">{{ $commande->statut }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-sm">
                        @if($commande->statut === 'confirmée')
                            @if($commande->qualite_conforme)
                                <span class="inline-flex items-center gap-1 text-emerald-600 font-medium">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    Conforme
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-red-600 font-medium">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                    Non Conforme
                                </span>
                            @endif
                            @if($commande->commentaire_magasinier)
                                <p class="text-xs text-gray-400 italic mt-1">{{ $commande->commentaire_magasinier }}</p>
                            @endif
                        @else
                            <span class="text-gray-400 text-xs italic">En attente...</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($commande->statut === 'en attente de confirmation')
                            <button type="button"
                                    onclick="openModal({{ $commande->id }}, '{{ addslashes($commande->article->nom) }}', {{ $commande->quantite }})"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded-lg transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Confirmer
                            </button>
                        @else
                            <span class="text-xs text-gray-400 italic">
                                {{ $commande->confirmed_at ? 'Le '.$commande->confirmed_at->format('d/m/Y') : 'Traité' }}
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-14 text-center">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <p class="text-sm text-gray-500">Aucun bon de sortie pour le moment.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de confirmation -->
<div id="confirmationModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" onclick="closeModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">
            <form id="confirmationForm" method="POST">
                @csrf

                <!-- Header -->
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Contrôle de Réception</h3>
                        <p class="text-sm text-gray-500">
                            Réception de <span id="modal-quantite" class="font-semibold text-indigo-600"></span>
                            × <span id="modal-article" class="font-medium text-gray-700"></span>
                        </p>
                    </div>
                </div>

                <!-- Qualité -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">La qualité est-elle conforme ?</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="qualite_conforme" value="1" checked
                                   class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <span class="text-sm text-gray-700">Oui, conforme</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="qualite_conforme" value="0"
                                   class="h-4 w-4 text-red-500 border-gray-300 focus:ring-red-400">
                            <span class="text-sm text-gray-700">Non, problème détecté</span>
                        </label>
                    </div>
                </div>

                <!-- Commentaire -->
                <div class="mb-6">
                    <label for="commentaire" class="block text-sm font-medium text-gray-700 mb-1">Commentaire / Observations</label>
                    <textarea id="commentaire" name="commentaire_magasinier" rows="3"
                              class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none"
                              placeholder="Quantité incorrecte, qualité médiocre..."></textarea>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal()"
                            class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Annuler
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors">
                        Confirmer & Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(id, article, quantite) {
        document.getElementById('modal-article').textContent = article;
        document.getElementById('modal-quantite').textContent = quantite;
        document.getElementById('confirmationForm').action = '/commandes/' + id + '/confirmer';
        document.getElementById('confirmationModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('confirmationModal').classList.add('hidden');
    }
</script>
</x-app-layout>
