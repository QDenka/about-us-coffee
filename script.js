window.addEventListener('load', () => {
    setTimeout(() => {
        const loader = document.getElementById('loader');
        loader.classList.add('hide');
        setTimeout(() => loader.style.display = 'none', 800);
    }, 2000);
});

const cursor = document.querySelector('.cursor');
const cursorFollower = document.querySelector('.cursor-follower');
let mouseX = 0, mouseY = 0, cursorX = 0, cursorY = 0, followerX = 0, followerY = 0;

document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

const animateCursor = () => {
    cursorX += (mouseX - cursorX) * 0.25;
    cursorY += (mouseY - cursorY) * 0.25;
    followerX += (mouseX - followerX) * 0.15;
    followerY += (mouseY - followerY) * 0.15;

    cursor.style.transform = `translate(${cursorX - 16}px, ${cursorY - 16}px)`;
    cursorFollower.style.transform = `translate(${followerX - 4}px, ${followerY - 4}px)`;

    requestAnimationFrame(animateCursor);
};

animateCursor();

document.querySelectorAll('a, button, .menu-card, .story-card, .gallery-item, .tab-button, .feature-tag, .phin-container')
    .forEach(el => {
        el.addEventListener('mouseenter', () => cursor.classList.add('hover'));
        el.addEventListener('mouseleave', () => cursor.classList.remove('hover'));
    });

const navMenu = document.getElementById('navMenu');

document.querySelectorAll('#navMenu a').forEach(link =>
    link.addEventListener('click', () => navMenu.classList.remove('active'))
);

document.addEventListener('click', (e) => {
    if (!e.target.closest('nav')) navMenu.classList.remove('active');
});

const tabButtons = document.querySelectorAll('.tab-button');
const menuGrids = document.querySelectorAll('.menu-grid');

tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        const menuType = button.dataset.menu;

        tabButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        menuGrids.forEach(grid => grid.classList.add('hidden'));
        document.getElementById(menuType + '-menu')?.classList.remove('hidden');
    });
});

const navbar = document.getElementById('navbar');

window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;

    navbar.classList.toggle('scrolled', scrolled > 100);

    document.querySelectorAll('.coffee-bean-svg').forEach((bean, index) => {
        const speed = 0.15 + (index * 0.05);
        bean.style.transform = `translateY(${scrolled * speed}px) rotate(${scrolled * 0.1}deg)`;
    });
});

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href'))?.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
        if (entry.isIntersecting) {
            setTimeout(() => {
                Object.assign(entry.target.style, {
                    animationDelay: `${index * 0.1}s`,
                    opacity: '1'
                });
            }, index * 100);
        }
    });
}, { threshold: 0.3, rootMargin: '0px 0px -100px 0px' });

document.querySelectorAll('.timeline-item, .story-card, .menu-card')
    .forEach(item => observer.observe(item));

const ecoCounter = document.getElementById('ecoCounter');
let currentCount = 24847;

setInterval(() => {
    currentCount += Math.floor(Math.random() * 3) + 1;
    ecoCounter.textContent = currentCount.toLocaleString();
}, 4000);

const form = document.querySelector('.contact-form');
const inputs = form.querySelectorAll('input, textarea');

inputs.forEach(input => {
    input.addEventListener('focus', () => input.parentElement.style.transform = 'scale(1.02)');
    input.addEventListener('blur', () => input.parentElement.style.transform = 'scale(1)');
});

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const btn = form.querySelector('.submit-btn');
    const originalText = btn.textContent;

    btn.textContent = 'BREWING YOUR MESSAGE...';
    Object.assign(btn.style, { background: 'var(--black)', color: 'var(--primary)' });

    setTimeout(() => {
        btn.textContent = 'MESSAGE SENT! ☕';
        setTimeout(() => {
            btn.textContent = originalText;
            Object.assign(btn.style, { background: 'var(--primary)', color: 'var(--black)' });
            form.reset();
        }, 2000);
    }, 1500);
});

const galleryContainer = document.querySelector('.gallery-container');
if (galleryContainer) {
    let isDown = false, startX, startTouchX, scrollLeft;

    galleryContainer.style.cursor = 'grab';

    galleryContainer.addEventListener('wheel', (e) => {
        e.preventDefault();
        galleryContainer.scrollBy({ left: e.deltaY || e.deltaX, behavior: 'smooth' });
    });

    const handleMouseEvents = {
        mousedown: (e) => {
            isDown = true;
            startX = e.pageX - galleryContainer.offsetLeft;
            scrollLeft = galleryContainer.scrollLeft;
            galleryContainer.style.cursor = 'grabbing';
        },
        mouseleave: () => { isDown = false; galleryContainer.style.cursor = 'grab'; },
        mouseup: () => { isDown = false; galleryContainer.style.cursor = 'grab'; },
        mousemove: (e) => {
            if (!isDown) return;
            e.preventDefault();
            const walk = (e.pageX - galleryContainer.offsetLeft - startX) * 2;
            galleryContainer.scrollLeft = scrollLeft - walk;
        }
    };

    const handleTouchEvents = {
        touchstart: (e) => {
            startTouchX = e.touches[0].clientX;
            scrollLeft = galleryContainer.scrollLeft;
        },
        touchmove: (e) => {
            if (!startTouchX) return;
            const walk = (startTouchX - e.touches[0].clientX) * 2;
            galleryContainer.scrollLeft = scrollLeft + walk;
        },
        touchend: () => startTouchX = null
    };

    Object.entries({...handleMouseEvents, ...handleTouchEvents})
        .forEach(([event, handler]) => galleryContainer.addEventListener(event, handler));
}

const initPhotoSwipeGallery = () => {
    if (typeof window.PhotoSwipeLightbox === 'undefined') {
        console.error('PhotoSwipeLightbox not loaded');
        return;
    }

    const lightbox = new window.PhotoSwipeLightbox({
        gallery: '#photo-gallery',
        children: 'a',
        pswpModule: () => import('https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe.esm.min.js'),
        initialZoomLevel: 'fit',
        secondaryZoomLevel: 1,
        maxZoomLevel: 3
    });

    lightbox.addFilter('itemData', (itemData) => {
        const imgEl = itemData.element.querySelector('img');

        if (imgEl?.complete && imgEl.naturalWidth) {
            itemData.w = imgEl.naturalWidth;
            itemData.h = imgEl.naturalHeight;
        } else {
            const linkEl = itemData.element;
            itemData.w = parseInt(linkEl.dataset.pswpWidth) || 1200;
            itemData.h = parseInt(linkEl.dataset.pswpHeight) || 800;

            const img = new Image();
            img.onload = () => {
                itemData.w = img.naturalWidth;
                itemData.h = img.naturalHeight;
            };
            img.src = linkEl.href;
        }
        return itemData;
    });

    lightbox.init();
};

const initGallery = () => setTimeout(initPhotoSwipeGallery, 100);
document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', initGallery)
    : initGallery();
