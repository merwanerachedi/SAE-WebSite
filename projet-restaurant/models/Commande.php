<?php
class Commande {
    private PDO $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    // Cree une commande et retourne son id
    public function create(int $userId, float $total): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO commandes (user_id, total) VALUES (?, ?)'
        );
        $stmt->execute([$userId, $total]);
        return (int)$this->pdo->lastInsertId();
    }

    // Ajoute une ligne de commande
    public function addLigne(int $commandeId, int $platId, int $quantite, float $prix): void {
        $stmt = $this->pdo->prepare(
            'INSERT INTO commande_plats (commande_id, plat_id, quantite, prix_unitaire) VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$commandeId, $platId, $quantite, $prix]);
    }

    // Commandes d'un utilisateur
    public function getByUser(int $userId): array {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM commandes WHERE user_id = ? ORDER BY created_at DESC'
        );
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->pdo->prepare('SELECT * FROM commandes WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Lignes de detail d'une commande
    public function getLignes(int $commandeId): array {
        $stmt = $this->pdo->prepare(
            'SELECT cp.*, p.nom AS plat_nom
             FROM commande_plats cp
             JOIN plats p ON cp.plat_id = p.id
             WHERE cp.commande_id = ?'
        );
        $stmt->execute([$commandeId]);
        return $stmt->fetchAll();
    }

    // Toutes les commandes (admin)
    public function getAll(): array {
        return $this->pdo->query(
            'SELECT c.*, u.nom AS user_nom, u.prenom AS user_prenom
             FROM commandes c
             JOIN users u ON c.user_id = u.id
             ORDER BY c.created_at DESC'
        )->fetchAll();
    }

    // Met a jour le statut d'une commande
    public function updateStatut(int $id, string $statut): bool {
        $stmt = $this->pdo->prepare('UPDATE commandes SET statut = ? WHERE id = ?');
        return $stmt->execute([$statut, $id]);
    }
}
