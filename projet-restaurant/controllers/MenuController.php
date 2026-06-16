<?php
require_once 'models/Menu.php';
require_once 'models/Plat.php';

class MenuController {
    private Menu $menuModel;
    private Plat $platModel;

    public function __construct(PDO $pdo) {
        $this->menuModel = new Menu($pdo);
        $this->platModel = new Plat($pdo);
    }

    // Affiche la liste des menus
    public function index() {
        requireRole('admin');
        $menus = $this->menuModel->getAll();
        $title = 'Gestion des Menus';
        require 'views/layout/header.php';
        require 'views/menus/index.php';
        require 'views/layout/footer.php';
    }

    // Affiche le formulaire de creation avec liste des plats
    public function create() {
        requireRole('admin');
        $plats = $this->platModel->getAll();
        $title = 'Ajouter un menu';
        require 'views/layout/header.php';
        require 'views/menus/create.php';
        require 'views/layout/footer.php';
    }

    // Enregistre un nouveau menu et synchronise les plats
    public function store() {
        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $prix = (float)($_POST['prix'] ?? 0);
            $actif = isset($_POST['actif']) ? 1 : 0;

            if ($nom && $prix > 0) {
                $menuId = $this->menuModel->create($nom, $description, $prix, $actif);
                $this->menuModel->syncPlats($menuId, $_POST['plat_ids'] ?? []);
                setFlash('success', 'Menu ajoute avec succes.');
                header('Location: ' . BASE_URL . '?action=menus');
                exit;
            } else {
                $error = 'Le nom et un prix valide sont requis.';
                $plats = $this->platModel->getAll();
                $title = 'Ajouter un menu';
                require 'views/layout/header.php';
                require 'views/menus/create.php';
                require 'views/layout/footer.php';
            }
        }
    }

    // Affiche le formulaire de modification avec plats pre-coches
    public function edit() {
        requireRole('admin');
        $id = (int)($_GET['id'] ?? 0);
        $menu = $this->menuModel->findById($id);

        if (!$menu) {
            setFlash('danger', 'Menu introuvable.');
            header('Location: ' . BASE_URL . '?action=menus');
            exit;
        }

        $plats     = $this->platModel->getAll();
        $platsMenu = array_column($this->menuModel->getPlats($id), 'id');
        $title     = 'Modifier le menu';
        require 'views/layout/header.php';
        require 'views/menus/edit.php';
        require 'views/layout/footer.php';
    }

    // Met a jour un menu et synchronise les plats
    public function update() {
        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            $prix = (float)($_POST['prix'] ?? 0);
            $actif = isset($_POST['actif']) ? 1 : 0;

            if ($id && $nom && $prix > 0) {
                $this->menuModel->update($id, $nom, $description, $prix, $actif);
                $this->menuModel->syncPlats($id, $_POST['plat_ids'] ?? []);
                setFlash('success', 'Menu modifie avec succes.');
                header('Location: ' . BASE_URL . '?action=menus');
                exit;
            } else {
                $error = 'Donnees invalides.';
                $menu = $this->menuModel->findById($id);
                $plats     = $this->platModel->getAll();
                $platsMenu = array_column($this->menuModel->getPlats($id), 'id');
                $title = 'Modifier le menu';
                require 'views/layout/header.php';
                require 'views/menus/edit.php';
                require 'views/layout/footer.php';
            }
        }
    }

    // Supprime un menu
    public function delete() {
        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id) {
                $this->menuModel->delete($id);
                setFlash('success', 'Menu supprime avec succes.');
            }
            header('Location: ' . BASE_URL . '?action=menus');
            exit;
        }
    }
}
