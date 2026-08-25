/**
 * motion.js — Ishraq animation engine
 * Powered by Motion (motiondivision/motion) — replaces GSAP
 */

import Lenis from 'lenis';
import { animate, scroll, inView, stagger, spring } from 'motion';

const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

let lenis = null;

/* ----------------------------------------------------------------
   Lenis smooth scroll
   ---------------------------------------------------------------- */

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

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    requestAnimationFrame(() => document.documentElement.classList.add('is-ready'));

    return lenis;
}

export function scrollTo(target, options = {}) {
    if (!lenis) return;
    lenis.scrollTo(target, { offset: -80, duration: 1.2, ...options });
}

/* ----------------------------------------------------------------
   Reveals — animate elements on scroll into view using Motion inView
   ---------------------------------------------------------------- */

export function initReveals(root = document) {
    if (reduced) {
        root.querySelectorAll('[data-reveal], [data-reveal-line]').forEach((el) => el.classList.add('is-revealed'));
        return;
    }

    const revealElements = root.querySelectorAll('[data-reveal]');
    revealElements.forEach((el) => {
        inView(el, () => {
            const staggerMs = parseInt(el.dataset.revealStagger || '0', 10);
            const delayS = staggerMs / 1000;

            animate(el, { opacity: [0, 1], y: [30, 0] }, {
                duration: 0.8,
                delay: delayS,
                easing: [0.22, 1, 0.36, 1],
            });
            el.classList.add('is-revealed');
        }, { margin: '0px 0px -8% 0px' });
    });

    // Line reveals
    root.querySelectorAll('[data-reveal-line]').forEach((el) => {
        inView(el, () => {
            const innerSpans = el.querySelectorAll(':scope > span > span');
            if (innerSpans.length > 0) {
                animate(innerSpans, { y: ['110%', '0%'] }, {
                    duration: 0.9,
                    delay: stagger(0.06),
                    easing: [0.22, 1, 0.36, 1],
                });
            }
            el.classList.add('is-revealed');
        }, { margin: '0px 0px -8% 0px' });
    });
}

/* ----------------------------------------------------------------
   Line splitting — wraps each word in spans for staggered reveals
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
   Hero halo — radial light following cursor with spring damping
   ---------------------------------------------------------------- */

export function initHeroHalo(container) {
    if (!container || reduced) return;

    // The halo element uses CSS custom props for position
    let currentX = 55, currentY = 40;
    let targetX  = 55, targetY  = 40;
    let rafId    = null;

    const lerp = (a, b, t) => a + (b - a) * t;

    const tick = () => {
        currentX = lerp(currentX, targetX, 0.07);
        currentY = lerp(currentY, targetY, 0.07);
        container.style.setProperty('--halo-x', `${currentX.toFixed(2)}%`);
        container.style.setProperty('--halo-y', `${currentY.toFixed(2)}%`);
        rafId = requestAnimationFrame(tick);
    };

    const onMove = (e) => {
        const r = container.getBoundingClientRect();
        const x = ((e.clientX - r.left) / r.width)  * 100;
        const y = ((e.clientY - r.top)  / r.height) * 100;
        targetX = Math.max(0, Math.min(100, x));
        targetY = Math.max(0, Math.min(100, y));
    };

    const onLeave = () => { targetX = 55; targetY = 40; };

    container.addEventListener('pointermove', onMove, { passive: true });
    container.addEventListener('pointerleave', onLeave);

    rafId = requestAnimationFrame(tick);

    // Clean up when the element leaves the DOM (optional safety)
    return () => {
        cancelAnimationFrame(rafId);
        container.removeEventListener('pointermove', onMove);
        container.removeEventListener('pointerleave', onLeave);
    };
}

/* ----------------------------------------------------------------
   Hero pinning — scroll-linked scale/fade for hero
   ---------------------------------------------------------------- */

export function initHeroPin(section) {
    if (!section || reduced) return;

    const title = section.querySelector('[data-hero-title]') || section.querySelector('h1');
    const content = section.querySelector('.hero-content');

    scroll(
        ({ y }) => {
            const progress = y.progress;
            if (title) {
                const s = 1 - progress * 0.08;
                const ty = progress * -30;
                const op = 1 - progress * 1.5;
                title.style.transform = `translateY(${ty}px) scale(${s})`;
                title.style.opacity = Math.max(0, op);
            }
            if (content) {
                content.style.opacity = Math.max(0, 1 - progress * 2);
            }
        },
        {
            target: section,
            offset: ['start start', 'end start'],
        }
    );
}

