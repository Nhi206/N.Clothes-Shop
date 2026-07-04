<!-- Breadcrumbs -->
@if(isset($breadcrumbs) && count($breadcrumbs) > 0)
<div class="mb-6">
<nav class="flex items-center space-x-2 text-sm text-on-surface-variant">
<a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">
<span class="material-symbols-outlined text-lg mr-1">home</span>
Dashboard
</a>
@foreach($breadcrumbs as $breadcrumb)
<span class="text-outline-variant/60">/</span>
@if($loop->last)
<span class="text-on-background font-medium">{{ $breadcrumb['title'] }}</span>
@else
<a href="{{ $breadcrumb['url'] }}" class="hover:text-primary transition-colors">{{ $breadcrumb['title'] }}</a>
@endif
@endforeach
</nav>
</div>
@endif