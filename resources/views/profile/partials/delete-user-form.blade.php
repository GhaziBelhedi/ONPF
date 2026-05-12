<div class="bg-white rounded-xl border border-red-200 shadow-sm">
    <div class="px-6 py-5 border-b border-red-100">
        <h2 class="text-sm font-semibold text-red-700">Supprimer le compte</h2>
        <p class="mt-1 text-xs text-gray-500">
            Une fois supprimé, toutes les données de votre compte seront définitivement effacées.
        </p>
    </div>
    <div class="px-6 py-5">
        <button type="button" onclick="openDeleteModal()"
                class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors shadow-sm">
            Supprimer mon compte
        </button>
    </div>
</div>

<!-- Modal de confirmation de suppression -->
<div id="deleteModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50" onclick="closeDeleteModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6">

            <!-- Icône -->
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-gray-900">Supprimer le compte</h3>
                    <p class="text-xs text-gray-500">Cette action est irréversible.</p>
                </div>
            </div>

            <p class="text-sm text-gray-600 mb-5">
                Toutes vos données seront définitivement supprimées. Saisissez votre mot de passe pour confirmer.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <label for="delete_password" class="block text-sm font-medium text-gray-700 mb-1">
                        Mot de passe
                    </label>
                    <input type="password" id="delete_password" name="password"
                           placeholder="Votre mot de passe"
                           class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    @if($errors->userDeletion->get('password'))
                        <p class="mt-1 text-xs text-red-600">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Annuler
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        Supprimer définitivement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    @if($errors->userDeletion->isNotEmpty())
        openDeleteModal();
    @endif
</script>
