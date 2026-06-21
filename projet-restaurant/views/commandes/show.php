<?php require 'views/layout/header.php'; ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-4">
                <a href="<?= BASE_URL ?>?action=mes_commandes" class="btn btn-outline-dark rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h2 class="mb-0" style="font-family: var(--font-display);">Détail de la commande</h2>
                    <p class="text-muted mb-0">Retrouvez les informations de votre commande.</p>
                </div>
            </div>

            <div class="card-marco p-4 p-md-5">
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
                $badge = $badges[$commande['statut']] ?? 'bg-secondary';
                $icon = $icons[$commande['statut']] ?? 'bi-circle';
                ?>
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center pb-4 border-bottom mb-4" style="border-color: var(--color-gris-clair) !important;">
                    <div>
                        <h4 class="mb-1 fw-bold">Commande #<?= str_pad($commande['id'], 5, '0', STR_PAD_LEFT) ?></h4>
                        <p class="text-muted small mb-0"><i class="bi bi-calendar3 me-2"></i>Passée le <?= date('d/m/Y à H:i', strtotime($commande['created_at'])) ?></p>
                    </div>
                    <div class="mt-3 mt-sm-0">
                        <span class="badge rounded-pill <?= $badge ?> px-4 py-2 fw-normal fs-6 shadow-sm">
                            <i class="bi <?= $icon ?> me-2"></i><?= ucfirst(str_replace('_', ' ', htmlspecialchars($commande['statut']))) ?>
                        </span>
                    </div>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th class="text-muted small text-uppercase fw-semibold border-top-0 px-0" style="letter-spacing: 0.5px;">Plat</th>
                                <th class="text-muted small text-uppercase fw-semibold border-top-0 text-center" style="letter-spacing: 0.5px;">Qté</th>
                                <th class="text-muted small text-uppercase fw-semibold border-top-0 text-end" style="letter-spacing: 0.5px;">Prix unitaire</th>
                                <th class="text-muted small text-uppercase fw-semibold border-top-0 text-end px-0" style="letter-spacing: 0.5px;">Sous-total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lignes as $ligne): ?>
                            <tr>
                                <td class="px-0 py-3 fw-medium text-dark"><?= htmlspecialchars($ligne['plat_nom']) ?></td>
                                <td class="text-center py-3"><span class="badge bg-light text-dark border px-2 py-1"><?= $ligne['quantite'] ?></span></td>
                                <td class="text-end py-3 text-muted"><?= number_format($ligne['prix_unitaire'], 2) ?> €</td>
                                <td class="text-end px-0 py-3 fw-medium"><?= number_format($ligne['prix_unitaire'] * $ligne['quantite'], 2) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end py-4 border-bottom-0 fw-bold fs-5" style="font-family: var(--font-display);">Total</td>
                                <td class="text-end px-0 py-4 border-bottom-0 fw-bold fs-4 text-dore" style="font-family: var(--font-display);"><?= number_format($commande['total'], 2) ?> €</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'views/layout/footer.php'; ?>
