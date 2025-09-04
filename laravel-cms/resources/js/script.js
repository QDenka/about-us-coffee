window.addEventListener('load', () => {
    setTimeout(() => {
        const loader = document.getElementById('loader');
        loader.classList.add('hide');
        setTimeout(() => loader.style.display = 'none', 800);
    }, 2000);
});

// Custom cursor removed for simplicity - using default cursor

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

    // Only apply scrolled class on desktop
    if (window.innerWidth > 768) {
        navbar.classList.toggle('scrolled', scrolled > 100);
    }

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
    if (ecoCounter) {
        ecoCounter.textContent = currentCount.toLocaleString();
    }
}, 4000);

const form = document.querySelector('.contact-form');
if (form) {
    const inputs = form.querySelectorAll('input, textarea');
    
    inputs.forEach(input => {
        input.addEventListener('focus', () => input.parentElement.style.transform = 'scale(1.02)');
        input.addEventListener('blur', () => input.parentElement.style.transform = 'scale(1)');
    });
}

// Contact Form Handler with Anti-Spam
document.getElementById('contactForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');
    const formMessage = document.getElementById('formMessage');
    
    // Clear previous errors
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    if (formMessage) {
        formMessage.textContent = '';
        formMessage.style.display = 'none';
        formMessage.className = 'form-message';
    }
    
    // Validate privacy consent
    const privacyConsent = document.getElementById('privacy_consent');
    const privacyError = document.getElementById('privacy-error');
    
    if (!privacyConsent.checked) {
        privacyError.textContent = document.documentElement.lang === 'vi' 
            ? 'Bạn phải đồng ý với việc xử lý dữ liệu cá nhân.' 
            : 'You must agree to the processing of personal data.';
        return;
    }
    
    // Show loading state
    btnText.style.display = 'none';
    btnLoading.style.display = 'inline';
    submitBtn.disabled = true;
    
    try {
        const formData = new FormData(form);
        
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            // Success
            if (formMessage) {
                formMessage.textContent = data.message || 'Message sent successfully!';
                formMessage.className = 'form-message success';
                formMessage.style.display = 'block';
            }
            form.reset();
            const messageLength = document.getElementById('messageLength');
            if (messageLength) {
                messageLength.textContent = '0';
            }
        } else {
            // Handle validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const errorField = field === 'privacy_consent' ? 'privacy' : field;
                    const errorEl = document.getElementById(errorField + '-error');
                    if (errorEl) {
                        errorEl.textContent = data.errors[field][0];
                    }
                });
            } else {
                if (formMessage) {
                    formMessage.textContent = data.message || 'An error occurred. Please try again.';
                    formMessage.className = 'form-message error';
                    formMessage.style.display = 'block';
                }
            }
        }
    } catch (error) {
        console.error('Form submission error:', error);
        if (formMessage) {
            formMessage.textContent = 'Network error. Please check your connection and try again.';
            formMessage.className = 'form-message error';
            formMessage.style.display = 'block';
        }
    } finally {
        // Reset button state
        btnText.style.display = 'inline';
        btnLoading.style.display = 'none';
        submitBtn.disabled = false;
    }
});

// Character counter for message field
document.getElementById('message')?.addEventListener('input', function() {
    const counter = document.getElementById('messageLength');
    if (counter) {
        counter.textContent = this.value.length;
        
        // Visual feedback for approaching limit
        const remaining = 2000 - this.value.length;
        counter.parentElement.style.color = remaining < 100 ? '#e74c3c' : remaining < 200 ? '#f39c12' : '#666';
    }
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

const initWorkspaceGallery = () => {
    if (typeof window.PhotoSwipeLightbox === 'undefined') {
        console.error('PhotoSwipeLightbox not loaded');
        return;
    }

    const workspaceLightbox = new window.PhotoSwipeLightbox({
        gallery: '.floor-diagram',
        children: '.floor-image-link',
        pswpModule: () => import('https://cdn.jsdelivr.net/npm/photoswipe@5.4.4/dist/photoswipe.esm.min.js'),
        initialZoomLevel: 'fit',
        secondaryZoomLevel: 1,
        maxZoomLevel: 3
    });

    workspaceLightbox.addFilter('itemData', (itemData) => {
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

    workspaceLightbox.init();
};

const initGallery = () => {
    setTimeout(initPhotoSwipeGallery, 100);
    setTimeout(initWorkspaceGallery, 150);
};

document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', initGallery)
    : initGallery();

// Floor level text expansion functionality
document.addEventListener('DOMContentLoaded', () => {
    const floorTexts = document.querySelectorAll('.floor-level p');
    
    floorTexts.forEach(text => {
        text.addEventListener('click', () => {
            text.classList.toggle('expanded');
        });
    });
});
