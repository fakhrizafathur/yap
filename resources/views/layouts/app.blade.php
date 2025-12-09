<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'App'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #06b6d4;
            --danger-color: #ef4444;
            --success-color: #10b981;
            color-scheme: light dark;
        }

        /* Light Mode (Default) */
        html:not([data-bs-theme="dark"]) {
            --bs-body-bg: #f8fafc;
            --bs-body-color: #1f2937;
            --bs-border-color: #e5e7eb;
            --bs-table-bg: white;
            --bs-table-border-color: #e5e7eb;
            --bs-form-control-bg: white;
            --bs-form-control-color: #1f2937;
            --bs-card-bg: white;
            --bs-card-border-color: #e5e7eb;
        }

        /* Dark Mode */
        html[data-bs-theme="dark"] {
            --bs-body-bg: #0f172a;
            --bs-body-color: #e5e7eb;
            --bs-border-color: #475569;
            --bs-table-bg: #1e293b;
            --bs-table-border-color: #475569;
            --bs-form-control-bg: #334155;
            --bs-form-control-color: #e5e7eb;
            --bs-card-bg: #1e293b;
            --bs-card-border-color: #475569;
        }

        body {
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        html[data-bs-theme="dark"] .navbar {
            background: linear-gradient(135deg, #4c1d95 0%, #1e1b4b 100%) !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease;
            margin-left: 1rem;
        }

        .nav-link:hover {
            color: white !important;
        }

        .theme-toggle {
            background: rgba(255,255,255,0.2) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            color: white !important;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .theme-toggle:hover {
            background: rgba(255,255,255,0.3) !important;
            border-color: white !important;
        }

        .btn {
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-success:hover {
            background-color: #059669;
            border-color: #059669;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #dc2626;
            border-color: #dc2626;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background-color: var(--bs-card-bg, white);
            color: var(--bs-body-color);
        }

        .card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .card-body {
            background-color: var(--bs-card-bg, white);
            color: var(--bs-body-color);
        }

        .card-title {
            color: var(--bs-body-color);
        }

        .table {
            font-size: 0.9rem;
            color: var(--bs-body-color);
            background-color: var(--bs-table-bg);
        }

        .table thead {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #374151;
        }

        html[data-bs-theme="dark"] .table thead {
            background-color: #334155;
            color: #e5e7eb;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        html[data-bs-theme="dark"] .table tbody tr:hover {
            background-color: #334155;
        }

        .table tbody td {
            border-color: var(--bs-table-border-color);
            color: var(--bs-body-color);
        }

        .form-control,
        .form-select {
            background-color: var(--bs-form-control-bg) !important;
            color: var(--bs-form-control-color) !important;
            border-color: var(--bs-border-color) !important;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        html[data-bs-theme="dark"] .form-control::placeholder {
            color: #6b7280;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: var(--bs-form-control-bg) !important;
            color: var(--bs-form-control-color) !important;
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25) !important;
        }

        .form-label {
            color: var(--bs-body-color);
        }

        .alert {
            border: none;
            border-radius: 0.75rem;
            color: var(--bs-body-color);
        }

        html[data-bs-theme="dark"] .alert-danger {
            background-color: #7f1d1d;
            color: #fee2e2;
        }

        html[data-bs-theme="dark"] .alert-success {
            background-color: #064e3b;
            color: #d1fae5;
        }

        .text-muted {
            color: #6b7280 !important;
            transition: color 0.3s ease;
        }

        html[data-bs-theme="dark"] .text-muted {
            color: #9ca3af !important;
        }

        .btn-link.nav-link {
            color: rgba(255,255,255,0.9) !important;
            text-decoration: none;
            border: none;
            padding: 0;
            margin-left: 0.5rem;
        }

        .btn-link.nav-link:hover {
            color: white !important;
        }

        main {
            min-height: 75vh;
        }

        /* Ensure all text and elements have proper color transition */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Override Bootstrap defaults for better dark mode */
        html[data-bs-theme="dark"] .btn-outline-secondary {
            color: #e5e7eb;
            border-color: #e5e7eb;
        }

        html[data-bs-theme="dark"] .btn-outline-secondary:hover {
            background-color: #e5e7eb;
            border-color: #e5e7eb;
            color: #1e293b;
        }

        /* Fixed Dark Mode Toggle Button */
        .theme-toggle-fixed {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .theme-toggle-fixed:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.6);
        }

        .theme-toggle-fixed:active {
            transform: scale(0.95);
        }

        html[data-bs-theme="dark"] .theme-toggle-fixed {
            background: linear-gradient(135deg, #4c1d95 0%, #1e1b4b 100%);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.6);
        }

        /* Responsive for mobile */
        @media (max-width: 768px) {
            .theme-toggle-fixed {
                bottom: 1.5rem;
                right: 1.5rem;
                width: 2.5rem;
                height: 2.5rem;
                font-size: 1.2rem;
            }
        }

        /* Fix Chrome Autofill */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        textarea:-webkit-autofill,
        textarea:-webkit-autofill:hover,
        textarea:-webkit-autofill:focus,
        select:-webkit-autofill,
        select:-webkit-autofill:hover,
        select:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px var(--bs-form-control-bg) inset !important;
            box-shadow: 0 0 0px 1000px var(--bs-form-control-bg) inset !important;
            -webkit-text-fill-color: var(--bs-form-control-color) !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
    @stack('head')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><i class="bi bi-person-badge-fill me-2"></i>{{ config('app.name', 'App') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Logout</button>
                        </form>
                    </li>
                @else
                    @if(Route::currentRouteName() !== 'login')
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<!-- Fixed Dark Mode Toggle Button -->
<button class="theme-toggle-fixed" id="themeToggle" type="button" title="Toggle Dark Mode">
    <i class="bi bi-moon-stars" id="themeIcon"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Dark Mode Toggle Script
    (function() {
        const html = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');

        // Initialize theme based on localStorage or system preference
        function initializeTheme() {
            const savedTheme = localStorage.getItem('theme');
            let theme = 'light';

            if (savedTheme) {
                theme = savedTheme;
            } else if (prefersDark.matches) {
                theme = 'dark';
            }

            applyTheme(theme);
        }

        // Apply theme to HTML element
        function applyTheme(theme) {
            if (theme === 'dark') {
                html.setAttribute('data-bs-theme', 'dark');
                themeIcon.classList.remove('bi-moon-stars');
                themeIcon.classList.add('bi-sun-fill');
                localStorage.setItem('theme', 'dark');
            } else {
                html.removeAttribute('data-bs-theme');
                themeIcon.classList.remove('bi-sun-fill');
                themeIcon.classList.add('bi-moon-stars');
                localStorage.setItem('theme', 'light');
            }
        }

        // Toggle theme
        function toggleTheme() {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            applyTheme(newTheme);
        }

        // Event listener for toggle button
        if (themeToggle) {
            themeToggle.addEventListener('click', toggleTheme);
        }

        // Listen for system preference changes
        prefersDark.addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                applyTheme(e.matches ? 'dark' : 'light');
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeTheme);
        // Also initialize immediately in case DOMContentLoaded already fired
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeTheme);
        } else {
            initializeTheme();
        }
    })();
</script>

@stack('scripts')
</body>
</html>
