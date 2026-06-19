<?php require 'views/layout/header.php'; ?>
<h2 class="mb-4">Mes commandes</h2>

<?php if (empty($commandes)): ?>
    <div class="alert alert-info">
        Vous n'avez pas encore passé de commande.
        <a href="<?= BASE_URL ?>?action=plats">Voir la carte</a>
    </div>
<?php else: ?>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Total</th>
                <th>Statut</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        /* Correspondance statut → classe Bootstrap. */
        $badges = [
            'en_attente' => 'bg-warning text-dark',
            'confirmée'  => 'bg-primary',
            'livrée'     => 'bg-success',
            'annulée'    => 'bg-danger',
        ];
        foreach ($commandes as $cmd):
            $badge = $badges[$cmd['statut']] ?? 'bg-secondary';
        ?>
            <tr>
                <td><?= $cmd['id'] ?></td>
                <td><?= date('d/m/Y H:i', strtotime($cmd['created_at'])) ?></td>
                <td><?= number_format($cmd['total'], 2) ?> €</td>
                <td><span class="badge <?= $badge ?>"><?= htmlspecialchars($cmd['statut']) ?></span></td>
                <td>
                    <a href="<?= BASE_URL ?>?action=commande_show&id=<?= $cmd['id'] ?>" class="btn btn-sm btn-outline-dark">
                        Détail
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php require 'views/layout/footer.php'; ?>
