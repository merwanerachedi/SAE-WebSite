<?php require 'views/layout/header.php'; ?>
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-5">
        <i class="bi bi-cup-hot text-dore display-5 me-3"></i>
        <div>
            <h2 class="mb-0" style="font-family: var(--font-display);">Nouveau plat</h2>
            <p class="text-muted mb-0">Ajouter un nouveau plat à la carte</p>
        </div>
    </div>
    <div class="card-marco p-4 col-md-8 col-lg-6 mx-auto">
        <form method="POST" action="<?= BASE_URL ?>?action=plat_store" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label fw-medium">Nom</label>
                <input type="text" class="form-control" name="nom" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-medium">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Prix (€)</label>
                    <input type="number" step="0.01" min="0" class="form-control" name="prix" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-medium">Catégorie</label>
                    <select class="form-select" name="categorie_id" required>
                        <option value="">-- Choisir --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label fw-medium">Image du plat</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/jpeg, image/png, image/webp">
                <div class="form-text">JPG, PNG ou WebP — 5 Mo max</div>
            </div>
            <div class="mb-4 form-check form-switch">
                <input type="checkbox" class="form-check-input" name="disponible" value="1" id="disponibleCheck" checked>
                <label class="form-check-label ms-2" for="disponibleCheck">Disponible à la carte</label>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-marco flex-grow-1">Créer le plat</button>
                <a href="<?= BASE_URL ?>?action=plats_admin" class="btn btn-outline-secondary px-4">Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php require 'views/layout/footer.php'; ?>
