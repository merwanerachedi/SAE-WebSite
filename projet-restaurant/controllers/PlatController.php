<?php
require_once 'models/Plat.php';
require_once 'models/Categorie.php';

class PlatController {
    private Plat $platModel;
    private Categorie $catModel;

    // Extensions et types MIME autorises
    private const EXTENSIONS_OK = ['jpg', 'jpeg', 'png', 'webp'];
    private const MIMES_OK      = ['image/jpeg', 'image/png', 'image/webp'];
    private const MAX_SIZE      = 10 * 1024 * 1024; // 5 Mo
    private const UPLOAD_DIR    = 'public/uploads/plats/';

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

        $imageUrl = $this->handleUpload();
        // Si l'upload a echoue (false), on redirige avec l'erreur
        if ($imageUrl === false) {
            header('Location: ' . BASE_URL . '?action=plat_create'); exit;
        }

        $this->platModel->create(
            trim($_POST['nom'] ?? ''),
            trim($_POST['description'] ?? ''),
            (float)($_POST['prix'] ?? 0),
            isset($_POST['disponible']) ? 1 : 0,
            (int)($_POST['categorie_id'] ?? 0),
            $imageUrl
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

        $imageUrl = $this->handleUpload();
        // Si l'upload a echoue (false), on redirige avec l'erreur
        if ($imageUrl === false) {
            header('Location: ' . BASE_URL . '?action=plat_edit&id=' . (int)$_POST['id']); exit;
        }

        $this->platModel->update(
            (int)$_POST['id'],
            trim($_POST['nom'] ?? ''),
            trim($_POST['description'] ?? ''),
            (float)($_POST['prix'] ?? 0),
            isset($_POST['disponible']) ? 1 : 0,
            (int)($_POST['categorie_id'] ?? 0),
            $imageUrl
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

    // Traite l'upload : null = pas de fichier, false = erreur, string = chemin
    private function handleUpload(): string|null|false {
        if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
            return null; // Pas de fichier envoye
        }

        $file = $_FILES['image'];

        // Verifier qu'il n'y a pas d'erreur d'upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            setFlash('error', 'Erreur lors du telechargement de l\'image.');
            return false;
        }

        // Verifier la taille (max 5 Mo)
        if ($file['size'] > self::MAX_SIZE) {
            setFlash('error', 'L\'image ne doit pas depasser 5 Mo.');
            return false;
        }

        // Verifier l'extension
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, self::EXTENSIONS_OK)) {
            setFlash('error', 'Format d\'image non autorise (JPG, PNG ou WebP uniquement).');
            return false;
        }

        // Verifier le vrai type MIME via finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']);
        if (!in_array($mime, self::MIMES_OK)) {
            setFlash('error', 'Le fichier n\'est pas une image valide.');
            return false;
        }

        // Verifier que c'est bien une image lisible
        if (@getimagesize($file['tmp_name']) === false) {
            setFlash('error', 'Le fichier n\'est pas une image valide.');
            return false;
        }

        // Generer un nom unique et deplacer le fichier
        $filename = uniqid('plat_') . '.' . $ext;
        $destPath = self::UPLOAD_DIR . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destPath)) {
            setFlash('error', 'Impossible d\'enregistrer l\'image.');
            return false;
        }

        // Retourner le chemin public (stocke en BDD)
        return 'public/uploads/plats/' . $filename;
    }
}
