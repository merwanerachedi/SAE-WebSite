<?php require 'views/layout/header.php'; ?>
<h2>Gestion des utilisateurs</h2>
<table class="table table-hover table-striped">
    <thead class="table-dark">
        <tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Inscrit le</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <form method="POST" action="/?action=admin_user_role" class="d-flex gap-2 align-items-center">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <select name="role" class="form-select form-select-sm" style="width:auto">
                        <option value="user"  <?= $user['role'] === 'user'  ? 'selected' : '' ?>>user</option>
                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>admin</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-dark">OK</button>
                </form>
            </td>
            <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
            <td>
                <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                    <button class="btn btn-sm btn-outline-danger btn-delete"
                            data-href="/?action=admin_user_delete&id=<?= $user['id'] ?>">
                        Supprimer
                    </button>
                <?php else: ?>
                    <span class="text-muted small">Vous</span>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require 'views/layout/footer.php'; ?>
