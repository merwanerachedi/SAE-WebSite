<?php require 'views/layout/header.php'; ?>
<div class="container-fluid py-4">
    <div class="d-flex align-items-center justify-content-between mb-5">
        <div class="d-flex align-items-center">
            <i class="bi bi-people text-dore display-5 me-3"></i>
            <div>
                <h2 class="mb-0" style="font-family: var(--font-display);">Gestion des utilisateurs</h2>
                <p class="text-muted mb-0">Administrez les comptes clients et administrateurs</p>
            </div>
        </div>
    </div>

    <div class="card-marco p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4 fw-medium border-0">Nom complet</th>
                        <th class="py-3 px-4 fw-medium border-0">Email</th>
                        <th class="py-3 px-4 fw-medium border-0">Rôle</th>
                        <th class="py-3 px-4 fw-medium border-0">Inscrit le</th>
                        <th class="py-3 px-4 fw-medium border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="px-4 py-3 fw-medium">
                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3 text-dore fw-bold shadow-sm" style="width: 40px; height: 40px;">
                                    <?= strtoupper(substr($user['prenom'], 0, 1) . substr($user['nom'], 0, 1)) ?>
                                </div>
                                <?= htmlspecialchars($user['prenom'] . ' ' . $user['nom']) ?>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-muted"><?= htmlspecialchars($user['email']) ?></td>
                        <td class="px-4 py-3">
                            <form method="POST" action="<?= BASE_URL ?>?action=admin_user_role" class="d-flex gap-2 align-items-center m-0">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <select name="role" class="form-select form-select-sm rounded-pill border-dark" style="width:110px" onchange="this.form.submit()">
                                    <option value="user"  <?= $user['role'] === 'user'  ? 'selected' : '' ?>>Client</option>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                                <noscript><button type="submit" class="btn btn-sm btn-dark rounded-pill">OK</button></noscript>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-muted small"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                        <td class="px-4 py-3 text-end">
                            <?php if ($user['id'] !== $_SESSION['user_id']): ?>
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3 btn-delete"
                                        data-href="<?= BASE_URL ?>?action=admin_user_delete&id=<?= $user['id'] ?>">
                                    <i class="bi bi-trash3 me-1"></i> Supprimer
                                </button>
                            <?php else: ?>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Vous-même</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require 'views/layout/footer.php'; ?>
