<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-5">
        <i class="bi bi-list-stars text-dore display-5 me-3"></i>
        <div>
            <h2 class="mb-0" style="font-family: var(--font-display);">Nouveau menu</h2>
            <p class="text-muted mb-0">Créer une nouvelle formule ou menu spécial</p>
        </div>
    </div>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card-marco p-4 col-lg-8 mx-auto">
        <form action="<?= BASE_URL ?>?action=menu_store" method="POST">
            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="nom" class="form-label fw-medium">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="prix" class="form-label fw-medium">Prix (€)</label>
                    <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="description" class="form-label fw-medium">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-medium mb-3">Plats inclus dans ce menu</label>
                <div class="row row-cols-1 row-cols-md-2 g-3 p-3 bg-light rounded border">
                    <?php foreach ($plats as $plat): ?>
                    <div class="col">
                        <div class="form-check custom-checkbox-marco">
                            <input class="form-check-input shadow-sm" type="checkbox"
                                   name="plat_ids[]"
                                   value="<?= $plat['id'] ?>"
                                   id="plat_<?= $plat['id'] ?>">
                            <label class="form-check-label w-100" for="plat_<?= $plat['id'] ?>">
                                <span><?= htmlspecialchars($plat['nom']) ?></span>
                                <br>
                                <small class="text-muted"><?= number_format($plat['prix'], 2) ?> €</small>
                            </label>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="mb-4 form-check form-switch">
                <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1" checked>
                <label class="form-check-label ms-2" for="actif">Menu actif</label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-marco flex-grow-1">Créer le menu</button>
                <a href="<?= BASE_URL ?>?action=menus" class="btn btn-outline-secondary px-4">Annuler</a>
            </div>
        </form>
    </div>
</div>
