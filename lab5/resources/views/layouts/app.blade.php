<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Систем за Настани и Организатори</title>

    {{-- Овде може да додадете ваши CSS фајлови или да користите CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body { padding-top: 20px; padding-bottom: 20px; }
        .container { max-width: 1100px; }
        svg{
            display: none;
        }
        nav div{
            display: inline-block;
        }
    </style>
</head>
<body>
<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Events System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('organizers.index') }}">Организатори</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">Настани</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

{{-- Ова е делот каде што се вчитува содржината од другите View-а --}}
<main>
    @yield('content')
</main>

{{-- Овде може да додадете ваши JavaScript фајлови --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
