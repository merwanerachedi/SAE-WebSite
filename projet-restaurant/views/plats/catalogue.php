<?php require 'views/layout/header.php'; ?>
<div class="page-header-marco">
    <h1>Notre Carte</h1>
    <p class="text-muted">Découvrez nos spécialités préparées à la commande</p>
    <hr class="divider-dore">
</div>

<div class="row">
    <!-- Catalogue des plats -->
    <div class="col-lg-8">
        <!-- Boutons de filtre -->
        <div class="mb-5 d-flex flex-wrap justify-content-center gap-3" id="filter-buttons">
            <button class="filter-pill active" data-filter="all"><i class="bi bi-grid me-2"></i>Tous</button>
            <?php foreach ($categories as $cat): ?>
                <button class="filter-pill" data-filter="<?= htmlspecialchars($cat) ?>">
                    <?= htmlspecialchars($cat) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Grille des plats -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5" id="plats-grid">
            <?php foreach ($plats as $plat): ?>
            <div class="col plat-card" data-cat="<?= htmlspecialchars($plat['categorie_nom']) ?>">
                <div class="card-marco h-100 position-relative">
                    <div class="plat-badge-cat"><?= htmlspecialchars($plat['categorie_nom']) ?></div>
                    <?php
                    $imgSrc = !empty($plat['image_url'])
                        ? BASE_URL . $plat['image_url']
                        : BASE_URL . 'public/assets/img/default-plat.png';
                    ?>
                    <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= htmlspecialchars($plat['nom']) ?>" style="height: 220px; object-fit: cover;">
                    <div class="card-body p-4 d-flex flex-column">
                        <h4 class="card-title mb-2 fs-4"><?= htmlspecialchars($plat['nom']) ?></h4>
                        
                        <p class="card-text text-muted mb-4 flex-grow-1" style="font-size: 0.95rem;">
                            <?= htmlspecialchars($plat['description'] ?? '') ?>
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top" style="border-color: var(--color-gris-clair) !important;">
                            <span class="prix mb-0"><?= number_format($plat['prix'], 2) ?> €</span>
                            
                            <button class="btn btn-marco rounded-pill px-4 py-2 btn-add-cart d-flex align-items-center gap-2"
                                    data-id="<?= $plat['id'] ?>"
                                    data-nom="<?= htmlspecialchars($plat['nom']) ?>"
                                    data-prix="<?= $plat['prix'] ?>">
                                <i class="bi bi-cart-plus"></i> <span>Ajouter</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Zone panier -->
    <div class="col-lg-4">
        <div class="card-marco cart-sticky shadow-sm">
        <div class="cart-header">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-bag text-dore"></i>
                    Mon panier
                </h4>
                <span id="cart-badge">0</span>
            </div>
            <div class="card-body p-4 p-xl-5">
                <div id="cart-items" class="mb-4" style="min-height: 150px;">
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-cart-x display-4 mb-3 d-block opacity-50"></i>
                        <p>Votre panier est vide.</p>
                    </div>
                </div>
                
                <div class="border-top pt-4" style="border-color: var(--color-gris-clair) !important;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.85rem; letter-spacing: 1px;">Total à payer</span>
                        <span class="fw-bold fs-3 text-rouge" id="cart-total">0.00 €</span>
                    </div>
                    <button class="btn btn-marco w-100 rounded-pill py-3 fw-bold d-flex justify-content-center align-items-center gap-2" id="btn-submit-cart" disabled style="font-size: 1.1rem;">
                        Commander <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$extraJs = '/public/js/cart.js';
require 'views/layout/footer.php';
?>
