<?php
session_start();
require_once 'config/db.php';
require_once 'config/helpers.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        echo 'Bienvenue chez Marco — routeur OK';
        break;
    default:
        http_response_code(404);
        echo '404 - Page non trouvée';
}
