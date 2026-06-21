<?php require 'views/layout/header.php'; ?>
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-5">
        <div class="d-flex align-items-center">
            <i class="bi bi-tags text-dore display-5 me-3"></i>
            <div>
                <h2 class="mb-0" style="font-family: var(--font-display);">Catégories</h2>
                <p class="text-muted mb-0">Gérez les catégories de votre carte</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>?action=categorie_create" class="btn btn-marco rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Nouvelle catégorie
        </a>
    </div>

    <div class="card-marco p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4 fw-medium border-0">Nom</th>
                        <th class="py-3 px-4 fw-medium border-0">Description</th>
                        <th class="py-3 px-4 fw-medium border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td class="px-4 py-3 fw-medium text-dark"><?= htmlspecialchars($cat['nom']) ?></td>
                        <td class="px-4 py-3 text-muted"><?= htmlspecialchars($cat['description'] ?? '') ?></td>
                        <td class="px-4 py-3 text-end">
                            <a href="<?= BASE_URL ?>?action=categorie_edit&id=<?= $cat['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 me-1">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <button class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                    data-href="<?= BASE_URL ?>?action=categorie_delete&id=<?= $cat['id'] ?>">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require 'views/layout/footer.php'; ?>
