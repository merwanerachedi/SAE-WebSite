<?php require 'views/layout/header.php'; ?>

<div class="container my-5">
    <div class="d-flex align-items-center mb-5">
        <div class="bg-dore text-white rounded-circle d-flex align-items-center justify-content-center me-4 shadow-sm" style="width: 80px; height: 80px; font-size: 2rem; font-family: var(--font-display);">
            <?= strtoupper(substr($profil['prenom'] ?? 'C', 0, 1) . substr($profil['nom'] ?? 'C', 0, 1)) ?>
        </div>
        <div>
            <h2 class="mb-1" style="font-family: var(--font-display);">Mon Profil</h2>
            <p class="text-muted mb-0">Gérez vos informations personnelles</p>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success shadow-sm border-0 mb-4"><i class="bi bi-check-circle me-2"></i>Profil mis à jour avec succès.</div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Informations du compte (Users) - Lecture Seule -->
        <div class="col-md-5 mb-4">
            <div class="card-marco h-100 p-4">
                <h5 class="mb-4 text-uppercase fw-semibold small text-muted" style="letter-spacing: 1px;"><i class="bi bi-person-badge me-2"></i>Informations du compte</h5>
                <div class="d-flex flex-column gap-3">
                    <div>
                        <span class="text-muted small d-block">Prénom</span>
                        <span class="fw-medium"><?= htmlspecialchars($profil['prenom'] ?? '') ?></span>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Nom</span>
                        <span class="fw-medium"><?= htmlspecialchars($profil['nom'] ?? '') ?></span>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Email</span>
                        <span class="fw-medium"><?= htmlspecialchars($profil['email'] ?? '') ?></span>
                    </div>
                    <div>
                        <span class="text-muted small d-block">Rôle</span>
                        <span class="badge bg-dark rounded-pill px-3 py-2 fw-normal mt-1"><?= htmlspecialchars(ucfirst($profil['role'] ?? 'Client')) ?></span>
                    </div>
                    <div class="pt-3 mt-1 border-top" style="border-color: var(--color-gris-clair) !important;">
                        <span class="text-muted small"><i class="bi bi-calendar3 me-2"></i>Membre depuis le <?= date('d/m/Y', strtotime($profil['created_at'])) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations complémentaires (Profils) - Modifiables -->
        <div class="col-md-7 mb-4">
            <div class="card-marco h-100 p-4">
                <h5 class="mb-4 text-uppercase fw-semibold small text-muted" style="letter-spacing: 1px;"><i class="bi bi-journal-text me-2"></i>Informations complémentaires</h5>
                <form method="POST" action="<?= BASE_URL ?>?action=profil_update">
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;" for="telephone">Téléphone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" id="telephone" name="telephone" class="form-control" value="<?= htmlspecialchars($profil['telephone'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;" for="adresse">Adresse de livraison par défaut</label>
                        <div class="input-group">
                            <span class="input-group-text align-items-start pt-2"><i class="bi bi-geo-alt"></i></span>
                            <textarea id="adresse" name="adresse" class="form-control" rows="3"><?= htmlspecialchars($profil['adresse'] ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-semibold text-uppercase" style="letter-spacing: 0.5px;" for="date_naissance">Date de naissance</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                            <input type="date" id="date_naissance" name="date_naissance" class="form-control" value="<?= htmlspecialchars($profil['date_naissance'] ?? '') ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-marco px-4 rounded-pill">Mettre à jour mon profil</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layout/footer.php'; ?>
