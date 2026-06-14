<?php
require_once 'models/Categorie.php';

class CategorieController {
    private Categorie $model;
    public function __construct(PDO $pdo) { $this->model = new Categorie($pdo); }

    public function index(): void {
        requireRole('admin');
        $categories = $this->model->getAll();
        $title = 'Catégories';
        require 'views/categories/index.php';
    }

    public function create(): void {
        requireRole('admin');
        $title = 'Nouvelle catégorie';
        require 'views/categories/create.php';
    }

    public function store(): void {
        requireRole('admin');
        $nom  = trim($_POST['nom'] ?? '');
        $desc = trim($_POST['description'] ?? '');
        if ($nom) $this->model->create($nom, $desc);
        header('Location: /?action=categories'); exit;
    }

    public function edit(): void {
        requireRole('admin');
        $categorie = $this->model->findById((int)($_GET['id'] ?? 0));
        $title = 'Modifier la catégorie';
        require 'views/categories/edit.php';
    }

    public function update(): void {
        requireRole('admin');
        $this->model->update((int)$_POST['id'], trim($_POST['nom'] ?? ''), trim($_POST['description'] ?? ''));
        header('Location: /?action=categories'); exit;
    }

    public function delete(): void {
        requireRole('admin');
        $this->model->delete((int)($_GET['id'] ?? 0));
        header('Location: /?action=categories'); exit;
    }
}
