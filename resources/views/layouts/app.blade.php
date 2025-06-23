<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="autocomplete" content="off">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Plataforma')</title>
        @livewireStyles
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="{{ asset('css/funciones-teatro.css') }}" rel="stylesheet">
        @vite(['resources/css/app.css'])

    </head>
    <body>
        <header class="py-1">
            <div class="container-fluid">
                <svg width="170" height="60" viewBox="0 0 170 60" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="45" font-family="Arial, sans-serif" font-size="40" font-weight="bold" fill="#333">{J3}</text>
                </svg>
            </div>
        </header>

        <main class="py-1">
            <div class="container py-5">
                {{ $slot }}
            </div>
        </main>

        <footer class="py-5 text-center">
            <p class="mb-0 py-5">Empoderado por<a href="https://www.linkedin.com/in/miguelrojasoficial/" class="text-decoration-none" target="_blank"> <strong>MigueRojas</strong></a> | &copy; Todos los derechos reservados</p>
        </footer>


        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        @livewireScripts
        @stack('scripts')
    </body>
</html>