/* ----------------------------------------------------------------
   Count-up — animates numbers on scroll using Motion
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

        inView(el, () => {
            animate(0, end, {
                duration: 2.2,
                easing: [0.22, 1, 0.36, 1],
                onUpdate: (v) => {
                    el.textContent = v.toLocaleString('ar-EG', {
                        maximumFractionDigits: decimals,
                        minimumFractionDigits: decimals,
                    }) + fmt;
                },
            });
        }, { margin: '0px 0px -15% 0px' });
    });
}

/* ----------------------------------------------------------------
   Process timeline — SVG path drawing with scroll
   ---------------------------------------------------------------- */

export function initProcessRail(section) {
    if (!section) return;
    const rail = section.querySelector('.process__rail');
    if (!rail) return;

    scroll(
        ({ y }) => {
            section.style.setProperty('--rail-progress', `${(y.progress * 100).toFixed(2)}%`);
        },
        {
            target: section,
            offset: ['start 70%', 'end 60%'],
        }
    );
}

/* ----------------------------------------------------------------
   Services — interactive card switching with Motion animations
   ---------------------------------------------------------------- */

export function initServicesScroller(section) {
    if (!section || reduced) return;

    const rows = Array.from(section.querySelectorAll('.svc-row'));
    const panels = Array.from(section.querySelectorAll('.svc-panel'));
    if (rows.length === 0 || rows.length !== panels.length) return;

    let activeIndex = 0;

    const setActive = (index) => {
        if (index === activeIndex && panels[index].classList.contains('is-active')) return;

        rows.forEach((r, i) => r.setAttribute('aria-selected', i === index ? 'true' : 'false'));

        // Animate out current
        const currentPanel = panels[activeIndex];
        const nextPanel = panels[index];

        if (currentPanel && currentPanel !== nextPanel) {
            animate(currentPanel, { opacity: 0, y: 12 }, { duration: 0.3, easing: 'ease-out' }).finished.then(() => {
                currentPanel.classList.remove('is-active');
            });
        }

        // Animate in next
        nextPanel.classList.add('is-active');
        animate(nextPanel, { opacity: [0, 1], y: [16, 0] }, {
            duration: 0.5,
            easing: [0.22, 1, 0.36, 1],
        });

        activeIndex = index;
    };

    setActive(0);

    // Click handlers for rows
    rows.forEach((row, i) => {
        row.addEventListener('click', () => setActive(i));
    });

    // Scroll-linked switching on desktop
    const isDesktop = window.matchMedia('(min-width: 900px)').matches;
    if (isDesktop) {
        scroll(
            ({ y }) => {
                const total = rows.length;
                const idx = Math.min(total - 1, Math.floor(y.progress * total));
                setActive(idx);
            },
            {
                target: section,
                offset: ['start start', `end end`],
            }
        );
    }
}

/* ----------------------------------------------------------------
   Parallax — scroll-linked y movement
   ---------------------------------------------------------------- */

export function initParallax(root = document) {
    if (reduced) return;
    root.querySelectorAll('[data-parallax]').forEach((el) => {
        const depth = parseFloat(el.dataset.parallax) || 0.15;
        scroll(
            ({ y }) => {
                const move = (y.progress - 0.5) * depth * 200;
                el.style.transform = `translateY(${move}px)`;
            },
            {
                target: el,
                offset: ['start end', 'end start'],
            }
        );
    });
}

/* ----------------------------------------------------------------
   Process section — scroll-driven card accent progress
   ---------------------------------------------------------------- */

export function initProcessCards(section) {
    if (!section || reduced) return;

    const cards = Array.from(section.querySelectorAll('.process-grid__card'));
    if (!cards.length) return;

    // Stagger-reveal each card on scroll with a slight delay
    cards.forEach((card, i) => {
        inView(card, () => {
            animate(card, { opacity: [0, 1], y: [40, 0] }, {
                duration: 0.7,
                delay: i * 0.1,
                easing: [0.22, 1, 0.36, 1],
            });
        }, { margin: '0px 0px -5% 0px' });

        // Micro scale on hover using CSS transitions (already handled in CSS)
        // Additional: number accent animation via JS on hover
        const num = card.querySelector('.process-grid__num');
        if (num) {
            card.addEventListener('mouseenter', () => {
                animate(num, { scale: [1, 1.06, 1] }, { duration: 0.4, easing: 'ease-out' });
            });
        }
    });
}

