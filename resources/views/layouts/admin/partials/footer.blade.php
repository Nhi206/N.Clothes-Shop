<!-- Footer -->
<footer class="bg-surface-container-low border-t border-outline-variant/20 mt-auto">
<div class="px-8 py-6">
<div class="flex justify-between items-center text-sm text-on-surface-variant">
<div class="flex items-center gap-4">
<p>&copy; {{ date('Y') }} N.clothes - Digital Tailor Admin Panel</p>
<div class="flex items-center gap-2 text-xs">
<span class="inline-flex items-center gap-1">
<span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
System Online
</span>
<span class="text-outline-variant/60">|</span>
<span>Last updated: {{ now()->format('d/m/Y H:i') }}</span>
</div>
</div>
<div class="flex gap-6">
<a href="#" class="hover:text-primary transition-colors">Privacy Policy</a>
<a href="#" class="hover:text-primary transition-colors">Terms of Service</a>
<a href="#" class="hover:text-primary transition-colors">Support</a>
<a href="#" class="hover:text-primary transition-colors">Documentation</a>
</div>
</div>
</div>
</footer>