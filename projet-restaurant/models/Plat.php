<?php
class Plat {
    private PDO $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function getAll(): array {
        return $this->pdo->query(
            'SELECT p.*, c.nom AS categorie_nom
             FROM plats p
             JOIN categories c ON p.categorie_id = c.id
             ORDER BY c.nom, p.nom'
        )->fetchAll();
    }

    public function getAvailable(): array {
        $stmt = $this->pdo->prepare(
            'SELECT p.*, c.nom AS categorie_nom
             FROM plats p
             JOIN categories c ON p.categorie_id = c.id
             WHERE p.disponible = 1
             ORDER BY c.nom, p.nom'
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->pdo->prepare('SELECT * FROM plats WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(string $nom, string $description, float $prix, int $disponible, int $categorieId): bool {
        $stmt = $this->pdo->prepare(
            'INSERT INTO plats (nom, description, prix, disponible, categorie_id) VALUES (?, ?, ?, ?, ?)'
        );
        return $stmt->execute([$nom, $description, $prix, $disponible, $categorieId]);
    }

    public function update(int $id, string $nom, string $description, float $prix, int $disponible, int $categorieId): bool {
        $stmt = $this->pdo->prepare(
            'UPDATE plats SET nom=?, description=?, prix=?, disponible=?, categorie_id=? WHERE id=?'
        );
        return $stmt->execute([$nom, $description, $prix, $disponible, $categorieId, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM plats WHERE id=?');
        return $stmt->execute([$id]);
    }
}
