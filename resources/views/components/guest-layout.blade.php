@props(['title' => config('app.name', 'N.clothes')])

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'N.clothes') }} - {{ $title }}</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        tertiary: '#651f00',
                        'on-tertiary-fixed-variant': '#802900',
                        outline: '#737784',
                        'surface-container': '#ededf6',
                        'on-primary': '#ffffff',
                        background: '#faf8ff',
                        secondary: '#4e5e85',
                        'primary-fixed-dim': '#b1c5ff',
                        'tertiary-fixed-dim': '#ffb59a',
                        primary: '#00327d',
                        'on-background': '#191b22',
                        'surface-variant': '#e2e2eb',
                        'surface-bright': '#faf8ff',
                        'surface-container-high': '#e7e2f0',
                        'on-primary-fixed-variant': '#00419e',
                        'tertiary-container': '#8b2e01',
                        'on-secondary-fixed-variant': '#37466c',
                        'secondary-container': '#c1d1ff',
                        'on-tertiary': '#ffffff',
                        'on-tertiary-container': '#ffaa8a',
                        'error-container': '#ffdad6',
                        'on-surface-variant': '#434653',
                        'surface-container-lowest': '#ffffff',
                        'on-primary-container': '#a5bdff',
                        'surface-tint': '#2559bd',
                        'surface-dim': '#d9d9e2',
                        surface: '#faf8ff',
                        'secondary-fixed': '#dae2ff',
                        'primary-container': '#0047ab',
                        'on-secondary': '#ffffff',
                        'on-primary-fixed': '#001946',
                        'surface-container-highest': '#e2e2eb',
                        'on-secondary-fixed': '#081a3e',
                        'inverse-surface': '#2e3037',
                        'tertiary-fixed': '#ffdbcf',
                        'inverse-primary': '#b1c5ff',
                        'secondary-fixed-dim': '#b6c6f3',
                        'primary-fixed': '#dae2ff',
                        'surface-container-low': '#f3f3fc',
                        'on-secondary-container': '#4a5980',
                        'on-tertiary-fixed': '#380d00',
                        'on-surface': '#191b22',
                        error: '#ba1a1a',
                        'inverse-on-surface': '#f0f0f9',
                        'outline-variant': '#c3c6d5',
                        'on-error-container': '#93000a',
                        'on-error': '#ffffff'
                    },
                    borderRadius: {
                        DEFAULT: '0.125rem',
                        lg: '0.25rem',
                        xl: '0.5rem',
                        full: '0.75rem'
                    },
                    fontFamily: {
                        headline: ['Arial', 'Helvetica', 'sans-serif'],
                        display: ['Arial', 'Helvetica', 'sans-serif'],
                        body: ['Arial', 'Helvetica', 'sans-serif'],
                        label: ['Arial', 'Helvetica', 'sans-serif']
                    }
                }
            }
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

<body class="min-h-screen bg-blue-50 text-slate-900 selection:bg-primary-fixed selection:text-on-primary-fixed-variant">
    {{ $slot }}
</body>
</html>
