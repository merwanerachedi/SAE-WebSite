<?php require 'views/layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Catégories</h2>
    <a href="<?= BASE_URL ?>?action=categorie_create" class="btn btn-dark">+ Nouvelle catégorie</a>
</div>
<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><th>Nom</th><th>Description</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $cat): ?>
        <tr>
            <td><?= htmlspecialchars($cat['nom']) ?></td>
            <td><?= htmlspecialchars($cat['description'] ?? '') ?></td>
            <td>
                <a href="<?= BASE_URL ?>?action=categorie_edit&id=<?= $cat['id'] ?>" class="btn btn-sm btn-outline-dark">Modifier</a>
                <button class="btn btn-sm btn-outline-danger btn-delete"
                        data-href="<?= BASE_URL ?>?action=categorie_delete&id=<?= $cat['id'] ?>">Supprimer</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require 'views/layout/footer.php'; ?>
