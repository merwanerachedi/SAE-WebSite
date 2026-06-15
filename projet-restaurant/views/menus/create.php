<div class="container mt-4">
    <h2>Ajouter un menu</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="<?= BASE_URL ?>?action=menu_store" method="POST">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="actif" name="actif" value="1" checked>
            <label class="form-check-label" for="actif">Actif</label>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="<?= BASE_URL ?>?action=menus" class="btn btn-secondary">Annuler</a>
    </form>
</div>
