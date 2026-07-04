<!-- Flash Messages -->
@if(session('success'))
<div class="mb-6 rounded-3xl bg-emerald-50 border border-emerald-200 p-4 text-sm text-emerald-900 flex items-center gap-3">
<span class="material-symbols-outlined text-emerald-600">check_circle</span>
<span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="mb-6 rounded-3xl bg-rose-50 border border-rose-200 p-4 text-sm text-rose-900 flex items-center gap-3">
<span class="material-symbols-outlined text-rose-600">error</span>
<span>{{ session('error') }}</span>
</div>
@endif

@if(session('warning'))
<div class="mb-6 rounded-3xl bg-amber-50 border border-amber-200 p-4 text-sm text-amber-900 flex items-center gap-3">
<span class="material-symbols-outlined text-amber-600">warning</span>
<span>{{ session('warning') }}</span>
</div>
@endif

@if(session('info'))
<div class="mb-6 rounded-3xl bg-blue-50 border border-blue-200 p-4 text-sm text-blue-900 flex items-center gap-3">
<span class="material-symbols-outlined text-blue-600">info</span>
<span>{{ session('info') }}</span>
</div>
@endif