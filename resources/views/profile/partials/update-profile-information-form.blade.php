<div class="bg-white rounded-xl border border-gray-200 shadow-sm">
    <div class="px-6 py-5 border-b border-gray-100">
        <h2 class="text-sm font-semibold text-gray-700">Informations du profil</h2>
        <p class="mt-1 text-xs text-gray-500">Modifiez votre nom et votre adresse e-mail.</p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="px-6 py-5 space-y-5">
        @csrf
        @method('patch')

        <!-- Nom -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                   required autofocus autocomplete="name"
                   class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @error('name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                   required autocomplete="username"
                   class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 p-3 bg-amber-50 border border-amber-200 rounded-lg">
                    <p class="text-xs text-amber-800">
                        Votre adresse e-mail n'est pas vérifiée.
                        <button form="send-verification"
                                class="font-medium underline hover:text-amber-900 focus:outline-none">
                            Renvoyer l'e-mail de vérification.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-xs font-medium text-emerald-600">
                            Un nouveau lien de vérification a été envoyé.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Rôle (lecture seule) -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
            <div class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-gray-500 select-none">
                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
            </div>
        </div>

        <!-- Action -->
        <div class="flex items-center gap-3 pt-1">
            <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition-colors shadow-sm">
                Enregistrer
            </button>
            @if (session('status') === 'profile-updated')
                <span class="text-sm text-emerald-600 font-medium">Modifications enregistrées.</span>
            @endif
        </div>
    </form>
</div>
