<?php require 'views/layout/header.php'; ?>

<div class="container mt-4">
    <h2>Mon Profil</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Profil mis à jour avec succès.</div>
    <?php endif; ?>

    <div class="row mt-4">
        <!-- Informations du compte (Users) - Lecture Seule -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Informations du compte (lecture seule)</h5>
                </div>
                <div class="card-body">
                    <p><strong>Prénom :</strong> <?= htmlspecialchars($profil['prenom'] ?? '') ?></p>
                    <p><strong>Nom :</strong> <?= htmlspecialchars($profil['nom'] ?? '') ?></p>
                    <p><strong>Email :</strong> <?= htmlspecialchars($profil['email'] ?? '') ?></p>
                    <p><strong>Rôle :</strong> <span class="badge bg-secondary"><?= htmlspecialchars($profil['role'] ?? 'client') ?></span></p>
                    <p><strong>Membre depuis le :</strong> <?= date('d/m/Y', strtotime($profil['created_at'])) ?></p>
                </div>
            </div>
        </div>

        <!-- Informations complémentaires (Profils) - Modifiables -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Informations complémentaires</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= BASE_URL ?>?action=profil_update">
                        <div class="mb-3">
                            <label class="form-label" for="telephone">Téléphone</label>
                            <input type="text" id="telephone" name="telephone" class="form-control" value="<?= htmlspecialchars($profil['telephone'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="adresse">Adresse</label>
                            <textarea id="adresse" name="adresse" class="form-control" rows="3"><?= htmlspecialchars($profil['adresse'] ?? '') ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="date_naissance">Date de naissance</label>
                            <input type="date" id="date_naissance" name="date_naissance" class="form-control" value="<?= htmlspecialchars($profil['date_naissance'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/layout/footer.php'; ?>
