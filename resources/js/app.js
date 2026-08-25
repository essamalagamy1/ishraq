import './bootstrap';
import {
    initLenis,
    initReveals,
    initCountUps,
    initParallax,
    initEmbla,
    initMagneticHover,
    initAccordion,
    initHeroHalo,
    init3DCards,
    initProcessCards,
    initStatsFlip,
} from './motion.js';
import { initNav } from './nav.js';
import { initGallery } from './gallery.js';

const boot = () => {
    initLenis();
    initNav();

    initReveals();
    initCountUps();
    initParallax();

    // Hero interactions
    const heroSection = document.querySelector('[data-hero-section]');
    if (heroSection) {
        initHeroHalo(heroSection);
    }

    // 3D tilt on featured project cards
    init3DCards();

    // Magnetic hover on primary CTAs + arrow buttons
    initMagneticHover();

    // Process section scroll-driven card animations
    const processSection = document.querySelector('[data-process-section]');
    if (processSection) {
        initProcessCards(processSection);
    }

    // Stats 3D flip effect
    initStatsFlip();

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
