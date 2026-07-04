<x-client-layout title="Thông tin cá nhân">
<div class="max-w-[1440px] mx-auto px-8 py-12">
<div class="space-y-8">
    <div class="flex items-center gap-2">
        <span class="material-symbols-outlined text-primary text-4xl">person</span>
        <h1 class="text-3xl font-bold text-primary">Thông tin cá nhân</h1>
    </div>
</div>

<div class="grid grid-cols-12 gap-8">
    <div class="col-span-12 lg:col-span-8">
        <div class="space-y-6">
            <!-- Update Profile Information -->
            <div class="bg-surface rounded-3xl p-6 shadow-sm">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="bg-surface rounded-3xl p-6 shadow-sm">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <div class="col-span-12 lg:col-span-4">
        <!-- Delete Account -->
        <div class="bg-surface rounded-3xl p-6 shadow-sm">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
</div>
</x-client-layout>
