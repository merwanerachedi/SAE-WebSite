<?php
class User {
    private PDO $pdo;

    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function findByEmail(string $email): array|false {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findById(int $id): array|false {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create(string $nom, string $prenom, string $email, string $password): int {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            'INSERT INTO users (nom, prenom, email, password, role) VALUES (?, ?, ?, ?, "user")'
        );
        $stmt->execute([$nom, $prenom, $email, $hash]);
        $userId = (int)$this->pdo->lastInsertId();
        // Cree le profil vide 1-1 immediatement
        $stmt2 = $this->pdo->prepare('INSERT INTO profils (user_id) VALUES (?)');
        $stmt2->execute([$userId]);
        return $userId;
    }

    public function getAll(): array {
        return $this->pdo->query(
            'SELECT id, nom, prenom, email, role, created_at FROM users ORDER BY created_at DESC'
        )->fetchAll();
    }

    public function updateRole(int $id, string $role): bool {
        $stmt = $this->pdo->prepare('UPDATE users SET role = ? WHERE id = ?');
        return $stmt->execute([$role, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
