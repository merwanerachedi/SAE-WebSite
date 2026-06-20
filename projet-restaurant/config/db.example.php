<?php
define('BASE_URL', '/projet-restaurant/');

// Copier ce fichier en db.php et renseigner vos identifiants
$host   = 'localhost';
$dbname = 'restaurant_db';
$user   = 'root';
$pass   = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Connexion impossible : ' . $e->getMessage()]));
}
