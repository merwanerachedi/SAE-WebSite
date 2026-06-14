<?php
require_once 'models/Plat.php';
require_once 'models/Categorie.php';

class PlatController {
    private Plat $platModel;
    private Categorie $catModel;

    public function __construct(PDO $pdo) {
        $this->platModel = new Plat($pdo);
        $this->catModel  = new Categorie($pdo);
    }

    public function adminIndex(): void {
        requireRole('admin');
        $plats = $this->platModel->getAll();
        $title = 'Gestion des plats';
        require 'views/plats/admin_index.php';
    }
}
