import './bootstrap';
import {
    initLenis,
    initReveals,
    initHeroHalo,
    initHeroPin,
    initCountUps,
    initProcessRail,
    initServicesScroller,
    initParallax,
    initEmbla,
    initMagneticHover,
    splitLines,
} from './motion.js';
import { initNav } from './nav.js';

const boot = () => {
    initLenis();
    initNav();

    document.querySelectorAll('[data-split-lines]').forEach(splitLines);

    initReveals();
    initCountUps();
    initParallax();
    initMagneticHover();

    initHeroHalo(document.querySelector('[data-hero]'));
    initHeroPin(document.querySelector('[data-hero-pin]'));
    initProcessRail(document.querySelector('[data-process]'));
    initServicesScroller(document.querySelector('[data-services-scroller]'));

    document.querySelectorAll('[data-embla-root]').forEach((root) => initEmbla(root));
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    boot();
}
