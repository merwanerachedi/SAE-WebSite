<?php require 'views/layout/header.php'; ?>
<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-5">
        <i class="bi bi-receipt text-dore display-5 me-3"></i>
        <div>
            <h2 class="mb-0" style="font-family: var(--font-display);">Toutes les commandes</h2>
            <p class="text-muted mb-0">Gérez l'ensemble des commandes du restaurant</p>
        </div>
    </div>

    <div class="card-marco p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="py-3 px-4 fw-medium border-0">N° Commande</th>
                        <th class="py-3 px-4 fw-medium border-0">Client</th>
                        <th class="py-3 px-4 fw-medium border-0">Date & Heure</th>
                        <th class="py-3 px-4 fw-medium border-0">Total</th>
                        <th class="py-3 px-4 fw-medium border-0">Statut</th>
                        <th class="py-3 px-4 fw-medium border-0 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
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
                        <td class="px-4 py-3 fw-medium">
                            <a href="<?= BASE_URL ?>?action=commande_show&id=<?= $cmd['id'] ?>" class="text-decoration-none text-dark">#<?= str_pad($cmd['id'], 5, '0', STR_PAD_LEFT) ?></a>
                        </td>
                        <td class="px-4 py-3 fw-medium"><?= htmlspecialchars($cmd['user_prenom'] . ' ' . $cmd['user_nom']) ?></td>
                        <td class="px-4 py-3 text-muted small">
                            <?= date('d/m/Y', strtotime($cmd['created_at'])) ?>
                            <span class="ms-1"><?= date('H:i', strtotime($cmd['created_at'])) ?></span>
                        </td>
                        <td class="px-4 py-3 fw-bold"><?= number_format($cmd['total'], 2) ?> €</td>
                        <td class="px-4 py-3">
                            <span class="badge rounded-pill <?= $badge ?> px-3 py-2 fw-normal d-inline-flex align-items-center">
                                <i class="bi <?= $icon ?> me-1"></i> <?= ucfirst(str_replace('_', ' ', htmlspecialchars($cmd['statut']))) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-end">
                            <form method="POST" action="<?= BASE_URL ?>?action=commande_statut" class="d-inline-block m-0">
                                <input type="hidden" name="id" value="<?= $cmd['id'] ?>">
                                <div class="input-group input-group-sm">
                                    <select name="statut" class="form-select border-dark text-dark rounded-start-pill" style="min-width: 130px;" onchange="this.form.submit()">
                                        <?php foreach (['en_attente', 'confirmée', 'livrée', 'annulée'] as $s): ?>
                                            <option value="<?= $s ?>" <?= $cmd['statut'] === $s ? 'selected' : '' ?>>
                                                <?= ucfirst(str_replace('_', ' ', $s)) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <noscript><button type="submit" class="btn btn-dark rounded-end-pill">OK</button></noscript>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require 'views/layout/footer.php'; ?>
