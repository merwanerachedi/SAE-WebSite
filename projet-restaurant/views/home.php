</div> <!-- Fermeture du container par defaut du header pour avoir un fond plein ecran -->

<!-- Hero Section -->
<div class="position-relative hero-section" data-animate>
    <div class="text-center px-4" style="max-width: 800px; z-index: 1;">
        <h1 class="hero-title mb-4 text-white fw-bold" style="text-shadow: 2px 2px 10px rgba(0,0,0,0.8);">
            L'authentique goût de <span class="text-dore">l'Italie</span>
        </h1>
        <p class="lead mb-5 fs-4" style="color: rgba(251, 249, 246, 0.9);">
            Des pâtes fraîches maison, des pizzas au feu de bois et une ambiance chaleureuse en plein cœur de la ville. Venez découvrir la vraie cuisine traditionnelle italienne.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="<?= BASE_URL ?>?action=plats" class="btn btn-marco btn-lg">
                Découvrir la carte
            </a>
            <a href="#about" class="btn btn-outline-marco btn-lg" style="color:white; border-color:white;">
                Notre histoire
            </a>
        </div>
    </div>
</div>

<!-- Section: 3 atouts (Savoir-faire) -->
<div class="container my-5 py-5" id="about">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="p-4 card-marco h-100 feature-card">
                <div class="feature-icon-wrapper"><i class="bi bi-house-heart"></i></div>
                <h4 class="mb-3 text-dore">Fait Maison</h4>
                <p class="text-muted">Toutes nos pâtes sont préparées chaque matin par notre chef avec de la farine italienne sélectionnée avec amour.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 card-marco h-100 feature-card">
                <div class="feature-icon-wrapper"><i class="bi bi-basket2"></i></div>
                <h4 class="mb-3 text-dore">Produits Frais</h4>
                <p class="text-muted">Des ingrédients importés directement d'Italie et des légumes de nos producteurs locaux partenaires.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 card-marco h-100 feature-card">
                <div class="feature-icon-wrapper"><i class="bi bi-cup-straw"></i></div>
                <h4 class="mb-3 text-dore">Cave d'Exception</h4>
                <p class="text-muted">Une sélection pointue de vins italiens pour accompagner parfaitement chaque plat de notre carte gourmande.</p>
            </div>
        </div>
    </div>
</div>

<hr class="divider-dore">

<!-- Plats Signatures (Nouveau) -->
<div class="container my-5 py-5">
    <div class="text-center mb-5">
        <h2 class="display-5 text-noir">Nos Signatures</h2>
        <p class="text-muted">Les incontournables de la Maison</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-marco h-100 plat-card">
                <img src="<?= BASE_URL ?>public/uploads/plats/Spaghetti-Carbonara.png" class="card-img-top" alt="Carbonara" style="height:220px; object-fit:cover;">
                <div class="card-body p-4 text-center">
                    <h4 class="card-title mb-3">Spaghetti Carbonara</h4>
                    <p class="text-muted small mb-4">Pancetta authentique, pecorino romano, oeufs frais et poivre noir. La vraie recette romaine.</p>
                    <a href="<?= BASE_URL ?>?action=plats" class="btn btn-outline-marco rounded-pill">Commander</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-marco h-100 plat-card">
                <img src="<?= BASE_URL ?>public/uploads/plats/Pizza-Margherita.png" class="card-img-top" alt="Margherita" style="height:220px; object-fit:cover;">
                <div class="card-body p-4 text-center">
                    <h4 class="card-title mb-3">Pizza Margherita</h4>
                    <p class="text-muted small mb-4">Sauce tomate San Marzano, mozzarella di bufala fraiche, basilic et huile d'olive vierge extra.</p>
                    <a href="<?= BASE_URL ?>?action=plats" class="btn btn-outline-marco rounded-pill">Commander</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-marco h-100 plat-card">
                <img src="<?= BASE_URL ?>public/uploads/plats/Tiramisu.png" class="card-img-top" alt="Tiramisu" style="height:220px; object-fit:cover;">
                <div class="card-body p-4 text-center">
                    <h4 class="card-title mb-3">Tiramisu Maison</h4>
                    <p class="text-muted small mb-4">Mascarpone onctueux, biscuits cuillère imbibés de café expresso et cacao amer saupoudré.</p>
                    <a href="<?= BASE_URL ?>?action=plats" class="btn btn-outline-marco rounded-pill">Commander</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Banner -->
<div class="container-fluid bg-dark text-white text-center py-5 mt-5" style="background-color: var(--color-noir) !important; border-top: 2px solid var(--color-dore);">
    <div class="container py-4">
        <h2 class="display-5 mb-4" style="font-family: var(--font-display); color: var(--color-dore);">La dolce vita à portée de fourchette</h2>
        <p class="lead mb-4" style="color: rgba(255,255,255,0.7);">Commandez en ligne et dégustez nos plats chez vous.</p>
        <a href="<?= BASE_URL ?>?action=plats" class="btn btn-marco btn-lg px-5 rounded-pill">Découvrir la carte</a>
    </div>
</div>

<div class="container"> <!-- Re-ouverture du container pour que le footer se ferme correctement -->
