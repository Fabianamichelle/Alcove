<x-layouts::app.sidebar :title="$title ?? null">
    <style>
        /* Darken the Sidebar Background */
        [data-flux-sidebar] {
            background-color: #0f110d !important;
            border-right: 1px solid #1e211b !important;
        }

        /* Soften the Navigation Links */
        [data-flux-nav-link] {
            color: #5c5c52 !important;
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.05em;
        }

        [data-flux-nav-link]:hover, [data-flux-nav-link][data-current] {
            color: #f4f4f0 !important;
            background-color: rgba(244, 244, 240, 0.03) !important;
        }

        /* Hide the typical 'App' borders for a cleaner look */
        [data-flux-main] {
            background-color: #0f110d !important;
        }
    </style>

    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>