<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/style.css') }}">
    <script src="{{ asset('js/main.js') }}" defer></script>
    <title>FlowERP</title>
</head>

<body>
    <div class="screen-base">
        @include('layouts.side_bar')

        <section class="main-side">
            <header class="main-header shadow-sm">
                <!-- Cabeçalho pode ser adicionado aqui -->
            </header>

            <main class="main-content">
                @yield('content')
            </main>
        </section>
    </div>

</body>

</html>