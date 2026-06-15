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

    public function create(): void {
        requireRole('admin');
        $categories = $this->catModel->getAll();
        $title = 'Nouveau plat';
        require 'views/plats/create.php';
    }

    public function store(): void {
        requireRole('admin');
        $this->platModel->create(
            trim($_POST['nom'] ?? ''),
            trim($_POST['description'] ?? ''),
            (float)($_POST['prix'] ?? 0),
            isset($_POST['disponible']) ? 1 : 0,
            (int)($_POST['categorie_id'] ?? 0)
        );
        setFlash('success', 'Plat cree avec succes.');
        header('Location: ' . BASE_URL . '?action=plats_admin'); exit;
    }

    public function edit(): void {
        requireRole('admin');
        $plat = $this->platModel->findById((int)($_GET['id'] ?? 0));
        $categories = $this->catModel->getAll();
        $title = 'Modifier le plat';
        require 'views/plats/edit.php';
    }

    public function update(): void {
        requireRole('admin');
        $this->platModel->update(
            (int)$_POST['id'],
            trim($_POST['nom'] ?? ''),
            trim($_POST['description'] ?? ''),
            (float)($_POST['prix'] ?? 0),
            isset($_POST['disponible']) ? 1 : 0,
            (int)($_POST['categorie_id'] ?? 0)
        );
        setFlash('success', 'Plat modifie avec succes.');
        header('Location: ' . BASE_URL . '?action=plats_admin'); exit;
    }

    public function delete(): void {
        requireRole('admin');
        $this->platModel->delete((int)($_GET['id'] ?? 0));
        setFlash('success', 'Plat supprime.');
        header('Location: ' . BASE_URL . '?action=plats_admin');
        exit;
    }
}
