<?php require 'views/layout/header.php'; ?>
<div class="row">
    <!-- Catalogue des plats -->
    <div class="col-md-8">
        <h2 class="mb-3"><i class="bi bi-journal-text me-2"></i>Notre carte</h2>

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
                    <?php
                    // Fallback local si pas d'image
                    $imgSrc = !empty($plat['image_url'])
                        ? BASE_URL . $plat['image_url']
                        : BASE_URL . 'public/assets/img/default-plat.png';
                    ?>
                    <img src="<?= $imgSrc ?>" class="card-img-top" alt="<?= htmlspecialchars($plat['nom']) ?>"
                         style="height: 200px; object-fit: cover;">
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
    <div class="col-md-4">
        <div class="card sticky-top shadow-sm border-0" style="top: 80px; border-radius: 16px;">
            <div class="card-body p-4 p-xl-5">
                <h4 class="mb-4 d-flex justify-content-between align-items-center fw-bold" style="font-family: 'Playfair Display', serif;">
                    <span>Mon panier</span>
                    <span class="badge rounded-pill" id="cart-badge" style="background-color: var(--marco-rouge); font-family: 'Inter', sans-serif; font-size: 1rem;">0</span>
                </h4>
                
                <div id="cart-items" class="mb-4" style="min-height: 100px;">
                    <p class="text-muted">Votre panier est vide.</p>
                </div>
                
                <div class="border-top pt-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.85rem; letter-spacing: 1px;">Total à payer</span>
                        <span class="fw-bold fs-3" id="cart-total" style="color: var(--marco-rouge);">0.00 €</span>
                    </div>
                    <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold d-flex justify-content-center align-items-center gap-2 transition" id="btn-submit-cart" disabled style="font-size: 1.1rem;">
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
