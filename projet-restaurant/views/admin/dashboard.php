<?php require 'views/layout/header.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex align-items-center mb-5">
        <i class="bi bi-speedometer2 text-dore display-5 me-3"></i>
        <div>
            <h2 class="mb-0" style="font-family: var(--font-display);">Tableau de bord</h2>
            <p class="text-muted mb-0">Vue d'ensemble de l'activité du restaurant</p>
        </div>
    </div>

    <!-- Cartes KPI -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4 mb-5">
        <div class="col">
            <div class="card-marco bg-dark text-white h-100 p-4 position-relative overflow-hidden">
                <i class="bi bi-receipt position-absolute" style="font-size: 5rem; right: -10px; bottom: -10px; opacity: 0.1;"></i>
                <h6 class="text-uppercase small fw-semibold mb-3" style="letter-spacing: 1px; color: var(--color-dore);">Commandes</h6>
                <h2 class="display-5 mb-0 fw-bold text-white" style="font-family: var(--font-display);"><?= $nbCommandes ?></h2>
            </div>
        </div>
        <div class="col">
            <div class="card-marco text-white h-100 p-4 position-relative overflow-hidden" style="background-color: var(--color-rouge);">
                <i class="bi bi-people position-absolute" style="font-size: 5rem; right: -10px; bottom: -10px; opacity: 0.1;"></i>
                <h6 class="text-uppercase small fw-semibold mb-3 text-white-50" style="letter-spacing: 1px;">Clients</h6>
                <h2 class="display-5 mb-0 fw-bold text-white" style="font-family: var(--font-display);"><?= $nbClients ?></h2>
            </div>
        </div>
        <div class="col">
            <div class="card-marco h-100 p-4 position-relative overflow-hidden" style="background-color: var(--color-dore); color: var(--color-noir);">
                <i class="bi bi-cup-hot position-absolute" style="font-size: 5rem; right: -10px; bottom: -10px; opacity: 0.1;"></i>
                <h6 class="text-uppercase small fw-semibold mb-3" style="letter-spacing: 1px; opacity: 0.7;">Plats disponibles</h6>
                <h2 class="display-5 mb-0 fw-bold text-dark" style="font-family: var(--font-display);"><?= $nbPlats ?></h2>
            </div>
        </div>
        <div class="col">
            <div class="card-marco h-100 p-4 position-relative overflow-hidden" style="background-color: #2b4c3b; color: white;">
                <i class="bi bi-currency-euro position-absolute" style="font-size: 5rem; right: -10px; bottom: -10px; opacity: 0.1;"></i>
                <h6 class="text-uppercase small fw-semibold mb-3 text-white-50" style="letter-spacing: 1px;">CA (Livré)</h6>
                <h2 class="display-5 mb-0 fw-bold text-white" style="font-family: var(--font-display);"><?= number_format($caLivre, 2) ?> €</h2>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Navigation rapide -->
        <div class="col-lg-4 mb-4">
            <div class="card-marco p-4 h-100">
                <h5 class="mb-4 text-uppercase fw-semibold small text-muted" style="letter-spacing: 1px;"><i class="bi bi-grid-1x2 me-2"></i>Gestion Rapide</h5>
                <div class="d-flex flex-column gap-2">
                    <a href="<?= BASE_URL ?>?action=plats_admin" class="btn btn-outline-dark text-start py-3 rounded-3"><i class="bi bi-cup-hot me-3 text-dore"></i>Plats</a>
                    <a href="<?= BASE_URL ?>?action=categories" class="btn btn-outline-dark text-start py-3 rounded-3"><i class="bi bi-tags me-3 text-dore"></i>Catégories</a>
                    <a href="<?= BASE_URL ?>?action=menus" class="btn btn-outline-dark text-start py-3 rounded-3"><i class="bi bi-list-stars me-3 text-dore"></i>Menus</a>
                    <a href="<?= BASE_URL ?>?action=admin_commandes" class="btn btn-outline-dark text-start py-3 rounded-3"><i class="bi bi-receipt me-3 text-dore"></i>Commandes</a>
                    <a href="<?= BASE_URL ?>?action=admin_users" class="btn btn-outline-dark text-start py-3 rounded-3"><i class="bi bi-people me-3 text-dore"></i>Utilisateurs</a>
                </div>
            </div>
        </div>

        <!-- 5 dernieres commandes -->
        <div class="col-lg-8 mb-4">
            <div class="card-marco p-0 overflow-hidden h-100">
                <div class="p-4 border-bottom">
                    <h5 class="mb-0 text-uppercase fw-semibold small text-muted" style="letter-spacing: 1px;"><i class="bi bi-clock-history me-2"></i>Dernières commandes</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 px-4 fw-semibold text-muted small text-uppercase border-0">N°</th>
                                <th class="py-3 px-4 fw-semibold text-muted small text-uppercase border-0">Client</th>
                                <th class="py-3 px-4 fw-semibold text-muted small text-uppercase border-0">Date</th>
                                <th class="py-3 px-4 fw-semibold text-muted small text-uppercase border-0">Total</th>
                                <th class="py-3 px-4 fw-semibold text-muted small text-uppercase border-0">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dernieres as $cmd): ?>
                            <tr>
                                <td class="px-4 py-3 fw-medium">
                                    <a href="<?= BASE_URL ?>?action=commande_show&id=<?= $cmd['id'] ?>" class="text-decoration-none text-dark">#<?= str_pad($cmd['id'], 5, '0', STR_PAD_LEFT) ?></a>
                                </td>
                                <td class="px-4 py-3 fw-medium"><?= htmlspecialchars($cmd['user_prenom'] . ' ' . $cmd['user_nom']) ?></td>
                                <td class="px-4 py-3 text-muted small"><?= date('d/m/Y H:i', strtotime($cmd['created_at'])) ?></td>
                                <td class="px-4 py-3 fw-bold"><?= number_format($cmd['total'], 2) ?> €</td>
                                <td class="px-4 py-3">
                                    <?php
                                    $badges = ['en_attente' => 'bg-warning text-dark', 'confirmee' => 'bg-info text-dark',
                                               'livree' => 'bg-success', 'annulee' => 'bg-danger'];
                                    ?>
                                    <span class="badge rounded-pill <?= $badges[$cmd['statut']] ?? 'bg-secondary' ?> px-3 py-2 fw-normal">
                                        <?= ucfirst(str_replace('_', ' ', htmlspecialchars($cmd['statut']))) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layout/footer.php'; ?>
