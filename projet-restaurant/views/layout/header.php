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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css?v=<?= time() ?>">
</head>
<body>
<script>const BASE_URL = '<?= BASE_URL ?>';</script>
<nav class="navbar navbar-expand-lg navbar-dark navbar-marco">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>?action=home">Chez Marco</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <div class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="nav-link <?= $currentAction === 'plats' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=plats">Carte</a>
                    <a class="nav-link <?= $currentAction === 'mes_commandes' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=mes_commandes">Mes commandes</a>
                    <a class="nav-link <?= $currentAction === 'profil' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=profil"><?= htmlspecialchars($_SESSION['nom'] ?? '') ?></a>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <a class="nav-link nav-link-admin <?= str_starts_with($currentAction, 'admin') || str_starts_with($currentAction, 'plats_admin') ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=admin_dashboard">Admin</a>
                    <?php endif; ?>
                    <a class="nav-link" href="<?= BASE_URL ?>?action=logout">Deconnexion</a>
                <?php else: ?>
                    <a class="nav-link <?= $currentAction === 'login' ? 'active' : '' ?>" href="<?= BASE_URL ?>?action=login">Connexion</a>
                    <a class="nav-link btn-inscription" href="<?= BASE_URL ?>?action=register">Inscription</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-5">

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
