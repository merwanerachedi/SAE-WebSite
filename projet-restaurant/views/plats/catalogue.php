<?php require 'views/layout/header.php'; ?>
<div class="row">
    <!-- Catalogue des plats -->
    <div class="col-md-8">
        <h2 class="mb-3">🍽️ Notre carte</h2>

        <!-- Boutons de filtre — fonctionnels à l'étape 15 -->
        <div class="mb-5 d-flex flex-wrap justify-content-center gap-3" id="filter-buttons">
            <button class="btn btn-dark btn-sm rounded-pill px-4 active" data-filter="all">Tous</button>
            <?php foreach ($categories as $cat): ?>
                <button class="btn btn-outline-dark btn-sm rounded-pill px-4" data-filter="<?= htmlspecialchars($cat) ?>">
                    <?= htmlspecialchars($cat) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Grille des plats -->
        <div class="row row-cols-1 row-cols-md-2 g-3" id="plats-grid">
            <?php foreach ($plats as $plat): ?>
            <div class="col plat-card" data-cat="<?= htmlspecialchars($plat['categorie_nom']) ?>">
                <div class="card h-100 shadow-sm">
                    <div class="card-body p-4 d-flex flex-column">
                        <!-- Categorie discrete et elegante -->
                        <div class="text-uppercase text-dore mb-2" style="font-size: 0.75rem; font-weight: 600; letter-spacing: 1px;">
                            <?= htmlspecialchars($plat['categorie_nom']) ?>
                        </div>
                        
                        <!-- Nom du plat -->
                        <h4 class="card-title mb-3" style="font-size: 1.3rem;"><?= htmlspecialchars($plat['nom']) ?></h4>
                        
                        <!-- Description flexible -->
                        <p class="card-text text-muted mb-4 flex-grow-1" style="font-size: 0.95rem; line-height: 1.5;">
                            <?= htmlspecialchars($plat['description'] ?? '') ?>
                        </p>
                        
                        <!-- Zone Prix et Bouton (isolee par une bordure subtile) -->
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top" style="border-color: rgba(0,0,0,0.05) !important;">
                            <span class="prix fs-4 mb-0"><?= number_format($plat['prix'], 2) ?> €</span>
                            
                            <button class="btn btn-dark rounded-pill px-4 py-2 btn-add-cart d-flex align-items-center gap-2 transition"
                                    data-id="<?= $plat['id'] ?>"
                                    data-nom="<?= htmlspecialchars($plat['nom']) ?>"
                                    data-prix="<?= $plat['prix'] ?>">
                                🛒 <span>Ajouter</span>
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
