<?php
// Redirige vers login si l'utilisateur n'est pas connecté
function requireAuth(): void {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '?action=login');
        exit;
    }
}

// Vérifie que l'utilisateur est connecté ET possède le rôle attendu
function requireRole(string $role): void {
    requireAuth();
    if ($_SESSION['role'] !== $role) {
        http_response_code(403);
        die('<h2>Acces refuse.</h2><a href="' . BASE_URL . '?action=home">Retour</a>');
    }
}

// Enregistre un message flash en session (affiché une seule fois)
function setFlash(string $type, string $message): void {
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

// Récupère et supprime le message flash de la session
function getFlash(): ?array {
    if (!isset($_SESSION['flash'])) return null;
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}
