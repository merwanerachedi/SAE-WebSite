<?php
class Menu {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        return $this->pdo->query('SELECT * FROM menus ORDER BY nom')->fetchAll();
    }

    public function findById(int $id): array|false {
        $stmt = $this->pdo->prepare('SELECT * FROM menus WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(string $nom, string $description, float $prix, int $actif): bool {
        $stmt = $this->pdo->prepare('INSERT INTO menus (nom, description, prix, actif) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$nom, $description, $prix, $actif]);
    }

    public function update(int $id, string $nom, string $description, float $prix, int $actif): bool {
        $stmt = $this->pdo->prepare('UPDATE menus SET nom=?, description=?, prix=?, actif=? WHERE id=?');
        return $stmt->execute([$nom, $description, $prix, $actif, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM menus WHERE id=?');
        return $stmt->execute([$id]);
    }
}
