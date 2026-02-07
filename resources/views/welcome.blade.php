<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lionsss Academy - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #2563eb;
            /* Azul Lionsss */
            --dark-bg: #0f172a;
            /* Fondo oscuro */
            --text-white: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: var(--dark-bg);
            color: var(--text-white);
        }

        /* --- NAVBAR FLOTANTE --- */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background-color: rgba(15, 23, 42, 0.9);
            /* Semitransparente */
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(37, 99, 235, 0.3);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: white;
        }

        .logo span {
            color: var(--primary-blue);
        }

        .nav-buttons a {
            text-decoration: none;
            color: white;
            font-weight: 700;
            margin-left: 20px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .nav-buttons a:hover {
            color: var(--primary-blue);
        }

        /* --- HERO BANNER (1920x850) --- */
        .hero {
            /* AQUÍ ESTÁ LA MAGIA DE TU IMAGEN */
            height: 850px;
            /* Altura exacta que pediste */
            width: 100%;

            /* Cargamos la imagen y le ponemos un filtro oscuro encima para que el texto se lea */
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.4), rgba(15, 23, 42, 0.9)),
                url('/images/portada.png');

            background-size: cover;
            /* Asegura que cubra todo el ancho sin deformarse */
            background-position: center top;
            /* Centra la imagen priorizando la parte de arriba */

            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
        }

        .hero-content {
            max-width: 800px;
            padding: 20px;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 4.5rem;
            /* Letras GIGANTES */
            text-transform: uppercase;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 20px;
            text-shadow: 0 4px 15px rgba(0, 0, 0, 0.8);
        }

        .hero-content h1 span {
            color: var(--primary-blue);
            display: block;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 40px;
            color: #e2e8f0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
        }

        /* --- BOTONES DE ACCIÓN --- */
        .cta-container {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .btn {
            padding: 18px 50px;
            border-radius: 50px;
            /* Botones redondos modernos */
            text-decoration: none;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-blue);
            color: white;
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.4);
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-3px);
            box-shadow: 0 0 30px rgba(37, 99, 235, 0.8);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }

        .btn-outline:hover {
            background-color: white;
            color: var(--dark-bg);
            transform: translateY(-3px);
        }

        /* --- INFO BAR (Debajo del banner) --- */
        .info-bar {
            background-color: #1e293b;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            gap: 50px;
            flex-wrap: wrap;
            border-bottom: 1px solid #334155;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .info-icon {
            font-size: 2rem;
            color: var(--primary-blue);
        }

        .info-text h4 {
            font-size: 1.1rem;
            color: white;
        }

        .info-text p {
            font-size: 0.9rem;
            color: #94a3b8;
        }

        /* --- FOOTER --- */
        footer {
            background-color: black;
            padding: 30px;
            text-align: center;
            font-size: 0.8rem;
            color: #64748b;
        }

        /* Responsive para celulares */
        @media (max-width: 768px) {
            .hero {
                height: 600px;
            }

            /* En celular reducimos la altura */
            .hero-content h1 {
                font-size: 2.8rem;
            }

            .cta-container {
                flex-direction: column;
            }
        }

        /* --- ESTILO NUEVO PARA LOGO IMAGEN --- */
        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 60px;
            /* Ajusta este número según qué tan grande lo quieras */
            width: auto;
            /* Mantiene la proporción para que no se estire feo */
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
            /* Efecto zoom sutil al pasar el mouse */
        }

        /* --- CARRUSEL DE FOTOS (NUEVO) --- */
        .gallery-section {
            padding: 60px 20px;
            text-align: center;
            background-color: var(--dark-bg);
        }

        .gallery-title {
            font-size: 2.5rem;
            margin-bottom: 40px;
            text-transform: uppercase;
            font-weight: 900;
        }

        .gallery-title span {
            color: var(--primary-blue);
        }

        .carousel-container {
            position: relative;
            max-width: 1000px;
            /* Ancho máximo del carrusel */
            margin: 0 auto;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid #334155;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 500px;
            /* Altura fija para que no brinque */
        }

        .carousel-slide {
            min-width: 100%;
            height: 100%;
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Recorta la imagen para llenar el espacio sin deformar */
        }

        /* Botones del carrusel */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            font-size: 2rem;
            padding: 10px 20px;
            cursor: pointer;
            z-index: 10;
            transition: background 0.3s;
        }

        .carousel-btn:hover {
            background-color: var(--primary-blue);
        }
        .btn-prev { left: 10px; border-radius: 0 10px 10px 0; }
        .btn-next { right: 10px; border-radius: 10px 0 0 10px; }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">
            <img src="/images/logo.png" alt="Lionsss Academy Logo">
        </div>

        <div class="nav-buttons">
            <a href="/trainer/login">ENTRENADORES</a>
            <a href="/admin/login"
                style="border: 1px solid var(--primary-blue); padding: 8px 15px; border-radius: 20px;">LOGIN ADMIN</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>BIENVENIDO A <br> <span>LA MANADA</span></h1>
            <p>La plataforma definitiva para gestionar tu rendimiento, tus socios y tu éxito.</p>

            <div class="cta-container">
                <a href="/trainer/login" class="btn btn-primary">
                     SOY ENTRENADOR
                </a>
                <a href="" class="btn btn-outline">
                    SOY ASESORADO
                </a>
            </div>
        </div>
    </section>

    <section class="info-bar">
        <div class="info-item">
            <div class="info-icon">📍</div>
            <div class="info-text">
                <h4>Ubicación Central</h4>
                <p>Chilpancingo, Gro.</p>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">⚡</div>
            <div class="info-text">
                <h4>Sistema Online</h4>
                <p>Disponible 24/7</p>
            </div>
        </div>
        <div class="info-item">
            <div class="info-icon">🦁</div>
            <div class="info-text">
                <h4>Comunidad Lionsss</h4>
                <p>Solo para campeones</p>
            </div>
        </div>
    </section>

    <section class="gallery-section">
        <h2 class="gallery-title">Nuestros <span>Asesorados</span></h2>

        <div class="carousel-container">
            <button class="carousel-btn btn-prev" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-btn btn-next" onclick="nextSlide()">&#10095;</button>

            <div class="carousel-track" id="track">
                <div class="carousel-slide">
                    <img src="/images/carrusel/gym-1.jpg" alt="Asesorados 1">
                </div>
                <div class="carousel-slide">
                    <img src="/images/carrusel/gym-2.jpg" alt="Asesorados 2">
                </div>
                <div class="carousel-slide">
                    <img src="/images/carrusel/gym-3.jpg" alt="Asesorados 3">
                </div>
            </div>
        </div>
    </section>

    <footer>
        &copy; 2026 Lionsss Academy. Powered by CesarJam94.
    </footer>

    <script>
        let index = 0;
        const track = document.getElementById('track');
        const slides = document.querySelectorAll('.carousel-slide');
        const totalSlides = slides.length;

        function updateCarousel() {
            // Mueve el track hacia la izquierda según el índice
            const percentage = -index * 100;
            track.style.transform = `translateX(${percentage}%)`;
        }

        function nextSlide() {
            index++;
            if (index >= totalSlides) {
                index = 0; // Vuelve al inicio si llega al final
            }
            updateCarousel();
        }

        function prevSlide() {
            index--;
            if (index < 0) {
                index = totalSlides - 1; // Va al final si retrocede desde el inicio
            }
            updateCarousel();
        }

        // Auto-play: Cambia de foto cada 4 segundos (4000ms)
        setInterval(nextSlide, 4000);
    </script>

</body>

</html>