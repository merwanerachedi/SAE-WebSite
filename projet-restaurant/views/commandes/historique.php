<?php require 'views/layout/header.php'; ?>
<div class="container my-5">
    <div class="text-center mb-5">
        <h2 class="display-5" style="font-family: var(--font-display);">Mes commandes</h2>
        <div class="divider mx-auto my-3"></div>
        <p class="text-muted">Retrouvez l'historique de vos dégustations chez Marco.</p>
    </div>

    <?php if (empty($commandes)): ?>
        <div class="text-center py-5">
            <i class="bi bi-receipt display-1 text-muted opacity-25 mb-4 d-block"></i>
            <h4 style="font-family: var(--font-display);">Aucune commande pour le moment</h4>
            <p class="text-muted mb-4">Laissez-vous tenter par notre carte raffinée.</p>
            <a href="<?= BASE_URL ?>?action=plats" class="btn btn-marco px-4 rounded-pill">Découvrir notre carte</a>
        </div>
    <?php else: ?>
        <div class="card-marco p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th class="py-3 px-4 fw-medium border-0">N° Commande</th>
                            <th class="py-3 px-4 fw-medium border-0">Date & Heure</th>
                            <th class="py-3 px-4 fw-medium border-0">Total</th>
                            <th class="py-3 px-4 fw-medium border-0">Statut</th>
                            <th class="py-3 px-4 fw-medium border-0 text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    /* Correspondance statut → classe Bootstrap. */
                    $badges = [
                        'en_attente' => 'bg-warning text-dark',
                        'confirmée'  => 'bg-info text-dark',
                        'livrée'     => 'bg-success',
                        'annulée'    => 'bg-danger',
                    ];
                    $icons = [
                        'en_attente' => 'bi-hourglass-split',
                        'confirmée'  => 'bi-check2-circle',
                        'livrée'     => 'bi-box-seam',
                        'annulée'    => 'bi-x-circle',
                    ];
                    foreach ($commandes as $cmd):
                        $badge = $badges[$cmd['statut']] ?? 'bg-secondary';
                        $icon = $icons[$cmd['statut']] ?? 'bi-circle';
                    ?>
                        <tr>
                            <td class="px-4 py-3 fw-medium text-muted">#<?= str_pad($cmd['id'], 5, '0', STR_PAD_LEFT) ?></td>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-calendar3 text-muted me-2 small"></i>
                                    <?= date('d/m/Y', strtotime($cmd['created_at'])) ?>
                                    <span class="text-muted ms-2 small"><?= date('H:i', strtotime($cmd['created_at'])) ?></span>
                                </div>
                            </td>
                            <td class="px-4 py-3 fw-bold"><?= number_format($cmd['total'], 2) ?> €</td>
                            <td class="px-4 py-3">
                                <span class="badge rounded-pill <?= $badge ?> px-3 py-2 fw-normal">
                                    <i class="bi <?= $icon ?> me-1"></i> <?= ucfirst(str_replace('_', ' ', htmlspecialchars($cmd['statut']))) ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="<?= BASE_URL ?>?action=commande_show&id=<?= $cmd['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    Détails <i class="bi bi-arrow-right ms-1 small"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php require 'views/layout/footer.php'; ?>
