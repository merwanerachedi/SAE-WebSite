<?php 
$title = $title ?? 'Chez Marco'; 
$currentAction = $_GET['action'] ?? 'home';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> — Chez Marco</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bodoni+Moda+SC:ital,opsz,wght@0,6..96,700;0,6..96,900;1,6..96,700&family=Cormorant+Garamond:wght@300;400;600;700&family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="<?= BASE_URL ?>public/favicon.png">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css?v=<?= time() ?>">
</head>
<body>
<script>const BASE_URL = '<?= BASE_URL ?>';</script>
<nav class="navbar navbar-expand-lg navbar-dark navbar-marco">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>?action=home">
            Chez Marco
        </a>
        <button class="navbar-toggler shadow-none border-0 px-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <div class="navbar-nav ms-auto align-items-lg-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="nav-link <?= $currentAction === 'plats' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=plats">Carte</a>
                    <a class="nav-link <?= $currentAction === 'mes_commandes' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=mes_commandes">Mes commandes</a>
                    <a class="nav-link <?= $currentAction === 'profil' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=profil">
                        <i class="bi bi-person-circle me-1 text-dore"></i> <?= htmlspecialchars($_SESSION['nom'] ?? '') ?>
                    </a>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <a class="nav-link nav-link-admin ms-lg-2 <?= str_starts_with($currentAction, 'admin') || str_starts_with($currentAction, 'plats_admin') ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=admin_dashboard">
                            <span class="badge bg-dore text-noir rounded-pill px-3 py-2">Admin</span>
                        </a>
                    <?php endif; ?>
                    <a class="nav-link text-danger ms-lg-3" href="<?= BASE_URL ?>?action=logout" title="Déconnexion"><i class="bi bi-box-arrow-right fs-5"></i></a>
                <?php else: ?>
                    <a class="nav-link <?= $currentAction === 'login' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=login">Connexion</a>
                    <a class="nav-link btn-inscription ms-lg-2 mt-2 mt-lg-0" href="<?= BASE_URL ?>?action=register">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container py-2">

<?php
// Affichage du flash message s'il existe
$flash = getFlash();
if ($flash):
    $alertClass = match($flash['type']) {
        'success' => 'alert-success',
        'error'   => 'alert-danger',
        'warning' => 'alert-warning',
        default   => 'alert-info',
    };
?>
<div class="alert <?= $alertClass ?> alert-dismissible fade show" role="alert">
    <?= htmlspecialchars($flash['message']) ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>
