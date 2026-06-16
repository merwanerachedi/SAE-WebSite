<div class="container mt-4">
    <h2>Modifier le menu</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="<?= BASE_URL ?>?action=menu_update" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($menu['id']) ?>">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($menu['nom']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"><?= htmlspecialchars($menu['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($menu['prix']) ?>" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1" <?= $menu['actif'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="actif">Actif</label>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Plats inclus dans ce menu</label>
            <div class="row row-cols-2 row-cols-md-3 g-2">
                <?php foreach ($plats as $plat): ?>
                <div class="col">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="plat_ids[]"
                               value="<?= $plat['id'] ?>"
                               id="plat_<?= $plat['id'] ?>"
                               <?= isset($platsMenu) && in_array($plat['id'], $platsMenu) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="plat_<?= $plat['id'] ?>">
                            <?= htmlspecialchars($plat['nom']) ?>
                            <small class="text-muted">(<?= number_format($plat['prix'], 2) ?> €)</small>
                        </label>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Mettre a jour</button>
        <a href="<?= BASE_URL ?>?action=menus" class="btn btn-secondary">Annuler</a>
    </form>
</div>
