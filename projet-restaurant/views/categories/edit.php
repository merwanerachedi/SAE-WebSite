<?php require 'views/layout/header.php'; ?>
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-5">
        <i class="bi bi-pencil-square text-dore display-5 me-3"></i>
        <div>
            <h2 class="mb-0" style="font-family: var(--font-display);">Modifier la catégorie</h2>
            <p class="text-muted mb-0">Mettre à jour les informations de la catégorie</p>
        </div>
    </div>
    <div class="card-marco p-4 col-md-8 col-lg-6 mx-auto">
        <form method="POST" action="<?= BASE_URL ?>?action=categorie_update">
            <input type="hidden" name="id" value="<?= $categorie['id'] ?>">
            <div class="mb-3">
                <label class="form-label fw-medium">Nom</label>
                <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($categorie['nom']) ?>" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-medium">Description</label>
                <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($categorie['description'] ?? '') ?></textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-marco flex-grow-1">Enregistrer les modifications</button>
                <a href="<?= BASE_URL ?>?action=categories" class="btn btn-outline-secondary px-4">Annuler</a>
            </div>
        </form>
    </div>
</div>
<?php require 'views/layout/footer.php'; ?>
