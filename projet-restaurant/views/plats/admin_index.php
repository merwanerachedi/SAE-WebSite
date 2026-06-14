<?php require 'views/layout/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestion des plats</h2>
    <a href="/?action=plat_create" class="btn btn-dark">+ Nouveau plat</a>
</div>
<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><th>Nom</th><th>Catégorie</th><th>Prix</th><th>Dispo</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($plats as $plat): ?>
        <tr>
            <td><?= htmlspecialchars($plat['nom']) ?></td>
            <td><?= htmlspecialchars($plat['categorie_nom']) ?></td>
            <td><?= number_format($plat['prix'], 2) ?> €</td>
            <td>
                <span class="badge <?= $plat['disponible'] ? 'bg-success' : 'bg-secondary' ?>">
                    <?= $plat['disponible'] ? 'Oui' : 'Non' ?>
                </span>
            </td>
            <td>
                <a href="/?action=plat_edit&id=<?= $plat['id'] ?>" class="btn btn-sm btn-outline-dark">Modifier</a>
                <button class="btn btn-sm btn-outline-danger btn-delete"
                        data-href="/?action=plat_delete&id=<?= $plat['id'] ?>">Supprimer</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require 'views/layout/footer.php'; ?>
