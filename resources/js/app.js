import './bootstrap';
import {
    initLenis,
    initReveals,
    initCountUps,
    initParallax,
    initEmbla,
    initMagneticHover,
    initAccordion,
} from './motion.js';
import { initNav } from './nav.js';
import { initGallery } from './gallery.js';

const boot = () => {
    initLenis();
    initNav();

    initReveals();
    initCountUps();
    initParallax();
    initMagneticHover();

    // Accordion (services)
    initAccordion();

    // Project Gallery
    initGallery();

    // Carousel (if used on other pages)
    document.querySelectorAll('[data-embla-root]').forEach((root) => initEmbla(root));
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}
