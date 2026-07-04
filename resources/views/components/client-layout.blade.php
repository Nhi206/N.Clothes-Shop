@props(['title' => 'N.clothes'])

<!DOCTYPE html>
<html lang="vi" class="dark">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'N.clothes') }} - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary": "#651f00",
                        "on-tertiary-fixed-variant": "#802900",
                        "outline": "#737784",
                        "surface-container": "#ededf6",
                        "on-primary": "#ffffff",
                        "background": "#faf8ff",
                        "secondary": "#4e5e85",
                        "primary-fixed-dim": "#b1c5ff",
                        "tertiary-fixed-dim": "#ffb59a",
                        "primary": "#00327d",
                        "on-background": "#191b22",
                        "surface-variant": "#e2e2eb",
                        "surface-bright": "#faf8ff",
                        "surface-container-high": "#e7e7f0",
                        "on-primary-fixed-variant": "#00419e",
                        "tertiary-container": "#8b2e01",
                        "on-secondary-fixed-variant": "#37466c",
                        "secondary-container": "#c1d1ff",
                        "on-tertiary": "#ffffff",
                        "on-tertiary-container": "#ffaa8a",
                        "error-container": "#ffdad6",
                        "on-surface-variant": "#434653",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#a5bdff",
                        "surface-tint": "#2559bd",
                        "surface-dim": "#d9d9e2",
                        "surface": "#faf8ff",
                        "secondary-fixed": "#dae2ff",
                        "primary-container": "#0047ab",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#001946",
                        "surface-container-highest": "#e2e2eb",
                        "on-secondary-fixed": "#081a3e",
                        "inverse-surface": "#2e3037",
                        "tertiary-fixed": "#ffdbcf",
                        "inverse-primary": "#b1c5ff",
                        "secondary-fixed-dim": "#b6c6f3",
                        "primary-fixed": "#dae2ff",
                        "surface-container-low": "#f3f3fc",
                        "on-secondary-container": "#4a5980",
                        "on-tertiary-fixed": "#380d00",
                        "on-surface": "#191b22",
                        "error": "#ba1a1a",
                        "inverse-on-surface": "#f0f0f9",
                        "outline-variant": "#c3c6d5",
                        "on-error-container": "#93000a",
                        "on-error": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Arial", "Helvetica", "sans-serif"],
                        "display": ["Arial", "Helvetica", "sans-serif"],
                        "body": ["Arial", "Helvetica", "sans-serif"],
                        "label": ["Arial", "Helvetica", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>
<body class="bg-background text-on-background selection:bg-primary-fixed selection:text-on-primary-fixed-variant min-h-screen">


@include('layouts.client.partials.header')
<!-- Main Content -->
<main class="max-w-[1440px] mx-auto px-6 lg:px-8 mt-0 mb-12">
    @if(session('success'))
        <div class="rounded-3xl border border-emerald-100 bg-emerald-50 px-6 py-4 text-sm text-emerald-900 shadow-sm mb-6 flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl">check_circle</span>
            <div>{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="rounded-3xl border border-error-container bg-error-container/40 px-6 py-4 text-sm text-error shadow-sm mb-6 flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl">error</span>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    {{ $slot }}
</main>

@include('layouts.client.partials.footer')
@include('layouts.client.partials.scripts')

<div id="chatbox-widget" class="fixed bottom-6 right-6 z-50">
    <button id="chatbox-toggle" class="flex items-center gap-2 rounded-full bg-primary px-5 py-3 text-white shadow-lg hover:bg-primary-container transition">
        <span class="material-symbols-outlined">support_agent</span>
        <span class="font-semibold">Hỗ trợ</span>
    </button>

    <div id="chatbox-panel" class="mt-3 hidden w-80 max-w-[90vw] rounded-3xl border border-surface-container bg-white shadow-2xl overflow-hidden">
        <div class="bg-primary px-4 py-3 text-white flex items-center justify-between">
            <div>
                <p class="font-semibold">N.clothes Support</p>
                <p class="text-sm text-white/80">Trợ lý AI hỗ trợ khách hàng</p>
            </div>
            <button id="chatbox-close" class="rounded-full p-1 hover:bg-white/10">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <div id="chatbox-messages" class="h-80 overflow-y-auto bg-surface/40 p-4 space-y-3">
            <div class="rounded-2xl bg-primary/10 p-3 text-sm text-primary">
                Chào bạn! Tôi là trợ lý hỗ trợ của N.clothes. Bạn cần hỗ trợ gì hôm nay?
            </div>
        </div>

        <form id="chatbox-form" class="border-t border-surface-container bg-white p-3">
            <div class="flex gap-2">
                <input id="chatbox-input" type="text" class="flex-1 rounded-2xl border border-surface-container px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30" placeholder="Nhập câu hỏi..." autocomplete="off" />
                <button class="rounded-2xl bg-primary px-3 py-2 text-white" type="submit">
                    <span class="material-symbols-outlined">send</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('chatbox-toggle');
        const closeButton = document.getElementById('chatbox-close');
        const panel = document.getElementById('chatbox-panel');
        const form = document.getElementById('chatbox-form');
        const input = document.getElementById('chatbox-input');
        const messages = document.getElementById('chatbox-messages');

        if (!toggleButton || !panel || !form || !input || !messages) return;

        toggleButton.addEventListener('click', function () {
            panel.classList.toggle('hidden');
        });

        closeButton?.addEventListener('click', function () {
            panel.classList.add('hidden');
        });

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            const message = input.value.trim();
            if (!message) return;

            appendMessage(message, 'user');
            input.value = '';
            appendMessage('Đang soạn câu trả lời...', 'bot', true);

            fetch("{{ route('chatbox.message') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ message })
            })
            .then(response => response.json())
            .then(data => {
                const typingBubble = messages.querySelector('[data-typing="true"]');
                if (typingBubble) typingBubble.remove();
                appendMessage(data.reply || 'Xin lỗi, tôi chưa thể trả lời lúc này.', 'bot');

                if (Array.isArray(data.cards) && data.cards.length > 0) {
                    appendProductCards(data.cards);
                }
            })
            .catch(() => {
                const typingBubble = messages.querySelector('[data-typing="true"]');
                if (typingBubble) typingBubble.remove();
                appendMessage('Xin lỗi, hệ thống đang gặp sự cố. Vui lòng thử lại sau.', 'bot');
            });
        });

        function appendMessage(text, sender, typing = false) {
            const bubble = document.createElement('div');
            bubble.className = sender === 'user'
                ? 'ml-auto max-w-[85%] rounded-2xl bg-primary px-3 py-2 text-sm text-white'
                : 'max-w-[85%] rounded-2xl bg-white p-3 text-sm text-on-background shadow-sm';
            bubble.setAttribute('data-typing', typing ? 'true' : 'false');
            bubble.textContent = text;
            messages.appendChild(bubble);
            messages.scrollTop = messages.scrollHeight;
        }

        function appendProductCards(cards) {
            const wrapper = document.createElement('div');
            wrapper.className = 'grid gap-3';

            cards.forEach(card => {
                const cardEl = document.createElement('div');
                cardEl.className = 'rounded-3xl border border-surface-container bg-white p-3 shadow-sm';

                const image = document.createElement('img');
                image.className = 'mb-3 h-32 w-full rounded-2xl object-cover';
                image.src = card.image || 'https://via.placeholder.com/400x300?text=N.clothes';
                image.alt = card.name;
                cardEl.appendChild(image);

                const title = document.createElement('p');
                title.className = 'text-sm font-semibold text-slate-900';
                title.textContent = card.name;
                cardEl.appendChild(title);

                const category = document.createElement('p');
                category.className = 'text-xs text-slate-500 mt-1';
                category.textContent = card.category || '';
                cardEl.appendChild(category);

                const price = document.createElement('p');
                price.className = 'text-sm font-semibold text-primary mt-2';
                price.textContent = card.price;
                cardEl.appendChild(price);

                const actions = document.createElement('div');
                actions.className = 'mt-3 flex gap-2';

                const infoButton = document.createElement('a');
                infoButton.href = card.url;
                infoButton.target = '_blank';
                infoButton.className = 'inline-flex flex-1 items-center justify-center rounded-full border border-surface-container bg-surface px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-primary hover:text-primary';
                infoButton.textContent = 'Xem chi tiết';
                actions.appendChild(infoButton);

                const buyButton = document.createElement('a');
                buyButton.href = card.buy_url;
                buyButton.target = '_blank';
                buyButton.className = 'inline-flex flex-1 items-center justify-center rounded-full bg-primary px-3 py-2 text-xs font-semibold text-white transition hover:bg-primary-dark';
                buyButton.textContent = 'Mua ngay';
                actions.appendChild(buyButton);

                cardEl.appendChild(actions);
                wrapper.appendChild(cardEl);
            });

            const cardBubble = document.createElement('div');
            cardBubble.className = 'max-w-[85%] rounded-2xl bg-white p-3 shadow-sm';
            cardBubble.appendChild(wrapper);
            messages.appendChild(cardBubble);
            messages.scrollTop = messages.scrollHeight;
        }
    });
</script>
</body>
</html>