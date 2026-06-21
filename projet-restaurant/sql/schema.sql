DROP DATABASE IF EXISTS restaurant_db;
CREATE DATABASE restaurant_db;
USE restaurant_db;

-- Utilisateurs
CREATE TABLE users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nom        VARCHAR(100)              NOT NULL,
    prenom     VARCHAR(100)              NOT NULL,
    email      VARCHAR(150)              NOT NULL UNIQUE,
    password   VARCHAR(255)              NOT NULL,
    role       ENUM('admin', 'user')     NOT NULL DEFAULT 'user',
    created_at DATETIME                  NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Profils étendus (relation 1-1 avec users)
-- ON DELETE CASCADE : si un user est supprimé, son profil l'est aussi
CREATE TABLE profils (
    id             INT AUTO_INCREMENT PRIMARY KEY,
    user_id        INT  NOT NULL UNIQUE,
    telephone      VARCHAR(20),
    adresse        VARCHAR(255),
    date_naissance DATE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_profils_user (user_id)
);

-- Catégories de plats
CREATE TABLE categories (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(100) NOT NULL,
    description TEXT
);

-- Plats (relation 1-N avec categories)
-- ON DELETE RESTRICT : on ne peut pas supprimer une catégorie qui a des plats
CREATE TABLE plats (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(150)  NOT NULL,
    description  TEXT,
    prix         DECIMAL(6,2)  NOT NULL,
    disponible   TINYINT(1)    NOT NULL DEFAULT 1,
    image_url    VARCHAR(255),
    categorie_id INT           NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE RESTRICT,
    INDEX idx_plats_categorie (categorie_id)
);

-- Menus composés
CREATE TABLE menus (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(150) NOT NULL,
    description TEXT,
    prix        DECIMAL(6,2) NOT NULL,
    actif       TINYINT(1)   NOT NULL DEFAULT 1
);

-- Relation N-N : menus ↔ plats
-- ON DELETE CASCADE des deux côtés :
--   supprimer un menu  → supprime ses lignes dans menu_plats
--   supprimer un plat  → supprime ses lignes dans menu_plats
CREATE TABLE menu_plats (
    menu_id INT NOT NULL,
    plat_id INT NOT NULL,
    PRIMARY KEY (menu_id, plat_id),
    FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
    FOREIGN KEY (plat_id) REFERENCES plats(id) ON DELETE CASCADE
);

-- Commandes
-- ON DELETE CASCADE : si un user est supprimé, ses commandes le sont aussi
CREATE TABLE commandes (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT                                               NOT NULL,
    statut     ENUM('en_attente','confirmée','livrée','annulée') NOT NULL DEFAULT 'en_attente',
    total      DECIMAL(8,2)                                      NOT NULL DEFAULT 0.00,
    created_at DATETIME                                          NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_commandes_user (user_id)
);

-- Relation N-N : commandes ↔ plats
-- ON DELETE CASCADE côté commande : si la commande est supprimée, ses lignes aussi
-- ON DELETE RESTRICT côté plat    : on ne peut pas supprimer un plat déjà commandé
--   (préserve l'historique et le prix_unitaire stocké)
CREATE TABLE commande_plats (
    commande_id   INT         NOT NULL,
    plat_id       INT         NOT NULL,
    quantite      INT         NOT NULL DEFAULT 1,
    prix_unitaire DECIMAL(6,2) NOT NULL,
    PRIMARY KEY (commande_id, plat_id),
    FOREIGN KEY (commande_id) REFERENCES commandes(id) ON DELETE CASCADE,
    FOREIGN KEY (plat_id)     REFERENCES plats(id)     ON DELETE RESTRICT,
    INDEX idx_cmd_plats_commande (commande_id)
);
