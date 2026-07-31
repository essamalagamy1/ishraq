export function initNav() {
    const nav = document.querySelector('[data-site-nav]');
    if (!nav) return;

    const toggle = nav.querySelector('[data-menu-toggle]');
    const overlay = document.querySelector('[data-nav-overlay]');
    if (!toggle || !overlay) return;

    const open = () => {
        overlay.classList.add('is-open');
        toggle.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    };
    const close = () => {
        overlay.classList.remove('is-open');
        toggle.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    };

    toggle.addEventListener('click', () => {
        if (overlay.classList.contains('is-open')) close(); else open();
    });

    overlay.addEventListener('click', (e) => {
        if (e.target.closest('a')) close();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && overlay.classList.contains('is-open')) close();
    });

}
