<?php
session_start();
require_once 'config/db.php';
require_once 'config/helpers.php';
require_once 'controllers/AuthController.php';

$auth = new AuthController($pdo);
$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        $title = 'Accueil';
        require 'views/layout/header.php';
        echo '<h2 class="mt-4">Bienvenue chez Marco</h2>';
        require 'views/layout/footer.php';
        break;
    case 'register':      $auth->showRegister(); break;
    case 'register_post': $auth->register();     break;
    default:
        http_response_code(404);
        echo '404 - Page non trouvee';
}

