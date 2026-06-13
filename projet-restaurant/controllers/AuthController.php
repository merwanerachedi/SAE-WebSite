<?php
require_once 'models/User.php';

class AuthController {
    private User $userModel;

    public function __construct(PDO $pdo) {
        $this->userModel = new User($pdo);
    }

    // Affiche le formulaire d'inscription
    public function showRegister(): void {
        $title = 'Inscription';
        require 'views/auth/register.php';
    }

    // Traite la soumission du formulaire
    public function register(): void {
        $nom      = trim($_POST['nom'] ?? '');
        $prenom   = trim($_POST['prenom'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm'] ?? '';
        $error    = null;

        if (!$nom || !$prenom || !$email || !$password)
            $error = 'Tous les champs sont obligatoires.';
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $error = 'Email invalide.';
        elseif (strlen($password) < 6)
            $error = 'Le mot de passe doit contenir au moins 6 caracteres.';
        elseif ($password !== $confirm)
            $error = 'Les mots de passe ne correspondent pas.';
        elseif ($this->userModel->findByEmail($email))
            $error = 'Cet email est deja utilise.';

        if ($error) {
            $title = 'Inscription';
            require 'views/auth/register.php';
            return;
        }

        $this->userModel->create($nom, $prenom, $email, $password);
        setFlash('success', 'Compte cree avec succes. Connectez-vous.');
        header('Location: ' . BASE_URL . '?action=login');
        exit;
    }
}
