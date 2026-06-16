<?php
require_once 'models/Menu.php';

class MenuController {
    private Menu $menuModel;

    public function __construct(PDO $pdo) {
        $this->menuModel = new Menu($pdo);
    }

    // Affiche la liste des menus
    public function index() {
        $menus = $this->menuModel->getAll();
        $title = 'Gestion des Menus';
        require 'views/layout/header.php';
        require 'views/menus/index.php';
        require 'views/layout/footer.php';
    }

    // Affiche le formulaire de création
    public function create() {
        $title = 'Ajouter un menu';
        require 'views/layout/header.php';
        require 'views/menus/create.php';
        require 'views/layout/footer.php';
    }

    // Enregistre un nouveau menu
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $prix = (float)($_POST['prix'] ?? 0);
            $actif = isset($_POST['actif']) ? 1 : 0;

            if ($nom && $prix > 0) {
                $this->menuModel->create($nom, $description, $prix, $actif);
                setFlash('success', 'Menu ajouté avec succès.');
                header('Location: ' . BASE_URL . '?action=menus');
                exit;
            } else {
                $error = 'Le nom et un prix valide sont requis.';
                $title = 'Ajouter un menu';
                require 'views/layout/header.php';
                require 'views/menus/create.php';
                require 'views/layout/footer.php';
            }
        }
    }

    // Affiche le formulaire de modification
    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $menu = $this->menuModel->findById($id);

        if (!$menu) {
            setFlash('danger', 'Menu introuvable.');
            header('Location: ' . BASE_URL . '?action=menus');
            exit;
        }

        $title = 'Modifier le menu';
        require 'views/layout/header.php';
        require 'views/menus/edit.php';
        require 'views/layout/footer.php';
    }

    // Met à jour un menu existant
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $prix = (float)($_POST['prix'] ?? 0);
            $actif = isset($_POST['actif']) ? 1 : 0;

            if ($id && $nom && $prix > 0) {
                $this->menuModel->update($id, $nom, $description, $prix, $actif);
                setFlash('success', 'Menu modifié avec succès.');
                header('Location: ' . BASE_URL . '?action=menus');
                exit;
            } else {
                $error = 'Données invalides.';
                $menu = $this->menuModel->findById($id);
                $title = 'Modifier le menu';
                require 'views/layout/header.php';
                require 'views/menus/edit.php';
                require 'views/layout/footer.php';
            }
        }
    }

    // Supprime un menu
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                $this->menuModel->delete($id);
                setFlash('success', 'Menu supprimé avec succès.');
            }
            header('Location: ' . BASE_URL . '?action=menus');
            exit;
        }
    }
}
