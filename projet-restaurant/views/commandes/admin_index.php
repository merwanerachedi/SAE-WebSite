<?php require 'views/layout/header.php'; ?>
<h2>Toutes les commandes</h2>
<table class="table table-hover table-striped">
    <thead class="table-dark">
        <tr><th>#</th><th>Client</th><th>Date</th><th>Total</th><th>Statut</th><th>Modifier</th></tr>
    </thead>
    <tbody>
    <?php foreach ($commandes as $cmd): ?>
        <tr>
            <td><?= $cmd['id'] ?></td>
            <td><?= htmlspecialchars($cmd['user_prenom'] . ' ' . $cmd['user_nom']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($cmd['created_at'])) ?></td>
            <td><?= number_format($cmd['total'], 2) ?> €</td>
            <td>
                <?php
                $badges = ['en_attente' => 'bg-warning text-dark', 'confirmée' => 'bg-primary',
                           'livrée' => 'bg-success', 'annulée' => 'bg-danger'];
                ?>
                <span class="badge <?= $badges[$cmd['statut']] ?? 'bg-secondary' ?>">
                    <?= htmlspecialchars($cmd['statut']) ?>
                </span>
            </td>
            <td>
                <form method="POST" action="<?= BASE_URL ?>?action=commande_statut" class="d-flex gap-2">
                    <input type="hidden" name="id" value="<?= $cmd['id'] ?>">
                    <select name="statut" class="form-select form-select-sm" style="width:auto">
                        <?php foreach (['en_attente', 'confirmée', 'livrée', 'annulée'] as $s): ?>
                            <option value="<?= $s ?>" <?= $cmd['statut'] === $s ? 'selected' : '' ?>>
                                <?= $s ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-sm btn-dark">OK</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php require 'views/layout/footer.php'; ?>
