// Confirmation avant suppression (utilisé sur tous les boutons .btn-delete)
document.addEventListener('click', e => {
    const btn = e.target.closest('.btn-delete');
    if (!btn) return;
    e.preventDefault();
    if (confirm('Confirmer la suppression ?')) {
        window.location.href = btn.dataset.href;
    }
});
