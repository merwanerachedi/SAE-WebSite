<?php require 'views/layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-7">
        <?php
        /* Correspondance statut → classe Bootstrap. */
        $badges = [
            'en_attente' => 'bg-warning text-dark',
            'confirmée'  => 'bg-primary',
            'livrée'     => 'bg-success',
            'annulée'    => 'bg-danger',
        ];
        $badge = $badges[$commande['statut']] ?? 'bg-secondary';
        ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Commande #<?= $commande['id'] ?></h2>
            <span class="badge <?= $badge ?> fs-6"><?= htmlspecialchars($commande['statut']) ?></span>
        </div>

        <p class="text-muted">
            Passée le <?= date('d/m/Y à H:i', strtotime($commande['created_at'])) ?>
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th>Plat</th>
                    <th>Qté</th>
                    <th>Prix unitaire</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($lignes as $ligne): ?>
                <tr>
                    <td><?= htmlspecialchars($ligne['plat_nom']) ?></td>
                    <td><?= $ligne['quantite'] ?></td>
                    <td><?= number_format($ligne['prix_unitaire'], 2) ?> €</td>
                    <td><?= number_format($ligne['prix_unitaire'] * $ligne['quantite'], 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="fw-bold">
                    <td colspan="3" class="text-end">Total</td>
                    <td><?= number_format($commande['total'], 2) ?> €</td>
                </tr>
            </tfoot>
        </table>

        <a href="<?= BASE_URL ?>?action=mes_commandes" class="btn btn-outline-dark">← Mes commandes</a>
    </div>
</div>
<?php require 'views/layout/footer.php'; ?>
