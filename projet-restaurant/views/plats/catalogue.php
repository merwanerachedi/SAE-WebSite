<?php require 'views/layout/header.php'; ?>
<div class="row">
    <!-- Catalogue des plats -->
    <div class="col-md-8">
        <h2 class="mb-3">🍽️ Notre carte</h2>

        <!-- Boutons de filtre — fonctionnels à l'étape 15 -->
        <div class="mb-4 d-flex flex-wrap gap-2" id="filter-buttons">
            <button class="btn btn-dark btn-sm active" data-filter="all">Tous</button>
            <?php foreach ($categories as $cat): ?>
                <button class="btn btn-outline-dark btn-sm" data-filter="<?= htmlspecialchars($cat) ?>">
                    <?= htmlspecialchars($cat) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Grille des plats -->
        <div class="row row-cols-1 row-cols-md-2 g-3" id="plats-grid">
            <?php foreach ($plats as $plat): ?>
            <div class="col plat-card" data-cat="<?= htmlspecialchars($plat['categorie_nom']) ?>">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h5 class="card-title mb-0"><?= htmlspecialchars($plat['nom']) ?></h5>
                            <span class="badge bg-secondary"><?= htmlspecialchars($plat['categorie_nom']) ?></span>
                        </div>
                        <p class="card-text text-muted small mt-2">
                            <?= htmlspecialchars($plat['description'] ?? '') ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <strong class="text-dark"><?= number_format($plat['prix'], 2) ?> €</strong>
                            <!-- Bouton panier — fonctionnel à l'étape 14 -->
                            <button class="btn btn-dark btn-sm btn-add-cart"
                                    data-id="<?= $plat['id'] ?>"
                                    data-nom="<?= htmlspecialchars($plat['nom']) ?>"
                                    data-prix="<?= $plat['prix'] ?>">
                                + Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Zone panier — fonctionnelle à l'étape 14 -->
    <div class="col-md-4">
        <div class="card sticky-top shadow-sm" style="top: 80px">
            <div class="card-body">
                <h5>🛒 Mon panier <span class="badge bg-dark" id="cart-badge">0</span></h5>
                <div id="cart-items">
                    <p class="text-muted small">Votre panier est vide.</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <span>Total</span>
                    <span id="cart-total">0.00 €</span>
                </div>
                <button class="btn btn-dark w-100 mt-3" id="btn-submit-cart" disabled>
                    Commander
                </button>
            </div>
        </div>
    </div>
</div>
<?php
$extraJs = '/public/js/cart.js';
require 'views/layout/footer.php';
?>
