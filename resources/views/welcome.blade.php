<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lionsss Academy - Bienvenido</title>
    <style>
        /* --- ESTILOS GENERALES --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #0f172a; /* Fondo azul muy oscuro (casi negro) */
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- HERO SECTION (ENCABEZADO) --- */
        .hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%); /* Degradado Azul */
            padding: 80px 20px;
            text-align: center;
            border-bottom: 4px solid #3b82f6;
        }

        .logo {
            font-size: 3.5rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 10px;
        }

        .logo span { color: #3b82f6; } /* Azul Brillante */

        .subtitle {
            font-size: 1.2rem;
            color: #94a3b8;
            margin-bottom: 40px;
        }

        /* --- BOTONES DE ACCESO --- */
        .login-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            border: 2px solid transparent;
            min-width: 250px;
        }

        /* Botón Admin - Azul Sólido */
        .btn-admin {
            background-color: #2563eb;
            color: white;
        }
        .btn-admin:hover {
            background-color: #1d4ed8;
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.5);
        }

        /* Botón Trainer - Borde Azul (Outline) */
        .btn-trainer {
            background-color: transparent;
            border: 2px solid #3b82f6;
            color: #3b82f6;
        }
        .btn-trainer:hover {
            background-color: #3b82f6;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        /* --- PANELES DE IMÁGENES --- */
        .gallery-section {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
            flex-grow: 1;
        }

        .grid-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5rem;
            color: #e2e8f0;
            border-left: 5px solid #3b82f6;
            display: inline-block;
            padding-left: 15px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #1e293b;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
            border: 1px solid #334155;
        }

        .card:hover {
            transform: scale(1.02);
            border-color: #3b82f6;
        }

        .card-img {
            width: 100%;
            height: 200px;
            background-color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 3rem;
        }
        
        /* Esto es para que pongas tus fotos reales luego */
        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }

        .card h3 { color: #60a5fa; margin-bottom: 10px; }
        .card p { color: #cbd5e1; font-size: 0.9rem; line-height: 1.5; }

        /* --- FOOTER --- */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #020617;
            color: #475569;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

    <section class="hero">
        <div class="logo">LIONSSS <span>ACADEMY</span></div>
        <p class="subtitle">Forjando campeones, transformando vidas.</p>
        
        <div class="login-container">
            <a href="/admin/login" class="btn btn-admin">
                🔐 Acceso Administrativo
            </a>
            <a href="/trainer/login" class="btn btn-trainer">
                🏋️‍♂️ Acceso Entrenadores
            </a>
        </div>
    </section>

    <section class="gallery-section">
        <div style="text-align:center; width:100%"><h2 class="grid-title">Nuestras Instalaciones</h2></div>
        
        <div class="grid">
            <div class="card">
                <div class="card-img">🏋️‍♀️</div> <div class="card-body">
                    <h3>Zona de Pesas</h3>
                    <p>Equipamiento profesional de alto rendimiento para maximizar tu fuerza.</p>
                </div>
            </div>

            <div class="card">
                <div class="card-img">🏃‍♂️</div>
                <div class="card-body">
                    <h3>Cardio & Funcional</h3>
                    <p>Espacios diseñados para resistencia, agilidad y acondicionamiento físico.</p>
                </div>
            </div>

            <div class="card">
                <div class="card-img">🥊</div>
                <div class="card-body">
                    <h3>Área de Combate</h3>
                    <p>Tatami profesional para disciplinas de contacto y defensa personal.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        &copy; 2026 Lionsss Academy. Sistema de Gestión Integral.
    </footer>

</body>
</html>