<x-app-layout>
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <!-- Left: Title -->
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Gestion des Stocks ✨</h1>
            <p class="mt-1 text-sm text-gray-500">Consultez et suivez l'état du stock des articles.</p>
        </div>
        <!-- Right: Actions -->
        <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
            @if(auth()->user()->isDirectionCentrale())
                <a href="{{ route('articles.create') }}" class="btn bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium inline-flex items-center transition-colors shadow-sm">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0 mr-2" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span>Ajouter un Article</span>
                </a>
            @endif
            @if(auth()->user()->role === 'magasinier')
                <a href="{{ route('demandes.create') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium inline-flex items-center transition-colors shadow-sm">
                    <svg class="w-4 h-4 fill-current opacity-50 shrink-0 mr-2" viewBox="0 0 16 16">
                        <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                    </svg>
                    <span>Nouvelle Demande</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-200">
        <div class="overflow-x-auto">
            <table class="table-auto w-full divide-y divide-gray-200">
                <thead class="text-xs font-semibold uppercase text-gray-500 bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-left">Nom de l'Article</div>
                        </th>
                        @if(auth()->user()->role === 'magasinier' || auth()->user()->isAdministratif())
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-center">Stock Magasinier</div>
                        </th>
                        @endif
                        @if(auth()->user()->isDirectionCentrale() || auth()->user()->isAdministratif())
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-center">Stock Dir. Centrale</div>
                        </th>
                        @endif
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-center">Seuil Min.</div>
                        </th>
                        <th class="px-6 py-4 whitespace-nowrap">
                            <div class="font-semibold text-center">Statut</div>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    @forelse($articles as $article)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-500 font-bold mr-3">
                                    {{ substr($article->nom, 0, 1) }}
                                </div>
                                <div class="font-medium text-gray-800">{{ $article->nom }}</div>
                            </div>
                        </td>
                        
                        @if(auth()->user()->role === 'magasinier' || auth()->user()->isAdministratif())
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-gray-700 font-medium">{{ $article->quantite_magasin }}</span>
                        </td>
                        @endif

                        @if(auth()->user()->isDirectionCentrale() || auth()->user()->isAdministratif())
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="text-gray-700 font-medium">{{ $article->quantite_centrale }}</span>
                        </td>
                        @endif

                        <td class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                            {{ $article->seuil_minimum }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if(
                                (auth()->user()->role === 'magasinier' && $article->quantite_magasin < $article->seuil_minimum) ||
                                (auth()->user()->isDirectionCentrale() && $article->quantite_centrale < $article->seuil_minimum) ||
                                (auth()->user()->isAdministratif() && ($article->quantite_magasin < $article->seuil_minimum || $article->quantite_centrale < $article->seuil_minimum))
                            )
                                <div class="inline-flex font-medium bg-red-100 text-red-600 rounded-full text-center px-3 py-1 text-xs">Stock Faible</div>
                            @else
                                <div class="inline-flex font-medium bg-emerald-100 text-emerald-600 rounded-full text-center px-3 py-1 text-xs">Correct</div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Aucun article trouvé dans le stock.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
