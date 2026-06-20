<?php
require_once 'models/Commande.php';

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
}
