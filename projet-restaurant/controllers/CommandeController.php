<?php
require_once 'models/Plat.php';

/* Gère les actions liées aux commandes côté utilisateur. */
class CommandeController {
    private Plat $platModel;

    public function __construct(PDO $pdo) {
        $this->platModel = new Plat($pdo);
    }

    /* Affiche le catalogue des plats disponibles pour l'utilisateur connecté. */
    public function showPlats(): void {
        requireAuth();
        $plats      = $this->platModel->getAvailable();
        $categories = array_values(array_unique(array_column($plats, 'categorie_nom')));
        $title      = 'Notre carte';
        require 'views/plats/catalogue.php';
    }
}
