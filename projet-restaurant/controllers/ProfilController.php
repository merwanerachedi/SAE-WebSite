<?php
require_once 'models/Profil.php';

/* Gère l'affichage et la mise à jour du profil utilisateur (relation 1-1). */
class ProfilController {
    private Profil $profilModel;

    public function __construct(PDO $pdo) {
        $this->profilModel = new Profil($pdo);
    }

    /* Affiche la vue du profil avec les infos utilisateurs et complémentaires. */
    public function show(): void {
        requireAuth();
        $profil = $this->profilModel->getByUser($_SESSION['user_id']);
        if (!$profil) {
            http_response_code(404);
            die("Utilisateur introuvable.");
        }
        $title = 'Mon Profil';
        require 'views/profil/index.php';
    }

    /* Met à jour les informations complémentaires dans la table profils. */
    public function update(): void {
        requireAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $telephone = $_POST['telephone'] ?? '';
            $adresse   = $_POST['adresse'] ?? '';
            $dateNaiss = !empty($_POST['date_naissance']) ? $_POST['date_naissance'] : null;

            $this->profilModel->update($_SESSION['user_id'], $telephone, $adresse, $dateNaiss);

            header('Location: ' . BASE_URL . '?action=profil&success=1');
            exit;
        }
    }
}
