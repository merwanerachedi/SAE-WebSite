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

    public function create(string $nom, string $description, float $prix, int $actif): int {
        $stmt = $this->pdo->prepare('INSERT INTO menus (nom, description, prix, actif) VALUES (?, ?, ?, ?)');
        $stmt->execute([$nom, $description, $prix, $actif]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, string $nom, string $description, float $prix, int $actif): bool {
        $stmt = $this->pdo->prepare('UPDATE menus SET nom=?, description=?, prix=?, actif=? WHERE id=?');
        return $stmt->execute([$nom, $description, $prix, $actif, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM menus WHERE id=?');
        return $stmt->execute([$id]);
    }

    // Recupere les plats associes a un menu
    public function getPlats(int $menuId): array {
        $stmt = $this->pdo->prepare(
            'SELECT p.*, c.nom AS categorie_nom
             FROM plats p
             JOIN menu_plats mp ON p.id = mp.plat_id
             JOIN categories c  ON p.categorie_id = c.id
             WHERE mp.menu_id = ?
             ORDER BY c.nom, p.nom'
        );
        $stmt->execute([$menuId]);
        return $stmt->fetchAll();
    }

    // Synchronise les plats d'un menu (supprime + recree)
    public function syncPlats(int $menuId, array $platIds): void {
        $del = $this->pdo->prepare('DELETE FROM menu_plats WHERE menu_id = ?');
        $del->execute([$menuId]);

        $ins = $this->pdo->prepare('INSERT INTO menu_plats (menu_id, plat_id) VALUES (?, ?)');
        foreach ($platIds as $platId) {
            $ins->execute([$menuId, (int)$platId]);
        }
    }
}
