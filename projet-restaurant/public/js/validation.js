document.addEventListener('DOMContentLoaded', () => {
    // Validation Bootstrap HTML5 generique
    document.querySelectorAll('form[novalidate]').forEach(form => {
        form.addEventListener('submit', e => {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Verification confirmation mot de passe
    const pwd     = document.getElementById('regPassword');
    const confirm = document.getElementById('regConfirm');
    if (pwd && confirm) {
        confirm.addEventListener('input', () => {
            confirm.setCustomValidity(
                pwd.value !== confirm.value ? 'Les mots de passe ne correspondent pas.' : ''
            );
        });
    }
});
