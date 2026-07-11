<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="/js/app.js"></script>

<script>
// Dark mode toggle (optional)
function toggleDarkMode() {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
}

// Load dark mode preference
if (localStorage.getItem('darkMode') === 'true') {
    document.documentElement.classList.add('dark');
}

// Update wishlist and cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    updateHeaderWishlistCount();
    updateHeaderCartCount();
});

function updateHeaderWishlistCount() {
    fetch('{{ route('wishlist.count') }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            return { count: 0 };
        }
        return response.json();
    })
    .then(data => {
        const badge = document.getElementById('wishlist-count');
        if (badge) {
            badge.textContent = data.count || 0;
            badge.style.display = data.count > 0 ? 'flex' : 'none';
        }
    })
    .catch(err => console.error('Error loading wishlist count:', err));
}

function updateHeaderCartCount() {
    fetch('{{ route('cart.count') }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (!response.ok) {
            return { count: 0 };
        }
        return response.json();
    })
    .then(data => {
        const badge = document.getElementById('cart-count');
        if (badge) {
            badge.textContent = data.count || 0;
            badge.style.display = data.count > 0 ? 'flex' : 'none';
        }
    })
    .catch(err => console.error('Error loading cart count:', err));
}
</script>

@stack('scripts')
</body>
</html>