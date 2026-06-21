
USE restaurant_db;

-- Utilisateurs
-- admin123 et user123 hashes avec password_hash PHP
INSERT INTO users (nom, prenom, email, password, role) VALUES
('Admin',   'Marco',  'admin@chezmarco.fr', '$2y$10$g4kJmTL18Kejg/e2voItjeSUr1NX.cwZr6.FDJG4upcmU.EkpvPSu', 'admin'),
('Dupont',  'Alice',  'alice@mail.fr',      '$2y$10$3udKYrzJuZeQUIx1BzEZ1.MYFV4XDQMPnV3fK.9StY2qp3nGQscD2', 'user'),
('Bernard', 'Julien', 'julien@mail.fr',     '$2y$10$3udKYrzJuZeQUIx1BzEZ1.MYFV4XDQMPnV3fK.9StY2qp3nGQscD2', 'user');

-- Profils (relation 1-1)
INSERT INTO profils (user_id, telephone, adresse, date_naissance) VALUES
(1, '0612345678', '12 rue de la Paix, Paris', '1985-06-15'),
(2, '0698765432', '5 avenue Victor Hugo, Lyon', '1998-03-22'),
(3, NULL, NULL, NULL);

-- Categories
INSERT INTO categories (nom, description) VALUES
('Entrees',  'Nos entrees fraiches et savoureuses'),
('Plats',    'Plats principaux faits maison'),
('Desserts', 'Desserts italiens traditionnels'),
('Boissons', 'Boissons chaudes et froides');

-- Plats
INSERT INTO plats (nom, description, prix, disponible, categorie_id, image_url) VALUES
('Bruschetta',              'Pain grille, tomates, basilic',          6.50,  1, 1, 'public/uploads/plats/bruschetta.png'),
('Salade Cesar',            'Romaine, parmesan, croutons',            8.00,  1, 1, 'public/uploads/plats/Salade-Cesar.png'),
('Spaghetti Carbonara',     'Spaghetti, lardons, parmesan, oeuf',    13.50, 1, 2, 'public/uploads/plats/Spaghetti-Carbonara.png'),
('Penne Arrabiata',         'Penne, sauce tomate epicee',            11.00, 1, 2, 'public/uploads/plats/Penne-Arrabiata.png'),
('Pizza Margherita',        'Tomate, mozzarella, basilic',           12.00, 1, 2, 'public/uploads/plats/Pizza-Margherita.png'),
('Risotto aux champignons', 'Riz arborio, champignons, parmesan',   14.50, 1, 2, 'public/uploads/plats/Risotto-aux-champignons.png'),
('Tiramisu',                'Mascarpone, cafe, biscuits, cacao',      6.00, 1, 3, 'public/uploads/plats/Tiramisu.png'),
('Panna Cotta',             'Creme vanille, coulis fruits rouges',    5.50, 1, 3, 'public/uploads/plats/Panna-Cotta.png'),
('Cafe Espresso',           'Expresso simple',                        2.50, 1, 4, 'public/uploads/plats/Cafe-Espresso.png'),
('Eau minerale',            'Bouteille 50cl',                         2.00, 1, 4, 'public/uploads/plats/Eau-minerale.png');

-- Menus
INSERT INTO menus (nom, description, prix, actif) VALUES
('Menu du Midi',   'Entree + Plat + Boisson',          18.00, 1),
('Menu Complet',   'Entree + Plat + Dessert + Boisson', 24.00, 1),
('Menu Enfant',    'Plat + Dessert + Boisson',          12.00, 1);

-- Composition menus (relation N-N)
INSERT INTO menu_plats (menu_id, plat_id) VALUES
(1, 1), (1, 3), (1, 9),
(2, 2), (2, 5), (2, 7), (2, 9),
(3, 4), (3, 8), (3, 10);

-- Commandes
INSERT INTO commandes (user_id, statut, total) VALUES
(2, 'livree',     25.50),
(2, 'en_attente', 13.50),
(3, 'confirmee',  24.00);

-- Lignes de commandes (relation N-N)
INSERT INTO commande_plats (commande_id, plat_id, quantite, prix_unitaire) VALUES
(1, 3, 1, 13.50), (1, 7, 1, 6.00), (1, 9, 2, 2.50),
(2, 3, 1, 13.50),
(3, 2, 1, 8.00), (3, 5, 1, 12.00), (3, 7, 1, 6.00), (3, 9, 2, 2.50);
