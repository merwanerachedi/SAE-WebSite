<?php

class Profil {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getByUser(int $userId): ?array {
        $stmt = $this->pdo->prepare("
            SELECT u.*, p.telephone, p.adresse, p.date_naissance 
            FROM users u
            LEFT JOIN profils p ON u.id = p.user_id
            WHERE u.id = :id
        ");
        $stmt->execute(['id' => $userId]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function update(int $userId, string $telephone, string $adresse, ?string $dateNaissance): void {
        $stmt = $this->pdo->prepare("
            INSERT INTO profils (user_id, telephone, adresse, date_naissance)
            VALUES (:id, :tel, :addr, :dn)
            ON DUPLICATE KEY UPDATE 
                telephone = VALUES(telephone), 
                adresse = VALUES(adresse), 
                date_naissance = VALUES(date_naissance)
        ");
        $stmt->execute([
            'id'   => $userId,
            'tel'  => $telephone,
            'addr' => $adresse,
            'dn'   => $dateNaissance ?: null
        ]);
    }
}
