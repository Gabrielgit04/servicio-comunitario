<?php session_start()?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro exitoso</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #0f172a;        /* Slate 900 */
      --card: #111827;      /* Gray 900 */
      --text: #e5e7eb;      /* Gray 200 */
      --muted: #9ca3af;     /* Gray 400 */
      --primary: #22c55e;   /* Green 500 */
      --primary-700: #15803d;
      --ring: rgba(34, 197, 94, 0.25);
      --border: #1f2937;    /* Gray 800 */
    }

    * { box-sizing: border-box; }
    html, body {
      height: 100%;
      margin: 0;
      background: radial-gradient(1000px 600px at 20% 10%, #DDDDDD, var(--bg));
      color: var(--text);
      font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji', sans-serif;
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
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.0)) border-box,
                  linear-gradient(180deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02)) padding-box,
                  var(--card);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 32px;
      box-shadow:
        0 30px 60px -20px rgba(0,0,0,0.45),
        0 18px 36px -18px rgba(16,185,129,0.15);
      backdrop-filter: saturate(1.1);
    }

    .status {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 16px;
    }

    .badge {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      background: radial-gradient(110% 110% at 30% 30%, #2dd46f, #138a42);
      box-shadow:
        0 10px 20px -8px rgba(34,197,94,0.5),
        inset 0 0 0 6px rgba(255,255,255,0.18);
    }

    .badge svg {
      width: 26px;
      height: 26px;
      color: white;
      filter: drop-shadow(0 1px 1px rgba(0,0,0,0.35));
    }

    h1 {
      margin: 0;
      font-size: 1.5rem;
      line-height: 1.2;
      letter-spacing: 0.2px;
    }

    p {
      margin: 8px 0 0;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .details {
      margin-top: 20px;
      padding: 14px 16px;
      border: 1px dashed var(--border);
      border-radius: 12px;
      background: rgba(255,255,255,0.02);
      color: var(--muted);
      font-size: 0.92rem;
    }

    .actions {
      display: flex;
      gap: 12px;
      margin-top: 24px;
      flex-wrap: wrap;
    }

    .btn {
      appearance: none;
      border: 1px solid var(--border);
      background: #0b1324;
      color: var(--text);
      padding: 10px 16px;
      border-radius: 10px;
      font-weight: 600;
      letter-spacing: 0.2px;
      cursor: pointer;
      transition: transform 120ms ease, box-shadow 120ms ease, border-color 120ms ease;
    }

    .btn:hover {
      transform: translateY(-1px);
      border-color: #334155;
      box-shadow: 0 10px 18px -10px rgba(0,0,0,0.45);
    }

    .btn-primary {
      background: linear-gradient(180deg, #22c55e, #16a34a);
      border-color: transparent;
      color: #0a0f1c;
      text-shadow: 0 1px 0 rgba(255,255,255,0.25);
      box-shadow:
        0 12px 22px -10px rgba(34,197,94,0.55),
        0 2px 6px -2px rgba(0,0,0,0.35);
    }

    .btn-primary:hover {
      background: linear-gradient(180deg, #28d76a, #15803d);
      box-shadow:
        0 16px 26px -12px rgba(34,197,94,0.65),
        0 3px 8px -2px rgba(0,0,0,0.4);
    }

    .btn:focus-visible {
      outline: 0;
      box-shadow: 0 0 0 6px var(--ring);
    }

    footer {
      margin-top: 18px;
      color: var(--muted);
      font-size: 0.85rem;
      display: flex;
      gap: 8px;
      align-items: center;
    }

    .dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--primary);
      box-shadow: 0 0 0 6px rgba(34,197,94,0.12);
    }

    @media (max-width: 420px) {
      .card { padding: 24px; }
      .badge { width: 46px; height: 46px; }
      .badge svg { width: 22px; height: 22px; }
      h1 { font-size: 1.35rem; }
    }
  </style>
</head>
<body>
  <main class="container">
    <section class="card" role="status" aria-live="polite">
      <div class="status">
        <div class="badge" aria-hidden="true">
          <!-- Icono de check -->
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div>
          <h1>¡Registro exitoso!</h1>
          <p>Tu cuenta ha sido creada correctamente. Ya puedes iniciar sesión y comenzar.</p>
        </div>
      </div>

      <div class="details">
        ID de usuario: <strong><?php echo $_SESSION["idRegistered"] ?></strong> • Correo verificado: <strong>sí</strong><br>
        Si no reconoces este registro, contáctanos para ayudarte.
      </div>

      <div class="actions">
        <a class="btn btn-primary" href="../login/index.php" aria-label="Ir a iniciar sesión">Iniciar sesión</a>
      </div>

      <footer>
        <span class="dot" aria-hidden="true"></span>
        <span>Consejo: guarda tu correo de bienvenida, contiene pasos y enlaces útiles.</span>
      </footer>
    </section>
  </main>
</body>
</html>