/* ----------------------------------------------------------------
   Magnetic hover — cursor-pull effect for primary CTAs
   ---------------------------------------------------------------- */

export function initMagneticHover(selector = '.btn--primary, .featured-card__arrow-btn') {
    if (reduced) return;
    const targets = document.querySelectorAll(selector);
    targets.forEach((el) => {
        const strength = 7;
        const onMove = (e) => {
            const rect = el.getBoundingClientRect();
            const relX = e.clientX - rect.left - rect.width / 2;
            const relY = e.clientY - rect.top - rect.height / 2;
            animate(el, {
                x: Math.max(-strength, Math.min(strength, relX * 0.1)),
                y: Math.max(-strength, Math.min(strength, relY * 0.1)),
            }, { duration: 0.3, easing: [0.22, 1, 0.36, 1] });
        };
        const reset = () => animate(el, { x: 0, y: 0 }, { duration: 0.5, easing: [0.22, 1, 0.36, 1] });
        el.addEventListener('pointermove', onMove);
        el.addEventListener('pointerleave', reset);
    });
}

/* ----------------------------------------------------------------
   3D Service cards — tilt on hover (.svc-card-3d and .tilt-card)
   ---------------------------------------------------------------- */

export function init3DCards(selector = '.svc-card-3d, .tilt-card') {
    if (reduced) return;
    document.querySelectorAll(selector).forEach((card) => {
        const inner = card.querySelector('.svc-card-3d__inner, .featured-card') || card;

        card.style.perspective = '900px';

        card.addEventListener('pointermove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width;
            const y = (e.clientY - rect.top) / rect.height;
            // Gentle: 12deg max for featured cards, 20 for service cards
            const maxDeg = card.classList.contains('tilt-card') ? 10 : 18;
            const rotateX = (0.5 - y) * maxDeg;
            const rotateY = (x - 0.5) * maxDeg;

            animate(inner, {
                rotateX: rotateX,
                rotateY: rotateY,
            }, { duration: 0.35, easing: 'ease-out' });
        });

        card.addEventListener('pointerleave', () => {
            animate(inner, { rotateX: 0, rotateY: 0 }, {
                duration: 0.7,
                easing: spring({ stiffness: 260, damping: 22 }),
            });
        });
    });
}

/* ----------------------------------------------------------------
   Stats — 3D flip counter effect
   ---------------------------------------------------------------- */

export function initStatsFlip(root = document) {
    if (reduced) return;
    root.querySelectorAll('.stat-3d').forEach((el) => {
        inView(el, () => {
            animate(el, {
                rotateX: [-90, 0],
                opacity: [0, 1],
                y: [40, 0],
            }, {
                duration: 0.8,
                easing: spring({ stiffness: 200, damping: 25 }),
                delay: parseFloat(el.dataset.stagger || '0'),
            });
        }, { margin: '0px 0px -10% 0px' });
    });
}

/* ----------------------------------------------------------------
   Floating elements — continuous subtle animation
   ---------------------------------------------------------------- */

export function initFloatingElements() {
    if (reduced) return;
    document.querySelectorAll('.float-el').forEach((el, i) => {
        const duration = 4 + (i % 3) * 1.5;
        const yRange = 10 + (i % 4) * 5;

        animate(el, {
            y: [0, -yRange, 0],
            rotateZ: [0, (i % 2 === 0 ? 3 : -3), 0],
        }, {
            duration: duration,
            repeat: Infinity,
            easing: 'ease-in-out',
        });
    });
}

/* ----------------------------------------------------------------
   Embla carousel wrapper
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

/* ----------------------------------------------------------------
   Accordion — services section
   ---------------------------------------------------------------- */

export function initAccordion(root = document) {
    const containers = root.querySelectorAll('[data-accordion]');
    containers.forEach((container) => {
        const items = container.querySelectorAll('[data-accordion-item]');

        items.forEach((item) => {
            const trigger = item.querySelector('[data-accordion-trigger]');
            if (!trigger) return;

            trigger.addEventListener('click', () => {
                const isOpen = item.classList.contains('is-open');

                // Close all items in this accordion
                items.forEach((other) => {
                    other.classList.remove('is-open');
                    const otherTrigger = other.querySelector('[data-accordion-trigger]');
                    if (otherTrigger) otherTrigger.setAttribute('aria-expanded', 'false');
                });

                // Toggle the clicked item
                if (!isOpen) {
                    item.classList.add('is-open');
                    trigger.setAttribute('aria-expanded', 'true');
                }
            });
        });
    });
}
