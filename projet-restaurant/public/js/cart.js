// Panier cote client
const cart = {
    items: [],

    add(id, nom, prix) {
        const existing = this.items.find(i => i.id === id);
        if (existing) {
            existing.quantite++;
        } else {
            this.items.push({ id, nom, prix: parseFloat(prix), quantite: 1 });
        }
        this.render();
    },

    remove(id) {
        this.items = this.items.filter(i => i.id !== id);
        this.render();
    },

    total() {
        return this.items.reduce((sum, i) => sum + i.prix * i.quantite, 0).toFixed(2);
    },

    count() {
        return this.items.reduce((n, i) => n + i.quantite, 0);
    },

    render() {
        const container = document.getElementById('cart-items');
        const totalEl   = document.getElementById('cart-total');
        const badge     = document.getElementById('cart-badge');
        const submitBtn = document.getElementById('btn-submit-cart');
        if (!container) return;

        if (this.items.length === 0) {
            container.innerHTML = '<p class="text-muted small">Votre panier est vide.</p>';
        } else {
            container.innerHTML = this.items.map(item => `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <span class="fw-semibold">${item.nom}</span><br>
                        <small class="text-muted">x${item.quantite} — ${(item.prix * item.quantite).toFixed(2)} €</small>
                    </div>
                    <button class="btn btn-sm btn-outline-danger py-0"
                            onclick="cart.remove(${item.id})">x</button>
                </div>
            `).join('');
        }

        if (totalEl)   totalEl.textContent  = this.total() + ' €';
        if (badge)     badge.textContent    = this.count();
        if (submitBtn) submitBtn.disabled   = this.items.length === 0;
    },

    // Envoi de la commande au serveur
    async submit() {
        if (this.items.length === 0) return;

        const btn = document.getElementById('btn-submit-cart');
        btn.disabled    = true;
        btn.textContent = 'Envoi en cours...';

        try {
            const res = await fetch(BASE_URL + '?action=commande_store', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify(this.items)
            });
            const data = await res.json();

            if (data.success) {
                this.items = [];
                this.render();
                window.location.href = BASE_URL + '?action=commande_show&id=' + data.commande_id;
            } else {
                alert('Erreur : ' + (data.error ?? 'Inconnue'));
                btn.disabled    = false;
                btn.textContent = 'Commander';
            }
        } catch (err) {
            alert('Erreur reseau. Veuillez reessayer.');
            btn.disabled    = false;
            btn.textContent = 'Commander';
        }
    }
};

// Initialisation
document.addEventListener('DOMContentLoaded', () => {
    cart.render();

    // Boutons "Ajouter au panier"
    document.querySelectorAll('.btn-add-cart').forEach(btn => {
        btn.addEventListener('click', () => {
            cart.add(
                parseInt(btn.dataset.id),
                btn.dataset.nom,
                parseFloat(btn.dataset.prix)
            );
            // Retour visuel temporaire
            const original = btn.textContent;
            btn.textContent = 'Ajoute';
            btn.classList.add('btn-success');
            btn.classList.remove('btn-dark');
            setTimeout(() => {
                btn.textContent = original;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-dark');
            }, 1200);
        });
    });

    // Bouton Commander
    const submitBtn = document.getElementById('btn-submit-cart');
    if (submitBtn) submitBtn.addEventListener('click', () => cart.submit());
});
