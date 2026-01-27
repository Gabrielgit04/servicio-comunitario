<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contraseña actualizada</title>
  <style>
    :root {
      --bg: #0f172a;        /* slate-900 */
      --card: #111827;      /* gray-900 */
      --text: #e5e7eb;      /* gray-200 */
      --muted: #9ca3af;     /* gray-400 */
      --accent: #22c55e;    /* green-500 */
      --accent-700: #15803d;/* green-700 */
      --focus: #93c5fd;     /* blue-300 */
    }

    * { box-sizing: border-box; }
    html, body {
      height: 100%;
      margin: 0;
      background: radial-gradient(1200px 600px at 20% 0%, #0b132b 0%, var(--bg) 55%, #0a0f1f 100%);
      color: var(--text);
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
      line-height: 1.5;
    }

    .container {
      min-height: 100%;
      display: grid;
      place-items: center;
      padding: 24px;
    }

    .card {
      width: 100%;
      max-width: 560px;
      background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.01));
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 16px;
      padding: 32px;
      backdrop-filter: blur(6px);
      box-shadow:
        0 30px 60px -20px rgba(0,0,0,0.35),
        inset 0 1px 0 rgba(255,255,255,0.06);
    }

    .icon-wrap {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: rgba(34, 197, 94, 0.15);
      border: 1px solid rgba(34, 197, 94, 0.35);
      margin-bottom: 16px;
    }

    .title {
      font-size: clamp(1.5rem, 2.2vw, 2rem);
      margin: 0 0 8px;
      letter-spacing: 0.2px;
    }

    .subtitle {
      margin: 0 0 24px;
      color: var(--muted);
      font-size: 0.98rem;
    }

    .details {
      background: rgba(255,255,255,0.03);
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 12px;
      padding: 16px 18px;
      margin-bottom: 24px;
    }

    .details p {
      margin: 0;
      font-size: 0.95rem;
    }

    .actions {
      display: grid;
      grid-template-columns: 1fr;
      gap: 12px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px 16px;
      border-radius: 10px;
      border: 1px solid rgba(255,255,255,0.08);
      background: linear-gradient(180deg, var(--accent), var(--accent-700));
      color: white;
      font-weight: 600;
      font-size: 0.98rem;
      text-decoration: none;
      transition: transform 0.08s ease, box-shadow 0.2s ease;
    }
    .btn:hover { transform: translateY(-1px); box-shadow: 0 12px 24px -10px rgba(34,197,94,0.45); }
    .btn:focus-visible { outline: 3px solid var(--focus); outline-offset: 3px; }

    .btn.secondary {
      background: transparent;
      color: var(--text);
      border-color: rgba(255,255,255,0.14);
    }
    .btn.secondary:hover { background: rgba(255,255,255,0.06); }

    footer {
      margin-top: 20px;
      text-align: center;
      color: var(--muted);
      font-size: 0.9rem;
    }

    /* Preferencias de usuario para menos movimiento */
    @media (prefers-reduced-motion: reduce) {
      .btn { transition: none; }
    }
  </style>
</head>
<body>
  <main class="container" role="main">
    <section class="card" aria-labelledby="titulo">
      <div class="icon-wrap" aria-hidden="true">
        <!-- Check SVG -->
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" aria-hidden="true">
          <path d="M20 7L9 18l-5-5" stroke="#22c55e" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>

      <h1 id="titulo" class="title">Tu contraseña se actualizó correctamente</h1>
      <p class="subtitle">Por seguridad, cerramos tu sesion anterior. Usa tu nueva contraseña al iniciar sesión.</p>

      <div class="details" role="status" aria-live="polite">
        <p><strong>Estado:</strong> Cambio confirmado. Si no fuiste tú, restablece tu contraseña nuevamente y contáctanos.</p>
      </div>

      <div class="actions">
        <a class="btn" href="../login/index.php" aria-label="Ir a iniciar sesión">
          <!-- Login icon -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M10 17l5-5-5-5M15 12H3" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 21V3" stroke="white" stroke-opacity="0.6" stroke-width="2" stroke-linecap="round"/>
          </svg>
          Iniciar sesión
        </a>
      </div>

      <footer>
        <span>¿Necesitas ayuda? Comunícate con soporte.</span>
      </footer>
    </section>
  </main>
</body>
</html>
