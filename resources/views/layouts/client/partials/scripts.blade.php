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
function updateHeaderWishlistCount() {
    fetch('{{ route('wishlist.count') }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        credentials: 'include'
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
            const count = Number(data.count) || 0;
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
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
        credentials: 'include'
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
            const count = Number(data.count) || 0;
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    })
    .catch(err => console.error('Error loading cart count:', err));
}

document.addEventListener('DOMContentLoaded', function() {
    updateHeaderWishlistCount();
    updateHeaderCartCount();
});

// Ensure count updates even if DOMContentLoaded was already fired before this script loaded
updateHeaderWishlistCount();
updateHeaderCartCount();
</script>

@stack('scripts')
</body>
</html>