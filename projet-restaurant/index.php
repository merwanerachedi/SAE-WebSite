<?php
session_start();
require_once 'config/db.php';
require_once 'config/helpers.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CategorieController.php';
require_once 'controllers/PlatController.php';
require_once 'controllers/MenuController.php';
require_once 'controllers/CommandeController.php';


$auth = new AuthController($pdo);
$cat = new CategorieController($pdo);
$platCtrl = new PlatController($pdo);
$menuCtrl  = new MenuController($pdo);
$cmdCtrl   = new CommandeController($pdo);
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
    
    case 'plats_admin':   $platCtrl->adminIndex(); break;
    case 'plat_create':   $platCtrl->create();     break;
    case 'plat_store':    $platCtrl->store();      break;
    case 'plat_edit':     $platCtrl->edit();       break;
    case 'plat_update':   $platCtrl->update();     break;
    case 'plat_delete':   $platCtrl->delete();     break;

    case 'menus':         $menuCtrl->index();      break;
    case 'menu_create':   $menuCtrl->create();     break;
    case 'menu_store':    $menuCtrl->store();      break;
    case 'menu_edit':     $menuCtrl->edit();       break;
    case 'menu_update':   $menuCtrl->update();     break;
    case 'menu_delete':   $menuCtrl->delete();     break;

    case 'plats':           $cmdCtrl->showPlats();   break;
    case 'commande_store':  $cmdCtrl->store();       break;
    case 'mes_commandes':   $cmdCtrl->historique();  break;
    case 'commande_show':   $cmdCtrl->show();        break;

    default:
        http_response_code(404);
        echo '404 - Page non trouvee';
}


