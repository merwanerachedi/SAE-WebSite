<?php
require_once 'models/Commande.php';
require_once 'models/User.php';

class AdminController {
    private PDO $pdo;
    private Commande $commandeModel;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->commandeModel = new Commande($pdo);
    }

    // Tableau de bord avec KPIs
    public function dashboard(): void {
        requireRole('admin');

        $nbCommandes  = (int)$this->pdo->query('SELECT COUNT(*) FROM commandes')->fetchColumn();
        $nbClients    = (int)$this->pdo->query("SELECT COUNT(*) FROM users WHERE role = 'user'")->fetchColumn();
        $nbPlats      = (int)$this->pdo->query('SELECT COUNT(*) FROM plats WHERE disponible = 1')->fetchColumn();
        $caLivre      = (float)$this->pdo->query("SELECT COALESCE(SUM(total), 0) FROM commandes WHERE statut = 'livree'")->fetchColumn();

        $dernieres = array_slice($this->commandeModel->getAll(), 0, 5);

        $title = 'Dashboard Admin';
        require 'views/admin/dashboard.php';
    }

    // Liste tous les utilisateurs
    public function users(): void {
        requireRole('admin');
        $users = (new User($this->pdo))->getAll();
        $title = 'Gestion des utilisateurs';
        require 'views/admin/users.php';
    }

    // Met à jour le rôle d'un utilisateur
    public function updateUserRole(): void {
        requireRole('admin');
        $role = $_POST['role'] ?? 'user';
        if (in_array($role, ['admin', 'user'])) {
            (new User($this->pdo))->updateRole((int)$_POST['id'], $role);
        }
        header('Location: /?action=admin_users');
        exit;
    }

    // Supprime un utilisateur (sauf soi-même)
    public function deleteUser(): void {
        requireRole('admin');
        $id = (int)($_GET['id'] ?? 0);
        // Sécurité : ne pas supprimer son propre compte
        if ($id !== $_SESSION['user_id']) {
            (new User($this->pdo))->delete($id);
        }
        header('Location: /?action=admin_users');
        exit;
    }
}
