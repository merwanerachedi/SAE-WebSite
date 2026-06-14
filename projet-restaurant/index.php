<?php
session_start();
require_once 'config/db.php';
require_once 'config/helpers.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/PlatController.php';

$auth = new AuthController($pdo);
$platCtrl = new PlatController($pdo);
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
    case 'login':         $auth->showLogin();    break;
    case 'login_post':    $auth->login();        break;
    case 'logout':        $auth->logout();       break;
    
    case 'plats_admin':   $platCtrl->adminIndex(); break;

    default:
        http_response_code(404);
        echo '404 - Page non trouvee';
}


