<?php require_once dirname(__DIR__, 3) . '/servicio-comunitario/config.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contacto</title>
  <style>
    :root {
      --bg: #0f172a;        /* fondo */
      --card: #111827;      /* tarjeta */
      --text: #e5e7eb;      /* texto principal */
      --muted: #9ca3af;     /* texto secundario */
      --accent: #22c55e;    /* acento (verde) */
      --accent-700: #16a34a;/* acento hover */
      --border: #1f2937;    /* bordes */
      --error: #ef4444;     /* error */
      --focus: #22d3ee;     /* foco (cian) */
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
      background: radial-gradient(1200px 500px at 10% 10%, #0b1220 0%, var(--bg) 40%, #0b1220 100%);
      color: var(--text);
      line-height: 1.5;
    }

    .wrap {
      max-width: 960px;
      margin: 0 auto;
      padding: 32px 20px 56px;
    }

    header {
      text-align: center;
      margin-bottom: 28px;
    }

    header h1 {
      margin: 0 0 8px;
      font-weight: 700;
      letter-spacing: 0.3px;
      font-size: 2rem;
    }

    header p {
      margin: 0;
      color: var(--muted);
      font-size: 0.975rem;
    }

    .grid {
      display: grid;
      grid-template-columns: 1.15fr 1fr;
      gap: 24px;
    }

    @media (max-width: 820px) {
      .grid { grid-template-columns: 1fr; }
    }

    .card {
      background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0));
      border: 1px solid var(--border);
      border-radius: 16px;
      backdrop-filter: saturate(120%) blur(6px);
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    .card .body {
      padding: 24px;
    }

    .card h2 {
      margin: 0 0 16px;
      font-size: 1.15rem;
      letter-spacing: 0.2px;
    }

    .contact-info {
      padding: 18px 24px;
      border-top: 1px solid var(--border);
      display: grid;
      gap: 10px;
    }

    .contact-item {
      display: flex;
      gap: 10px;
      align-items: center;
      color: var(--muted);
      font-size: 0.95rem;
    }

    .contact-item .dot {
      width: 9px; height: 9px; border-radius: 50%;
      background: var(--accent);
      box-shadow: 0 0 10px var(--accent);
      flex: 0 0 9px;
    }

    form {
      display: grid;
      gap: 14px;
    }

    .field {
      display: grid;
      gap: 6px;
    }

    label {
      font-size: 0.9rem;
      color: var(--muted);
    }

    .row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px;
    }

    @media (max-width: 640px) {
      .row { grid-template-columns: 1fr; }
    }
    .back{
      width: 90%;
      background-color: #dddddd;
      border-radius: 10px;
      display: flex;
      justify-content:center;
      align-items:center;
      padding:5px;
    }
    .left{
      height: 25px;
      width: 30px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    select,
    textarea {
      width: 100%;
      padding: 12px 12px;
      border-radius: 10px;
      border: 1px solid var(--border);
      background: #0b1220;
      color: var(--text);
      outline: none;
      transition: border-color 160ms, box-shadow 160ms, transform 80ms;
    }

    textarea { min-height: 140px; resize: none; }

    input::placeholder,
    textarea::placeholder { color: #6b7280; }

    input:focus, select:focus, textarea:focus {
      border-color: var(--focus);
      box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
    }

    .checkbox {
      display: flex;
      gap: 10px;
      align-items: flex-start;
      padding-top: 4px;
      color: var(--muted);
      font-size: 0.9rem;
    }

    .actions {
      display: flex;
      gap: 12px;
      align-items: center;
      justify-content: flex-start;
      margin-top: 6px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 16px;
      border-radius: 12px;
      border: 1px solid transparent;
      background: linear-gradient(180deg, var(--accent), var(--accent-700));
      color: #04210f;
      font-weight: 600;
      letter-spacing: 0.3px;
      cursor: pointer;
      transition: transform 80ms ease, filter 120ms ease, box-shadow 120ms ease;
      box-shadow: 0 8px 24px rgba(22, 163, 74, 0.25);
    }

    .btn:hover { filter: brightness(1.05) contrast(1.02); }
    .btn:active { transform: translateY(1px) scale(0.995); }

    .note {
      color: var(--muted);
      font-size: 0.85rem;
    }

    /* Estado de error accesible (utilizando :invalid) */
    input:invalid, textarea:invalid, select:invalid {
      border-color: rgba(239, 68, 68, 0.7);
    }

    /* Pequeño detalle decorativo */
    .accent-bar {
      height: 3px;
      background: linear-gradient(90deg, var(--accent) 0%, #22d3ee 60%, #818cf8 100%);
      border-radius: 999px;
      margin: 0 24px;
    }

  </style>
</head>
<body>
  <main class="wrap">
    <header>
      <h1>Hablemos</h1>
      <p>Cuéntame qué necesitas y te responderé lo antes posible.</p>
    </header>

    <div class="grid">
      <!-- Formulario -->
      <section class="card" aria-labelledby="form-title">
        <div class="accent-bar" aria-hidden="true"></div>
        <div class="body">
          <h2 id="form-title">Formulario de contacto</h2>

          <form action="https://formspree.io/f/xovrzvra" method="post" novalidate>
            <div class="row">
              <div class="field">
                <label for="name">Nombre completo</label>
                <input id="name" name="name" type="text" placeholder="Tu nombre"
                       autocomplete="name" required />
              </div>

              <div class="field">
                <label for="email">Correo electrónico</label>
                <input id="email" name="email" type="email" placeholder="tucorreo@ejemplo.com"
                       autocomplete="email" required />
              </div>
            </div>

            <div class="row">
              <div class="field">
                <label for="phone">Teléfono (opcional)</label>
                <input id="phone" name="phone" type="tel" placeholder="+58 400 000 0000"
                       autocomplete="tel" />
              </div>

              <div class="field">
                <label for="subject">Asunto</label>
                <select id="subject" name="subject" required>
                  <option value="" disabled selected>Selecciona una opción</option>
                  <option>Consulta</option>
                  <option>Soporte</option>
                  <option>Colaboración</option>
                  <option>Otro</option>
                </select>
              </div>
            </div>

            <div class="field">
              <label for="message">Mensaje</label>
              <textarea id="message" name="message" placeholder="Cuéntame los detalles…" required></textarea>
            </div>

            <div class="checkbox">
              <input id="privacy" name="privacy" type="checkbox" required aria-describedby="privacy-desc" />
              <label for="privacy">
                Acepto el uso de mis datos para responder a esta solicitud.
              </label>
            </div>
            <p id="privacy-desc" class="note">Tus datos no se compartirán con terceros.</p>

            <div class="actions">
              <button class="btn" type="submit">Enviar mensaje</button>
              <span class="note">Tiempo de respuesta habitual: 24–48 h.</span>
            </div>
          </form>
        </div>
      </section>

      <!-- Información de contacto -->
      <aside class="card" aria-labelledby="info-title">
        <div class="body">
          <h2 id="info-title">Información</h2>
          <p class="note">Si prefieres, también puedes escribirme directamente o visitar mis redes.</p>

          <div class="contact-info" role="list">
            <div class="contact-item" role="listitem">
              <span class="dot" aria-hidden="true"></span>
              <span><strong>Email:</strong>gabrielmoises1202@gmail.com</span>
            </div>
            <div class="contact-item" role="listitem">
              <span class="dot" aria-hidden="true"></span>
              <span><strong>Teléfono:</strong> +58 412 656 2412</span>
            </div>
            <div class="contact-item" role="listitem">
              <span class="dot" aria-hidden="true"></span>
              <span><strong>Dirección:</strong> Cardón, Falcón, Venezuela</span>
            </div>
            </div>
          </div>
        </div>
        <figure class="back">
            <a href="../main-menu/index.php">
              <img src="../assets/imgs/icons/arrow-left.svg" alt="volver" class="left">
            </a>
        </figure>
      </aside>
    </div>
  </main>
</body>
</html>
