<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-5">
        <div class="d-flex align-items-center">
            <i class="bi bi-list-stars text-dore display-5 me-3"></i>
            <div>
                <h2 class="mb-0" style="font-family: var(--font-display);">Gestion des Menus</h2>
                <p class="text-muted mb-0">Gérez vos formules et menus spéciaux</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>?action=menu_create" class="btn btn-marco rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>Nouveau menu
        </a>
    </div>

    <div class="card-marco p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4 fw-medium border-0">ID</th>
                        <th class="py-3 px-4 fw-medium border-0">Nom</th>
                        <th class="py-3 px-4 fw-medium border-0 text-end">Prix</th>
                        <th class="py-3 px-4 fw-medium border-0 text-center">Actif</th>
                        <th class="py-3 px-4 fw-medium border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($menus as $menu): ?>
                        <tr>
                            <td class="px-4 py-3 text-muted">#<?= str_pad($menu['id'], 3, '0', STR_PAD_LEFT) ?></td>
                            <td class="px-4 py-3 fw-medium text-dark"><?= htmlspecialchars($menu['nom']) ?></td>
                            <td class="px-4 py-3 fw-bold text-end"><?= number_format($menu['prix'], 2, ',', ' ') ?> €</td>
                            <td class="px-4 py-3 text-center">
                                <?php if ($menu['actif']): ?>
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-normal"><i class="bi bi-check-circle me-1"></i> Actif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-normal"><i class="bi bi-dash-circle me-1"></i> Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="<?= BASE_URL ?>?action=menu_edit&id=<?= $menu['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 me-1">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <form action="<?= BASE_URL ?>?action=menu_delete" method="POST" class="d-inline m-0" onsubmit="return confirm('Supprimer ce menu ?');">
                                    <input type="hidden" name="id" value="<?= $menu['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
