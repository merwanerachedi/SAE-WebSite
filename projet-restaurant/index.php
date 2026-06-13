<?php
session_start();
require_once 'config/db.php';
require_once 'config/helpers.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        $title = 'Accueil';
        require 'views/layout/header.php';
        echo '<h2 class="mt-4">Bienvenue chez Marco</h2>';
        require 'views/layout/footer.php';
        break;
    default:
        http_response_code(404);
        echo '404 - Page non trouvée';
}
