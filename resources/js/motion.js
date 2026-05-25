import Lenis from 'lenis';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

let lenis = null;

export function initLenis() {
    if (reduced) {
        document.documentElement.classList.add('is-ready');
        return null;
    }

    lenis = new Lenis({
        duration: 1.15,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true,
        wheelMultiplier: 0.95,
        touchMultiplier: 1.4,
        infinite: false,
    });

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);

    requestAnimationFrame(() => document.documentElement.classList.add('is-ready'));

    return lenis;
}

export function scrollTo(target, options = {}) {
    if (!lenis) return;
    lenis.scrollTo(target, { offset: -80, duration: 1.2, ...options });
}

/* ----------------------------------------------------------------
   Reveals — simple opacity/translate fade for [data-reveal] elements.
   Uses IntersectionObserver so it works without GSAP for cheap reveals.
   ---------------------------------------------------------------- */

export function initReveals(root = document) {
    if (reduced) {
        root.querySelectorAll('[data-reveal], [data-reveal-line]').forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const el = entry.target;
                const stagger = parseInt(el.dataset.revealStagger || '0', 10);
                if (stagger) el.style.setProperty('--reveal-delay', `${stagger}ms`);
                requestAnimationFrame(() => el.classList.add('is-revealed'));
                io.unobserve(el);
            });
        },
        { threshold: 0.15, rootMargin: '0px 0px -8% 0px' }
    );

    root.querySelectorAll('[data-reveal], [data-reveal-line]').forEach((el) => io.observe(el));
}

/* ----------------------------------------------------------------
   Line splitting — wraps each word/line in spans for staggered reveals.
   Pass the element a `data-split-lines` attribute and call this once.
   ---------------------------------------------------------------- */

export function splitLines(el) {
    if (!el || el.dataset.splitDone) return;
    const text = el.textContent.trim();
    const words = text.split(/(\s+)/);
    el.innerHTML = '';
    el.setAttribute('data-reveal-line', '');
    words.forEach((w) => {
        if (/^\s+$/.test(w)) {
            el.appendChild(document.createTextNode(' '));
            return;
        }
        const outer = document.createElement('span');
        const inner = document.createElement('span');
        inner.textContent = w;
        outer.appendChild(inner);
        el.appendChild(outer);
    });
    el.dataset.splitDone = '1';
}

/* ----------------------------------------------------------------
   Hero halo — radial light that follows the cursor with damping.
   ---------------------------------------------------------------- */

export function initHeroHalo(container) {
    if (!container || reduced) return;

    const halo = container.querySelector('.hero-halo');
    if (!halo) return;

    const xTo = gsap.quickTo(halo, '--halo-x', { duration: 0.9, ease: 'power2.out' });
    const yTo = gsap.quickTo(halo, '--halo-y', { duration: 0.9, ease: 'power2.out' });

    const onMove = (e) => {
        const r = container.getBoundingClientRect();
        const x = ((e.clientX - r.left) / r.width) * 100;
        const y = ((e.clientY - r.top) / r.height) * 100;
        xTo(`${x}%`);
        yTo(`${y}%`);
    };

    container.addEventListener('pointermove', onMove);
    container.addEventListener('pointerleave', () => {
        xTo('50%');
        yTo('50%');
    });
}

/* ----------------------------------------------------------------
   Hero pinning — keeps the hero in view for a cinematic handoff.
   ---------------------------------------------------------------- */

export function initHeroPin(section) {
    if (!section || reduced) return;

    const title = section.querySelector('[data-hero-title]') || section.querySelector('h1');
    ScrollTrigger.create({
        trigger: section,
        start: 'top top',
        end: '+=150%',
        pin: true,
        scrub: true,
        anticipatePin: 1,
        onUpdate: (self) => {
            if (!title) return;
            const scale = 1 - self.progress * 0.05;
            title.style.transform = `translateY(${self.progress * -18}px) scale(${scale})`;
        },
    });
}

/* ----------------------------------------------------------------
   Count-up — animates a number to its target on scroll-in.
   Reads target from `data-count` attribute.
   ---------------------------------------------------------------- */

export function initCountUps(root = document) {
    const targets = root.querySelectorAll('[data-count]');
    targets.forEach((el) => {
        const end = parseFloat(el.dataset.count);
        if (isNaN(end)) return;
        const fmt = el.dataset.countFormat || '';
        const decimals = parseInt(el.dataset.countDecimals || '0', 10);

        if (reduced) {
            el.textContent = end.toLocaleString('ar-EG', { maximumFractionDigits: decimals, minimumFractionDigits: decimals }) + fmt;
            return;
        }

        const obj = { v: 0 };
        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                gsap.to(obj, {
                    v: end,
                    duration: 2.2,
                    ease: 'power2.out',
                    onUpdate: () => {
                        el.textContent = obj.v.toLocaleString('ar-EG', { maximumFractionDigits: decimals, minimumFractionDigits: decimals }) + fmt;
                    },
                });
            },
        });
    });
}

