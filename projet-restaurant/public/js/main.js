// Confirmation avant suppression (utilisé sur tous les boutons .btn-delete)
document.addEventListener('click', e => {
    const btn = e.target.closest('.btn-delete');
    if (!btn) return;
    e.preventDefault();
    if (confirm('Confirmer la suppression ?')) {
        window.location.href = btn.dataset.href;
    }
});

// Filtre dynamique par categorie (page catalogue)
document.addEventListener('click', e => {
    const btn = e.target.closest('#filter-buttons button');
    if (!btn) return;

    // Mettre a jour l'etat actif des boutons
    document.querySelectorAll('#filter-buttons button').forEach(b => {
        b.classList.remove('btn-dark', 'active');
        b.classList.add('btn-outline-dark');
    });
    btn.classList.add('btn-dark', 'active');
    btn.classList.remove('btn-outline-dark');

    const filter = btn.dataset.filter;

    // Afficher / masquer les cartes
    document.querySelectorAll('.plat-card').forEach(card => {
        const match = filter === 'all' || card.dataset.cat === filter;
        card.style.display = match ? '' : 'none';
    });
});
