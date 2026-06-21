<?php $title = 'Page introuvable'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Page introuvable · Chez Marco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,700;1,6..96,700&family=Cormorant+Garamond:wght@300;400;600&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/favicon.png">
    <style>
        :root {
            --color-noir: #1A1A1A;
            --color-dore: #C9A84C;
            --color-blanc: #FBF9F6;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: var(--color-noir);
            font-family: 'Inter', sans-serif;
            color: var(--color-blanc);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            overflow: hidden;
        }
        /* Fond décoratif */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 50% 0%, rgba(201,168,76,0.08) 0%, transparent 70%),
                radial-gradient(ellipse 40% 30% at 80% 80%, rgba(201,168,76,0.04) 0%, transparent 60%);
            pointer-events: none;
        }
        .error-number {
            font-family: 'Bodoni Moda SC', Georgia, serif;
            font-size: clamp(6rem, 20vw, 12rem);
            font-weight: 700;
            font-style: italic;
            color: transparent;
            -webkit-text-stroke: 2px var(--color-dore);
            line-height: 1;
            opacity: 0.6;
            user-select: none;
        }
        .divider-dore {
            width: 60px;
            height: 2px;
            background: var(--color-dore);
            margin: 1.5rem auto;
            border-radius: 2px;
        }
        .error-title {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: clamp(1.4rem, 4vw, 2rem);
            font-weight: 600;
            color: var(--color-blanc);
            letter-spacing: 1px;
        }
        .error-subtitle {
            color: rgba(251,249,246,0.55);
            font-size: 0.95rem;
            max-width: 360px;
            margin: 0.75rem auto 2rem;
            line-height: 1.7;
        }
        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--color-dore);
            color: var(--color-noir);
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 0.85rem 2.2rem;
            border-radius: 50px;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }
        .btn-home:hover {
            background: #e0c068;
            color: var(--color-noir);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(201,168,76,0.35);
        }
        .brand-link {
            position: fixed;
            top: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            font-family: 'Bodoni Moda SC', Georgia, serif;
            font-style: italic;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-dore);
            text-decoration: none;
            letter-spacing: 1px;
        }
        .brand-link:hover { color: #e0c068; }
    </style>
</head>
<body>
    <a class="brand-link" href="<?= BASE_URL ?>?action=home">Chez Marco</a>

    <div class="error-number">404</div>
    <div class="divider-dore"></div>
    <p class="error-title">Table introuvable</p>
    <p class="error-subtitle">
        La page que vous cherchez n'existe pas ou a été déplacée.<br>
        Laissez-nous vous guider vers notre carte.
    </p>
    <a href="<?= BASE_URL ?>?action=home" class="btn-home">
        <i class="bi bi-house-door"></i> Retour à l'accueil
    </a>
</body>
</html>