/* ----------------------------------------------------------------
   Process timeline — fills the rail as the timeline scrolls past.
   ---------------------------------------------------------------- */

export function initProcessRail(section) {
    if (!section) return;
    const rail = section.querySelector('.process__rail');
    if (!rail) return;

    ScrollTrigger.create({
        trigger: section,
        start: 'top 70%',
        end: 'bottom 60%',
        scrub: 0.4,
        onUpdate: (self) => {
            section.style.setProperty('--rail-progress', `${(self.progress * 100).toFixed(2)}%`);
        },
    });
}

/* ----------------------------------------------------------------
   Services scrollytelling — pins the section, swaps the active panel
   based on which row is centered.
   ---------------------------------------------------------------- */

export function initServicesScroller(section) {
    if (!section || reduced) return;

    const rows = Array.from(section.querySelectorAll('.svc-row'));
    const panels = Array.from(section.querySelectorAll('.svc-panel'));
    if (rows.length === 0 || rows.length !== panels.length) return;

    const setActive = (index) => {
        rows.forEach((r, i) => r.setAttribute('aria-selected', i === index ? 'true' : 'false'));
        panels.forEach((p, i) => p.classList.toggle('is-active', i === index));
    };

    setActive(0);

    const isDesktop = window.matchMedia('(min-width: 900px)').matches;
    if (!isDesktop) return;

    const total = rows.length;
    ScrollTrigger.create({
        trigger: section,
        start: 'top top',
        end: () => `+=${total * 70}%`,
        pin: true,
        scrub: 0.3,
        invalidateOnRefresh: true,
        onUpdate: (self) => {
            const idx = Math.min(total - 1, Math.floor(self.progress * total));
            setActive(idx);
        },
    });
}

/* ----------------------------------------------------------------
   Parallax — moves an element vertically with the scroll.
   ---------------------------------------------------------------- */

export function initParallax(root = document) {
    if (reduced) return;
    root.querySelectorAll('[data-parallax]').forEach((el) => {
        const depth = parseFloat(el.dataset.parallax) || 0.15;
        gsap.fromTo(el,
            { y: `-${depth * 100}px` },
            {
                y: `${depth * 100}px`,
                ease: 'none',
                scrollTrigger: {
                    trigger: el,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true,
                },
            }
        );
    });
}

/* ----------------------------------------------------------------
   Magnetic hover — subtle cursor pull for primary CTAs.
   ---------------------------------------------------------------- */

export function initMagneticHover(selector = '.btn--primary') {
    if (reduced) return;
    const targets = document.querySelectorAll(selector);
    targets.forEach((el) => {
        const strength = 6;
        const onMove = (e) => {
            const rect = el.getBoundingClientRect();
            const relX = e.clientX - rect.left - rect.width / 2;
            const relY = e.clientY - rect.top - rect.height / 2;
            gsap.to(el, {
                x: Math.max(-strength, Math.min(strength, relX * 0.08)),
                y: Math.max(-strength, Math.min(strength, relY * 0.08)),
                duration: 0.3,
                ease: 'power2.out',
            });
        };
        const reset = () => gsap.to(el, { x: 0, y: 0, duration: 0.4, ease: 'power2.out' });
        el.addEventListener('pointermove', onMove);
        el.addEventListener('pointerleave', reset);
    });
}

/* ----------------------------------------------------------------
   Embla carousel wrapper — sets up testimonials.
   ---------------------------------------------------------------- */

export async function initEmbla(root) {
    if (!root) return;
    const viewport = root.querySelector('[data-embla-viewport]');
    if (!viewport) return;

    const { default: EmblaCarousel } = await import('embla-carousel');
    const embla = EmblaCarousel(viewport, {
        loop: true,
        align: 'center',
        direction: document.documentElement.dir === 'rtl' ? 'rtl' : 'ltr',
        duration: 30,
    });

    const prev = root.querySelector('[data-embla-prev]');
    const next = root.querySelector('[data-embla-next]');
    const dotsContainer = root.querySelector('[data-embla-dots]');

    if (prev) prev.addEventListener('click', () => embla.scrollPrev());
    if (next) next.addEventListener('click', () => embla.scrollNext());

    const slides = embla.slideNodes();
    let dots = [];
    if (dotsContainer) {
        dotsContainer.innerHTML = '';
        dots = slides.map((_, i) => {
            const b = document.createElement('button');
            b.type = 'button';
            b.className = 'embla__dot';
            b.setAttribute('aria-label', `الذهاب إلى الشهادة ${i + 1}`);
            b.addEventListener('click', () => embla.scrollTo(i));
            dotsContainer.appendChild(b);
            return b;
        });
    }

    const updateDots = () => {
        const selected = embla.selectedScrollSnap();
        dots.forEach((d, i) => d.classList.toggle('is-active', i === selected));
    };
    embla.on('select', updateDots);
    embla.on('init', updateDots);
    updateDots();
}
