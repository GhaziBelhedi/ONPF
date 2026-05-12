<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="px-6 py-5 border-b border-gray-100">
        <h2 class="text-sm font-semibold text-gray-700">Mot de passe</h2>
        <p class="mt-1 text-xs text-gray-500">Utilisez un mot de passe long et aléatoire pour sécuriser votre compte.</p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="px-6 py-5 space-y-5">
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-1">
                Mot de passe actuel
            </label>
            <input type="password" id="update_password_current_password" name="current_password"
                   autocomplete="current-password"
                   class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @if($errors->updatePassword->get('current_password'))
                <p class="mt-1 text-xs text-red-600">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <!-- Nouveau mot de passe -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-1">
                Nouveau mot de passe
            </label>
            <input type="password" id="update_password_password" name="password"
                   autocomplete="new-password"
                   class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @if($errors->updatePassword->get('password'))
                <p class="mt-1 text-xs text-red-600">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <!-- Confirmation -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Confirmer le mot de passe
            </label>
            <input type="password" id="update_password_password_confirmation" name="password_confirmation"
                   autocomplete="new-password"
                   class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @if($errors->updatePassword->get('password_confirmation'))
                <p class="mt-1 text-xs text-red-600">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <!-- Action -->
        <div class="flex items-center gap-3 pt-1">
            <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors shadow-sm">
                Mettre à jour
            </button>
            @if (session('status') === 'password-updated')
                <span class="text-sm text-emerald-600 font-medium">Mot de passe mis à jour.</span>
            @endif
        </div>
    </form>
</div>
