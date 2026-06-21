</div><!-- /container -->

<footer class="footer-marco">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4 text-center text-md-start">
                <h5 class="footer-title">Chez Marco</h5>
                <p class="text-muted small">L'authentique goût de l'Italie en plein cœur de la ville. Des produits frais, une ambiance chaleureuse et la passion de la vraie cuisine.</p>
            </div>
            <div class="col-md-4 text-center">
                <h5 class="footer-title">Liens rapides</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= BASE_URL ?>?action=home">Accueil</a></li>
                    <li><a href="<?= BASE_URL ?>?action=plats">Notre Carte</a></li>
                    <li><a href="<?= BASE_URL ?>?action=login">Espace Client</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <h5 class="footer-title">Horaires</h5>
                <ul class="list-unstyled text-muted small">
                    <li>Lun - Jeu : 12h00 - 14h30 / 19h00 - 22h30</li>
                    <li>Ven - Sam : 12h00 - 15h00 / 19h00 - 23h30</li>
                    <li>Dimanche : Fermé</li>
                </ul>
            </div>
        </div>
        <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">
        <div class="text-center text-muted small">
            &copy; <?= date('Y') ?> Chez Marco — Tous droits réservés
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>public/js/main.js"></script>
<?php if (isset($extraJs)): ?>
    <script src="<?= BASE_URL ?><?= $extraJs ?>"></script>
<?php endif; ?>
</body>
</html>
