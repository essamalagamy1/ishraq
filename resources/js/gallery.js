/**
 * gallery.js — Interactive Project Image Gallery & Lightbox
 */

export function initGallery(container = document) {
    const galleryEl = container.querySelector('[data-gallery]');
    if (!galleryEl) return;

    const mainImg = galleryEl.querySelector('[data-gallery-main]');
    const counterEl = galleryEl.querySelector('[data-gallery-counter]');
    const captionEl = galleryEl.querySelector('[data-gallery-caption]');
    const thumbs = Array.from(galleryEl.querySelectorAll('[data-gallery-thumb]'));
    const prevBtns = Array.from(galleryEl.querySelectorAll('[data-gallery-prev]'));
    const nextBtns = Array.from(galleryEl.querySelectorAll('[data-gallery-next]'));
    const fullscreenBtns = Array.from(galleryEl.querySelectorAll('[data-gallery-fullscreen]'));

    // Lightbox elements
    const lightboxModal = document.querySelector('[data-lightbox-modal]');
    const lightboxImg = lightboxModal?.querySelector('[data-lightbox-img]');
    const lightboxCaption = lightboxModal?.querySelector('[data-lightbox-caption]');
    const lightboxCounter = lightboxModal?.querySelector('[data-lightbox-counter]');
    const lightboxClose = lightboxModal?.querySelector('[data-lightbox-close]');
    const lightboxPrev = lightboxModal?.querySelector('[data-lightbox-prev]');
    const lightboxNext = lightboxModal?.querySelector('[data-lightbox-next]');

    // Extract image data
    let imagesData = [];
    try {
        imagesData = JSON.parse(galleryEl.dataset.galleryImages || '[]');
    } catch (e) {
        imagesData = [];
    }

    if (!imagesData.length) return;

    let currentIndex = 0;

    function updateView(index, animate = true) {
        if (index < 0) index = imagesData.length - 1;
        if (index >= imagesData.length) index = 0;
        currentIndex = index;

        const currentData = imagesData[currentIndex];

        // Update Main Image
        if (mainImg) {
            if (animate) {
                mainImg.style.opacity = '0.4';
                mainImg.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    mainImg.src = currentData.url;
                    mainImg.alt = currentData.caption || '';
                    mainImg.style.opacity = '1';
                    mainImg.style.transform = 'scale(1)';
                }, 120);
            } else {
                mainImg.src = currentData.url;
                mainImg.alt = currentData.caption || '';
            }
        }

        // Update Counter
        if (counterEl) {
            const formatted = `${String(currentIndex + 1).padStart(2, '0')} / ${String(imagesData.length).padStart(2, '0')}`;
            counterEl.textContent = formatted;
        }

        // Update Caption
        if (captionEl) {
            captionEl.textContent = currentData.caption || '';
            if (currentData.caption) {
                captionEl.classList.remove('hidden');
            } else {
                captionEl.classList.add('hidden');
            }
        }

        // Update Thumbnails
        thumbs.forEach((thumb, idx) => {
            if (idx === currentIndex) {
                thumb.classList.add('is-active');
                thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                thumb.classList.remove('is-active');
            }
        });

        // Update Lightbox if open
        if (lightboxModal && !lightboxModal.classList.contains('hidden')) {
            updateLightbox();
        }
    }

    function updateLightbox() {
        if (!lightboxModal || !imagesData[currentIndex]) return;
        const currentData = imagesData[currentIndex];
        if (lightboxImg) {
            lightboxImg.src = currentData.url;
            lightboxImg.alt = currentData.caption || '';
        }
        if (lightboxCaption) {
            lightboxCaption.textContent = currentData.caption || '';
        }
        if (lightboxCounter) {
            lightboxCounter.textContent = `${String(currentIndex + 1).padStart(2, '0')} / ${String(imagesData.length).padStart(2, '0')}`;
        }
    }

    function openLightbox() {
        if (!lightboxModal) return;
        updateLightbox();
        lightboxModal.classList.remove('hidden');
        lightboxModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (!lightboxModal) return;
        lightboxModal.classList.add('hidden');
        lightboxModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    // Attach Event Listeners
    thumbs.forEach((thumb, idx) => {
        thumb.addEventListener('click', () => updateView(idx));
    });

    prevBtns.forEach(btn => btn.addEventListener('click', (e) => {
        e.stopPropagation();
        updateView(currentIndex - 1);
    }));

    nextBtns.forEach(btn => btn.addEventListener('click', (e) => {
        e.stopPropagation();
        updateView(currentIndex + 1);
    }));

    fullscreenBtns.forEach(btn => btn.addEventListener('click', (e) => {
        e.stopPropagation();
        openLightbox();
    }));

    if (mainImg) {
        mainImg.style.cursor = 'zoom-in';
        mainImg.addEventListener('click', openLightbox);
    }

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxPrev) lightboxPrev.addEventListener('click', (e) => {
        e.stopPropagation();
        updateView(currentIndex - 1);
    });
    if (lightboxNext) lightboxNext.addEventListener('click', (e) => {
        e.stopPropagation();
        updateView(currentIndex + 1);
    });

    // Close lightbox on backdrop click
    if (lightboxModal) {
        lightboxModal.addEventListener('click', (e) => {
            if (e.target === lightboxModal || e.target.hasAttribute('data-lightbox-backdrop')) {
                closeLightbox();
            }
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (lightboxModal && !lightboxModal.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight' || e.key === 'ArrowUp') updateView(currentIndex + 1);
            if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') updateView(currentIndex - 1);
        }
    });

    // Initialize first image
    updateView(0, false);
}
