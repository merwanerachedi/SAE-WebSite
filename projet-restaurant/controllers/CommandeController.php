<?php
require_once 'models/Plat.php';
require_once 'models/Commande.php';

/* Gère les actions liées aux commandes côté utilisateur. */
class CommandeController {
    private Plat $platModel;
    private Commande $commandeModel;

    public function __construct(PDO $pdo) {
        $this->platModel = new Plat($pdo);
        $this->commandeModel = new Commande($pdo);
    }

    // Affiche le catalogue des plats disponibles
    public function showPlats(): void {
        requireAuth();
        $plats      = $this->platModel->getAvailable();
        $categories = array_values(array_unique(array_column($plats, 'categorie_nom')));
        $title      = 'Notre carte';
        require 'views/plats/catalogue.php';
    }

    // Recoit le panier JSON et enregistre la commande
    public function store(): void {
        requireAuth();
        header('Content-Type: application/json');

        $json   = file_get_contents('php://input');
        $panier = json_decode($json, true);

        if (empty($panier) || !is_array($panier)) {
            http_response_code(400);
            echo json_encode(['error' => 'Panier vide ou invalide']);
            return;
        }

        $total  = 0;
        $lignes = [];

        foreach ($panier as $item) {
            $plat = $this->platModel->findById((int)($item['id'] ?? 0));
            if (!$plat || !$plat['disponible']) continue;
            $quantite = max(1, (int)($item['quantite'] ?? 1));
            $total   += $plat['prix'] * $quantite;
            $lignes[] = ['plat' => $plat, 'quantite' => $quantite];
        }

        if (empty($lignes)) {
            http_response_code(400);
            echo json_encode(['error' => 'Aucun plat valide']);
            return;
        }

        $commandeId = $this->commandeModel->create($_SESSION['user_id'], round($total, 2));
        foreach ($lignes as $ligne) {
            $this->commandeModel->addLigne(
                $commandeId,
                $ligne['plat']['id'],
                $ligne['quantite'],
                $ligne['plat']['prix']
            );
        }

        echo json_encode(['success' => true, 'commande_id' => $commandeId]);
    }
}
