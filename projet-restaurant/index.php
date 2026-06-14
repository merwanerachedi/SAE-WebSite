<?php
session_start();
require_once 'config/db.php';
require_once 'config/helpers.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CategorieController.php';

$auth = new AuthController($pdo);
$cat = new CategorieController($pdo);
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
    
    case 'categories':        $cat->index();   break;
    case 'categorie_create':  $cat->create();  break;
    case 'categorie_store':   $cat->store();   break;
    case 'categorie_edit':    $cat->edit();    break;
    case 'categorie_update':  $cat->update();  break;
    case 'categorie_delete':  $cat->delete();  break;

    default:
        http_response_code(404);
        echo '404 - Page non trouvee';
}


