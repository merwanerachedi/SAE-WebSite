<?php require 'views/layout/header.php'; ?>

<h2 class="mb-4">Dashboard</h2>

<!-- Cartes KPI -->
<div class="row row-cols-1 row-cols-md-4 g-3 mb-5">
    <div class="col">
        <div class="card text-white bg-dark shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">Commandes</h6>
                <h3 class="card-title mb-0"><?= $nbCommandes ?></h3>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white shadow-sm" style="background-color: var(--marco-rouge)">
            <div class="card-body">
                <h6 class="card-subtitle mb-2" style="opacity:.7">Clients</h6>
                <h3 class="card-title mb-0"><?= $nbClients ?></h3>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card shadow-sm" style="background-color: var(--marco-dore); color: #1a1a1a">
            <div class="card-body">
                <h6 class="card-subtitle mb-2" style="opacity:.7">Plats disponibles</h6>
                <h3 class="card-title mb-0"><?= $nbPlats ?></h3>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <h6 class="card-subtitle mb-2" style="opacity:.7">CA (livrees)</h6>
                <h3 class="card-title mb-0"><?= number_format($caLivre, 2) ?> €</h3>
            </div>
        </div>
    </div>
</div>

<!-- Navigation rapide -->
<h4 class="mb-3">Gestion</h4>
<div class="row row-cols-2 row-cols-md-5 g-3 mb-5">
    <div class="col">
        <a href="<?= BASE_URL ?>?action=plats_admin" class="btn btn-outline-dark w-100">Plats</a>
    </div>
    <div class="col">
        <a href="<?= BASE_URL ?>?action=categories" class="btn btn-outline-dark w-100">Categories</a>
    </div>
    <div class="col">
        <a href="<?= BASE_URL ?>?action=menus" class="btn btn-outline-dark w-100">Menus</a>
    </div>
    <div class="col">
        <a href="<?= BASE_URL ?>?action=admin_commandes" class="btn btn-outline-dark w-100">Commandes</a>
    </div>
    <div class="col">
        <a href="<?= BASE_URL ?>?action=admin_users" class="btn btn-outline-dark w-100">Utilisateurs</a>
    </div>
</div>

<!-- 5 dernieres commandes -->
<h4 class="mb-3">Dernieres commandes</h4>
<table class="table table-striped table-hover">
    <thead class="table-dark">
        <tr><th>#</th><th>Client</th><th>Date</th><th>Total</th><th>Statut</th></tr>
    </thead>
    <tbody>
    <?php foreach ($dernieres as $cmd): ?>
        <tr>
            <td>
                <a href="<?= BASE_URL ?>?action=commande_show&id=<?= $cmd['id'] ?>"><?= $cmd['id'] ?></a>
            </td>
            <td><?= htmlspecialchars($cmd['user_prenom'] . ' ' . $cmd['user_nom']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($cmd['created_at'])) ?></td>
            <td><?= number_format($cmd['total'], 2) ?> €</td>
            <td>
                <?php
                $badges = ['en_attente' => 'bg-warning text-dark', 'confirmee' => 'bg-primary',
                           'livree' => 'bg-success', 'annulee' => 'bg-danger'];
                ?>
                <span class="badge <?= $badges[$cmd['statut']] ?? 'bg-secondary' ?>">
                    <?= htmlspecialchars($cmd['statut']) ?>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require 'views/layout/footer.php'; ?>
