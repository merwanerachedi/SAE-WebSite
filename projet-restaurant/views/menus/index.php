<div class="container mt-4">
    <h2>Gestion des Menus</h2>
    <a href="<?= BASE_URL ?>?action=menu_create" class="btn btn-primary mb-3">Ajouter un menu</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Actif</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
                <tr>
                    <td><?= htmlspecialchars($menu['id']) ?></td>
                    <td><?= htmlspecialchars($menu['nom']) ?></td>
                    <td><?= number_format($menu['prix'], 2, ',', ' ') ?> €</td>
                    <td><?= $menu['actif'] ? 'Oui' : 'Non' ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>?action=menu_edit&id=<?= $menu['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="<?= BASE_URL ?>?action=menu_delete" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce menu ?');">
                            <input type="hidden" name="id" value="<?= $menu['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
