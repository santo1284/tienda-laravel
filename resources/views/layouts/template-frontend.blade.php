<!-- resources/views/layouts/template-frontend.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MiTienda') }}</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Outline&family=Bungee&family=Creepster&family=Press+Start+2P&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="urban-particle"></div>
        <div class="urban-particle"></div>
        <div class="urban-particle"></div>
        <div class="urban-particle"></div>
        <div class="urban-particle"></div>

        <div class="street-art art1">FRESH</div>
        <div class="street-art art2">STYLE</div>
        <div class="street-art art3">VIBE</div>

        <div class="overlay">
            <nav class="navbar">
                <a href="/" class="logo">MiTienda</a>
                <ul class="menu">
                    <li><a href="/">Inicio</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#contacto">Contacto</a></li>

                   @guest
    <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
    <li><a href="{{ route('register') }}">Registrarse</a></li>
            @endguest

            @auth
                <li class="dropdown">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-toggle">
                        Hola, {{ Auth::user()->name }} <i class="fa fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endauth


                </ul>

                <div class="socials">
                    <a href="#"><i class="fa-brands fa-facebook fa-2x"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram fa-2x"></i></a>
                </div>
            </nav>

            <div class="header-content">
                <h1 class="brand-name">ELEGANCIA URBAN</h1>
                <p class="brand-subtitle">El arte de vestir la ciudad</p>
                <button class="cta-button">Comprar Ya</button>
            </div>
        </div>
    </header>

    <!-- Contenido dinámico -->
    <main>
        @yield('contenido')
    </main>

    <!-- Footer -->
    <footer class="footer" id="contacto">
        <div class="footer-content">
            <p>&copy; {{ now()->year }} MiTienda. Todos los derechos reservados.</p>
            <p>Contacto: info@mitienda.shop</p>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js')}}"></script>
    @livewireScripts

    <script>
        // Botón urbano
        document.querySelector('.cta-button')?.addEventListener('click', function () {
            this.style.animation = 'none';
            this.style.transform = 'translateY(-2px) scale(0.95) rotate(-2deg)';
            setTimeout(() => {
                this.style.transform = 'translateY(-5px) scale(1.05) rotate(2deg)';
                this.style.animation = 'buttonGlow 1.5s ease-in-out infinite alternate';
            }, 100);
        });

        // Partículas
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('cta-button')) return;

            const particle = document.createElement('div');
            particle.style.position = 'absolute';
            particle.style.left = e.clientX + 'px';
            particle.style.top = e.clientY + 'px';
            particle.style.width = '4px';
            particle.style.height = '4px';
            particle.style.background = '#ff0080';
            particle.style.borderRadius = '50%';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '1000';
            particle.style.animation = 'urbanFloat 1s ease-out forwards';
            document.body.appendChild(particle);

            setTimeout(() => particle.remove(), 1000);
        });
    </script>
</body>
</html>
