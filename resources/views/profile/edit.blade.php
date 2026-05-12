<x-app-layout>

<!-- En-tête -->
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900">Mon Profil</h1>
    <p class="mt-1 text-sm text-gray-500">Gérez vos informations personnelles et la sécurité de votre compte.</p>
</div>

<div class="max-w-2xl space-y-6">
    @include('profile.partials.update-profile-information-form')
    @include('profile.partials.update-password-form')
    @include('profile.partials.delete-user-form')
</div>

</x-app-layout>
