# SAE-WebSite : Chez Marco (Projet Restaurant)

## 1. Description du projet
"Chez Marco" est une application web complète de gestion de restaurant. Elle permet aux clients de consulter les menus et plats disponibles, de s'inscrire, et de passer des commandes (panier). Elle dispose également d'un tableau de bord administrateur permettant de gérer les plats, les catégories, les commandes et les rôles utilisateurs.

---

## 2. Stack technique

| Composant       | Technologie(s)                         |
|-----------------|----------------------------------------|
| **Frontend**    | HTML5, CSS3, Bootstrap 5, Vanilla JS   |
| **Backend**     | PHP 8.x (Architecture MVC "maison")    |
| **Base de données** | MySQL 8 / MariaDB (via PDO)        |
| **Outils**      | Git, GitHub, XAMPP/WAMP (développement) |

---

## 3. Arborescence du projet

```text
projet-restaurant/
├── config/           # Configuration globale (base de données, helpers)
├── controllers/      # Contrôleurs pour la gestion des requêtes (MVC)
├── models/           # Modèles d'accès aux données (Classes PHP / PDO)
├── public/           # Fichiers publics (CSS, JS, images)
├── sql/              # Fichiers SQL (schema.sql pour la base de données)
├── views/            # Vues HTML/PHP (templates, layout, pages)
├── .gitignore        # Fichiers ignorés par Git
├── index.php         # Point d'entrée principal (Routeur simple)
└── README.md         # Documentation du projet
```

---

## 4. Instructions pour lancer le projet en local

1. **Cloner le dépôt** dans votre dossier de serveurs locaux (ex: `C:\xampp\htdocs\` pour XAMPP) :
   ```bash
   git clone https://github.com/votre-repo/SAE-WebSite.git
   cd SAE-WebSite/projet-restaurant
   ```

2. **Base de données** :
   - Ouvrez phpMyAdmin (ou votre client SQL préféré) via `http://localhost/phpmyadmin/`.
   - Créez une nouvelle base de données nommée `restaurant_db`.
   - Importez le fichier `sql/schema.sql` pour créer les tables et insérer les données d'essai.

3. **Configuration PDO** :
   - Dupliquez le fichier `config/db.example.php` en le nommant `config/db.php`.
   - Adaptez les identifiants si nécessaire (par défaut : `host=localhost`, `dbname=restaurant_db`, `user=root`, `pass=vide`).

4. **Lancer le site** :
   - Rendez-vous sur `http://localhost/SAE-WebSite/projet-restaurant/` dans votre navigateur.

---

## 5. Comptes de test

| Rôle          | Email                  | Mot de passe |
|---------------|------------------------|--------------|
| Administrateur| admin@chezmarco.fr     | admin123     |
| Client        | client@exemple.fr      | client123    |

*(Note: Ces utilisateurs de test sont supposés être insérés ou peuvent être créés via la page d'inscription.)*

---

## 6. Modélisation de la base de données

L'application repose sur un schéma relationnel de **7 tables principales** gérant les clients, les commandes, les plats et les menus.

### Tableau des relations

| Type de relation | Tables impliquées        | Description                                                                 |
|------------------|--------------------------|-----------------------------------------------------------------------------|
| **1-1**          | `users` ↔ `profils`      | Un utilisateur possède un et un seul profil détaillé (adresse, téléphone).  |
| **1-N**          | `categories` ↔ `plats`   | Une catégorie contient plusieurs plats. Un plat a une seule catégorie.      |
| **1-N**          | `users` ↔ `commandes`    | Un utilisateur peut passer plusieurs commandes.                             |
| **N-N**          | `menus` ↔ `plats`        | Un menu est composé de plusieurs plats, un plat peut être dans plusieurs menus (table pivot : `menu_plats`). |
| **N-N**          | `commandes` ↔ `plats`    | Une commande contient plusieurs plats et inversement (table pivot : `commande_plats`). |

---

## 7. Fonctionnalités

### Espace Utilisateur (Client)
- **Inscription & Connexion** : Création de compte (avec profil lié), hachage sécurisé des mots de passe.
- **Consultation** : Visualisation des plats, menus et catégories.
- **Panier dynamique** : Ajout de plats au panier en Javascript, sans rechargement.
- **Commandes** : Passage en caisse (création de commande), suivi de l'historique de ses commandes personnelles.
- **Profil** : Mise à jour de ses informations personnelles (adresse, téléphone).

### Espace Administrateur
- **Dashboard** : Vue d'ensemble avec les KPI principaux (Chiffre d'affaires, nombre de commandes, utilisateurs inscrits).
- **Gestion du catalogue** : Opérations CRUD (Créer, Lire, Mettre à jour, Supprimer) sur les plats, catégories et menus.
- **Gestion des utilisateurs** : Visualisation des inscrits, modification des rôles (admin/user) et suppression des comptes.
- **Suivi des commandes** : Affichage de toutes les commandes et mise à jour de leur statut (En préparation, livrée, etc.).

---

## 8. Sécurité

Plusieurs mécanismes de protection et de bonnes pratiques ont été mis en œuvre :
- **Prévention des injections SQL** : 100% des requêtes (SELECT, INSERT, UPDATE, DELETE) utilisent PDO et des requêtes préparées (`$pdo->prepare()`).
- **Prévention des failles XSS** : Toutes les données issues de la base de données ou d'un formulaire utilisateur sont échappées avec `htmlspecialchars()` avant affichage.
- **Mots de passe** : Chiffrement irréversible via la fonction native PHP `password_hash()` (algorithme BCRYPT par défaut).
- **Contrôle d'accès** : Utilisation stricte des `$_SESSION` et du mécanisme `requireRole('admin')` pour protéger les routes et fichiers sensibles.

---

## 9. Bonus NoSQL : Transition vers MongoDB

### Scénario de montée en charge
Imaginons que le restaurant se transforme en chaîne nationale avec des centaines de commandes par minute aux heures de pointe. Le modèle relationnel (MySQL) actuel pourrait montrer ses limites, notamment lors d'écritures concurrentes massives sur les tables `commandes` et `commande_plats` via de lourdes jointures.

**Requête problématique en SQL** : 
Pour afficher l'historique complet, il faut effectuer des jointures coûteuses (`JOIN`) entre les tables `users`, `commandes`, `commande_plats` et `plats`. À grande échelle, ces jointures ralentissent considérablement la base de données.

### Alternative MongoDB
En passant sous MongoDB, l'approche *Documentaire* permet d'intégrer directement les éléments de la commande dans le document "Commande" lui-même, supprimant le besoin de jointures coûteuses.

**Exemple de document JSON (MongoDB)** :
```json
{
  "_id": ObjectId("64abcd123456..."),
  "user_id": 105,
  "date_commande": "2026-06-20T12:30:00Z",
  "statut": "en_preparation",
  "total": 45.50,
  "adresse_livraison": "12 Rue de la Paix, 75000 Paris",
  "items": [
    {
      "plat_id": 12,
      "nom_plat": "Pizza Margherita",
      "quantite": 2,
      "prix_unitaire": 12.00
    },
    {
      "plat_id": 8,
      "nom_plat": "Tiramisu Maison",
      "quantite": 3,
      "prix_unitaire": 6.50
    }
  ]
}
```
Ce modèle est hautement scalé pour la lecture puisqu'une seule requête récupère la commande et tout son contenu.

---

## 10. Auteurs
- **Étudiants** : Merwane Soltane Zakaria RACHEDI / Salim Nekhla
- **Université** : Université Sorbonne Paris Nord - Institut Galilée
- **Année** : 2026
