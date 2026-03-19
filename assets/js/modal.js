
const Modal = {
    abrir(id) {
        const modal = document.getElementById('customModal' + id);
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    },

    fechar(id) {
        const modal = document.getElementById('customModal' + id);
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
};

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('custom-modal')) {
        e.target.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.custom-modal[style*="block"]').forEach(modal => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
});