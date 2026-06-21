</div> <!-- Fermeture du container par defaut du header pour avoir un fond plein ecran -->

<!-- Hero Section -->
<div class="position-relative d-flex align-items-center justify-content-center mb-5" 
     style="min-height: 65vh; margin-top: -1.5rem; background: linear-gradient(rgba(26, 26, 26, 0.65), rgba(26, 26, 26, 0.8)), url('https://images.unsplash.com/photo-1498579150354-979475344aef?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;">
    
    <div class="text-center px-4" style="max-width: 800px; z-index: 1;">
        <h1 class="display-3 fw-bold mb-4" style="font-family: var(--font-titre); color: var(--color-blanc);">
            L'authentique goût de <span class="text-dore">l'Italie</span>
        </h1>
        <p class="lead mb-5 fs-4" style="color: rgba(251, 249, 246, 0.9);">
            Des pâtes fraîches maison, des pizzas au feu de bois et une ambiance chaleureuse en plein cœur de la ville. Venez découvrir la vraie cuisine traditionnelle italienne.
        </p>
        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a href="<?= BASE_URL ?>?action=plats" class="btn btn-marco btn-lg px-4 rounded-pill shadow-sm">
                Découvrir la carte
            </a>
            <a href="#about" class="btn btn-outline-light btn-lg px-4 rounded-pill">
                Notre histoire
            </a>
        </div>
    </div>
</div>

<!-- Section: 3 atouts (Savoir-faire) -->
<div class="container mb-5" id="about">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="p-4 card h-100 border-0">
                <div class="mb-3" style="font-size: 2.5rem;">🍝</div>
                <h4 class="mb-3 text-dore">Fait Maison</h4>
                <p class="text-muted">Toutes nos pâtes sont préparées chaque matin par notre chef avec de la farine italienne sélectionnée avec amour.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 card h-100 border-0">
                <div class="mb-3" style="font-size: 2.5rem;">🍅</div>
                <h4 class="mb-3 text-dore">Produits Frais</h4>
                <p class="text-muted">Des ingrédients importés directement d'Italie et des légumes de nos producteurs locaux partenaires.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 card h-100 border-0">
                <div class="mb-3" style="font-size: 2.5rem;">🍷</div>
                <h4 class="mb-3 text-dore">Cave d'Exception</h4>
                <p class="text-muted">Une sélection pointue de vins italiens pour accompagner parfaitement chaque plat de notre carte gourmande.</p>
            </div>
        </div>
    </div>
</div>

<div class="container"> <!-- Re-ouverture du container pour que le footer se ferme correctement -->
