import 'bootstrap';

const navbar = document.querySelector('[data-nala-navbar]');
const navbarCollapse = document.querySelector('#nalaNavbar');

const updateNavbar = () => {
    if (!navbar) {
        return;
    }

    navbar.classList.toggle('is-scrolled', window.scrollY > 24);
};

document.querySelectorAll('a[href^="#"]').forEach((link) => {
    link.addEventListener('click', (event) => {
        const targetId = link.getAttribute('href');

        if (!targetId || targetId === '#') {
            return;
        }

        const target = document.querySelector(targetId);

        if (!target) {
            return;
        }

        event.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });

        if (navbarCollapse && navbarCollapse.classList.contains('show')) {
            window.bootstrap.Collapse.getOrCreateInstance(navbarCollapse).hide();
        }
    });
});

const revealObserver = 'IntersectionObserver' in window
    ? new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.12 })
    : null;

document.querySelectorAll('[data-reveal]').forEach((element) => {
    if (revealObserver) {
        revealObserver.observe(element);
    } else {
        element.classList.add('is-visible');
    }
});

document.querySelectorAll('[data-password-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        const input = document.querySelector(button.dataset.passwordToggle);
        if (!input) {
            return;
        }

        input.type = input.type === 'password' ? 'text' : 'password';
        button.setAttribute('aria-label', input.type === 'password' ? 'Tampilkan password' : 'Sembunyikan password');
    });
});

document.querySelectorAll('[data-partnership-form]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const data = new FormData(form);
        const phone = (form.dataset.whatsapp || '').replace(/\D/g, '');
        const message = [
            'Halo Nala Coffee, saya ingin menjadi mitra.',
            `Nama: ${data.get('name')}`,
            `Kota: ${data.get('city')}`,
            `Jenis mitra: ${data.get('type')}`,
            `Produk: ${data.get('product')}`,
            `Pesan: ${data.get('message') || '-'}`,
        ].join('\n');

        if (phone) {
            window.open(`https://wa.me/${phone}?text=${encodeURIComponent(message)}`, '_blank', 'noopener,noreferrer');
        }
    });
});

updateNavbar();
window.addEventListener('scroll', updateNavbar, { passive: true });
