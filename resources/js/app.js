import './bootstrap';

const whatsappNumber = '254746761556';

trackAnalyticsEvent('page_view');
initCart();
initFloatingWhatsapp();

document.querySelectorAll('[data-hero-carousel]').forEach((carousel) => {
    const slides = Array.from(carousel.querySelectorAll('.hero-image'));
    const dots = Array.from(carousel.querySelectorAll('.hero-slide-dots span'));

    if (slides.length < 2) {
        return;
    }

    let activeIndex = 0;

    window.setInterval(() => {
        slides[activeIndex].classList.remove('is-active');
        dots[activeIndex]?.classList.remove('is-active');

        activeIndex = (activeIndex + 1) % slides.length;

        slides[activeIndex].classList.add('is-active');
        dots[activeIndex]?.classList.add('is-active');
    }, 5200);
});

document.querySelectorAll('[data-whatsapp-form]').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const formData = new FormData(form);
        const lines = [form.dataset.whatsappContext || 'Joya Atelier enquiry'];
        const submitButton = form.querySelector('[type="submit"]');
        const originalButtonText = submitButton?.textContent;

        for (const [key, value] of formData.entries()) {
            if (key === '_token') {
                continue;
            }

            if (value instanceof File) {
                if (value.name) {
                    lines.push(`${formatLabel(key)}: ${value.name}`);
                }

                continue;
            }

            const text = String(value).trim();

            if (text) {
                lines.push(`${formatLabel(key)}: ${text}`);
            }
        }

        const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(lines.join('\n'))}`;
        const whatsappWindow = window.open('', '_blank');

        submitButton?.setAttribute('disabled', 'disabled');

        if (submitButton) {
            submitButton.textContent = 'Sending...';
        }

        try {
            await sendEmailCopy(form, formData);
            openWhatsapp(whatsappUrl, whatsappWindow);
            form.reset();
        } catch (error) {
            openWhatsapp(whatsappUrl, whatsappWindow);
            window.alert('Your WhatsApp message is ready, but the email copy could not be sent. Please check the mail settings.');
        } finally {
            submitButton?.removeAttribute('disabled');

            if (submitButton && originalButtonText) {
                submitButton.textContent = originalButtonText;
            }
        }
    });
});

document.addEventListener('click', (event) => {
    const target = event.target.closest('a, button');

    if (!target) {
        openGalleryFromClick(event);
        return;
    }

    if (target.matches('[data-add-to-cart]')) {
        event.preventDefault();
        addProductToCart(target);
        return;
    }

    if (target.matches('[data-cart-open]')) {
        event.preventDefault();
        openCart();
        return;
    }

    if (target.matches('[data-cart-close]')) {
        event.preventDefault();
        closeCart();
        return;
    }

    if (target.matches('[data-cart-increase]')) {
        event.preventDefault();
        updateCartQuantity(target.dataset.productId, 1);
        return;
    }

    if (target.matches('[data-cart-decrease]')) {
        event.preventDefault();
        updateCartQuantity(target.dataset.productId, -1);
        return;
    }

    if (target.matches('[data-cart-remove]')) {
        event.preventDefault();
        removeCartItem(target.dataset.productId);
        return;
    }

    if (target.matches('[data-cart-checkout]')) {
        event.preventDefault();
        checkoutCart();
        return;
    }

    const href = target.getAttribute('href') || '';
    const text = (target.textContent || target.getAttribute('aria-label') || '').trim().slice(0, 120);

    if (href.includes('wa.me')) {
        trackAnalyticsEvent('whatsapp_click', text || 'WhatsApp click', { href });
        return;
    }

    if (href.includes('/booking') || text.toLowerCase().includes('book')) {
        trackAnalyticsEvent('lead_action', text || 'Lead action', { href });
        return;
    }

    if (href.includes('/flowers') || text.toLowerCase().includes('shop')) {
        trackAnalyticsEvent('product_interest', text || 'Product interest', { href });
    }
});

initGalleryLightbox();

function initCart() {
    if (!document.querySelector('[data-joya-cart]')) {
        const cart = document.createElement('aside');
        cart.className = 'joya-cart';
        cart.setAttribute('data-joya-cart', '');
        cart.setAttribute('aria-hidden', 'true');
        cart.innerHTML = `
            <div class="joya-cart-panel">
                <div class="joya-cart-header">
                    <div>
                        <span>Your Cart</span>
                        <strong>Selected Items</strong>
                    </div>
                    <button type="button" data-cart-close aria-label="Close cart">&times;</button>
                </div>
                <div class="joya-cart-items" data-cart-items></div>
                <div class="joya-cart-footer">
                    <div class="joya-cart-total">
                        <span>Total</span>
                        <strong data-cart-total>KSh 0.00</strong>
                    </div>
                    <button type="button" data-cart-checkout>Send Order on WhatsApp</button>
                </div>
            </div>
        `;
        document.body.appendChild(cart);

        cart.addEventListener('click', (event) => {
            if (event.target === cart) {
                closeCart();
            }
        });
    }

    const header = document.querySelector('.shop-header');
    const headerCartButton = header?.querySelector('[data-cart-open]');

    if (headerCartButton) {
        headerCartButton.setAttribute('data-header-cart-open', '');
    } else if (header) {
        const cartButton = document.createElement('button');
        cartButton.className = 'header-cta cart-open-button';
        cartButton.type = 'button';
        cartButton.setAttribute('data-cart-open', '');
        cartButton.setAttribute('data-header-cart-open', '');
        cartButton.innerHTML = `Cart <span data-cart-count>0</span>`;
        header.appendChild(cartButton);
    }

    renderCart();
}

function initFloatingWhatsapp() {
    if (document.querySelector('[data-floating-whatsapp]')) {
        return;
    }

    const whatsappLink = document.createElement('a');
    whatsappLink.className = 'floating-whatsapp';
    whatsappLink.href = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent('Hello Joya Atelier, I have a question and need assistance.')}`;
    whatsappLink.setAttribute('aria-label', 'Contact Joya Atelier on WhatsApp');
    whatsappLink.setAttribute('data-floating-whatsapp', '');
    whatsappLink.innerHTML = '<img src="/images/brand/whatsapp-contact-logo.png" alt="">';
    document.body.appendChild(whatsappLink);
}

function getCartItems() {
    try {
        return JSON.parse(window.localStorage.getItem('joya_cart') || '[]');
    } catch (error) {
        return [];
    }
}

function saveCartItems(items) {
    window.localStorage.setItem('joya_cart', JSON.stringify(items));
    renderCart();
}

function addProductToCart(button) {
    const items = getCartItems();
    const id = button.dataset.productId;
    const existing = items.find((item) => item.id === id);

    if (existing) {
        existing.quantity += 1;
    } else {
        items.push({
            id,
            name: button.dataset.productName || 'Joya Atelier product',
            price: Number(button.dataset.productPrice || 0),
            image: button.dataset.productImage || '',
            quantity: 1,
        });
    }

    saveCartItems(items);
    openCart();
    trackAnalyticsEvent('cart_add', button.dataset.productName || 'Product added', { product_id: id });
}

function updateCartQuantity(productId, change) {
    const items = getCartItems()
        .map((item) => item.id === productId ? { ...item, quantity: item.quantity + change } : item)
        .filter((item) => item.quantity > 0);

    saveCartItems(items);
}

function removeCartItem(productId) {
    saveCartItems(getCartItems().filter((item) => item.id !== productId));
}

function renderCart() {
    const items = getCartItems();
    const cartItems = document.querySelector('[data-cart-items]');
    const total = items.reduce((sum, item) => sum + (Number(item.price) * item.quantity), 0);
    const count = items.reduce((sum, item) => sum + item.quantity, 0);

    document.querySelectorAll('[data-cart-count]').forEach((element) => {
        element.textContent = String(count);
    });

    document.querySelectorAll('[data-cart-total]').forEach((element) => {
        element.textContent = formatCurrency(total);
    });

    if (!cartItems) {
        return;
    }

    if (items.length === 0) {
        cartItems.innerHTML = '<p class="joya-cart-empty">Your cart is empty. Add a product from the shop.</p>';
        return;
    }

    cartItems.innerHTML = items.map((item) => `
        <article class="joya-cart-item">
            ${item.image ? `<img src="${item.image}" alt="">` : ''}
            <div>
                <strong>${escapeHtml(item.name)}</strong>
                <span>${formatCurrency(item.price)} each</span>
                <div class="joya-cart-controls">
                    <button type="button" data-cart-decrease data-product-id="${item.id}">-</button>
                    <em>${item.quantity}</em>
                    <button type="button" data-cart-increase data-product-id="${item.id}">+</button>
                    <button type="button" data-cart-remove data-product-id="${item.id}">Remove</button>
                </div>
            </div>
        </article>
    `).join('');
}

function openCart() {
    document.querySelector('[data-joya-cart]')?.classList.add('is-open');
    document.querySelector('[data-joya-cart]')?.setAttribute('aria-hidden', 'false');
}

function closeCart() {
    document.querySelector('[data-joya-cart]')?.classList.remove('is-open');
    document.querySelector('[data-joya-cart]')?.setAttribute('aria-hidden', 'true');
}

function checkoutCart() {
    const items = getCartItems();

    if (items.length === 0) {
        window.alert('Your cart is empty.');
        return;
    }

    const total = items.reduce((sum, item) => sum + (Number(item.price) * item.quantity), 0);
    const lines = [
        'Hello Joya Atelier, I would like to order:',
        ...items.map((item) => `- ${item.name} x ${item.quantity} = ${formatCurrency(item.price * item.quantity)}`),
        `Total: ${formatCurrency(total)}`,
    ];

    trackAnalyticsEvent('cart_checkout', 'WhatsApp cart checkout', { items, total });
    window.location.href = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(lines.join('\n'))}`;
}

function formatCurrency(value) {
    return `KSh ${Number(value || 0).toLocaleString('en-KE', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    })}`;
}

function escapeHtml(value) {
    return String(value)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function openWhatsapp(url, whatsappWindow) {
    if (whatsappWindow) {
        whatsappWindow.location.href = url;
        return;
    }

    window.location.href = url;
}

async function sendEmailCopy(form, formData) {
    const response = await fetch(form.action, {
        method: 'POST',
        headers: {
            Accept: 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: formData,
    });

    if (!response.ok) {
        throw new Error('Email request failed');
    }
}

function formatLabel(key) {
    return key
        .replace(/\[\]$/, '')
        .replace(/_/g, ' ')
        .replace(/\b\w/g, (letter) => letter.toUpperCase());
}

function getOrCreateStorageId(key) {
    const existing = window.localStorage.getItem(key);

    if (existing) {
        return existing;
    }

    const value = `${Date.now()}-${Math.random().toString(16).slice(2)}`;
    window.localStorage.setItem(key, value);

    return value;
}

function trackAnalyticsEvent(eventType, label = '', metadata = {}) {
    const visitorId = getOrCreateStorageId('joya_visitor_id');
    const sessionId = window.sessionStorage.getItem('joya_session_id') || getOrCreateStorageId('joya_session_id');

    window.sessionStorage.setItem('joya_session_id', sessionId);

    const params = new URLSearchParams(window.location.search);

    const payload = {
        event_type: eventType,
        visitor_id: visitorId,
        session_id: sessionId,
        page_url: window.location.href,
        page_path: window.location.pathname,
        page_title: document.title,
        label,
        referrer: document.referrer,
        utm_source: params.get('utm_source'),
        utm_medium: params.get('utm_medium'),
        utm_campaign: params.get('utm_campaign'),
        metadata,
    };

    fetch('/analytics/track', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        },
        body: JSON.stringify(payload),
        keepalive: true,
    }).catch(() => {});
}

function initGalleryLightbox() {
    if (document.querySelector('[data-joya-lightbox]')) {
        return;
    }

    const lightbox = document.createElement('div');
    lightbox.className = 'joya-lightbox';
    lightbox.setAttribute('data-joya-lightbox', '');
    lightbox.setAttribute('aria-hidden', 'true');
    lightbox.innerHTML = `
        <div class="joya-lightbox-panel" role="dialog" aria-modal="true" aria-label="Image gallery preview">
            <button class="joya-lightbox-close" type="button" data-lightbox-close aria-label="Close preview">&times;</button>
            <button class="joya-lightbox-nav joya-lightbox-prev" type="button" data-lightbox-prev aria-label="Previous image">&lsaquo;</button>
            <figure>
                <img src="" alt="">
                <figcaption>
                    <span data-lightbox-category></span>
                    <strong data-lightbox-title></strong>
                    <small data-lightbox-count></small>
                </figcaption>
            </figure>
            <button class="joya-lightbox-nav joya-lightbox-next" type="button" data-lightbox-next aria-label="Next image">&rsaquo;</button>
        </div>
    `;

    document.body.appendChild(lightbox);

    const closeButton = lightbox.querySelector('[data-lightbox-close]');
    const previousButton = lightbox.querySelector('[data-lightbox-prev]');
    const nextButton = lightbox.querySelector('[data-lightbox-next]');

    closeButton.addEventListener('click', closeLightbox);
    previousButton.addEventListener('click', () => moveLightbox(-1));
    nextButton.addEventListener('click', () => moveLightbox(1));
    lightbox.addEventListener('click', (event) => {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (!lightbox.classList.contains('is-open')) {
            return;
        }

        if (event.key === 'Escape') {
            closeLightbox();
        }

        if (event.key === 'ArrowLeft') {
            moveLightbox(-1);
        }

        if (event.key === 'ArrowRight') {
            moveLightbox(1);
        }
    });
}

function openGalleryFromClick(event) {
    const galleryItem = event.target.closest('.events-grid article, .event-inspo-grid figure, .product-card');

    if (!galleryItem || !galleryItem.querySelector('img')) {
        return;
    }

    const isInsideGalleryPage = document.body.querySelector('.events-grid, .event-inspo-grid, .product-grid');

    if (!isInsideGalleryPage) {
        return;
    }

    const group = galleryItem.dataset.galleryGroup || getGalleryGroup(galleryItem);
    const galleryItems = getGalleryItems(group);
    const index = galleryItems.findIndex((item) => item.element === galleryItem);

    if (index === -1) {
        return;
    }

    event.preventDefault();
    openLightbox(index, group);
}

function getGalleryItems(group = null) {
    return Array.from(document.querySelectorAll('.events-grid article, .event-inspo-grid figure, .product-card'))
        .filter((element) => element.querySelector('img'))
        .filter((element) => !group || (element.dataset.galleryGroup || getGalleryGroup(element)) === group)
        .map((element) => {
            const image = element.querySelector('img');
            const title = element.querySelector('h3')?.textContent?.trim()
                || element.querySelector('figcaption')?.textContent?.trim()
                || image.alt
                || 'Joya Atelier design';
            const category = element.querySelector('span')?.textContent?.trim()
                || element.closest('section')?.querySelector('.eyebrow')?.textContent?.trim()
                || 'Gallery';

            return {
                element,
                group: element.dataset.galleryGroup || getGalleryGroup(element),
                src: image.currentSrc || image.src,
                alt: image.alt || title,
                title,
                category,
            };
        });
}

function getGalleryGroup(element) {
    return element.closest('section')?.id
        || element.closest('section')?.querySelector('.eyebrow')?.textContent?.trim()?.toLowerCase()?.replace(/[^a-z0-9]+/g, '-')
        || 'gallery';
}

function openLightbox(index, group = null) {
    const lightbox = document.querySelector('[data-joya-lightbox]');

    if (!lightbox) {
        return;
    }

    lightbox.dataset.activeIndex = String(index);
    lightbox.dataset.activeGroup = group || '';
    renderLightbox();
    lightbox.classList.add('is-open');
    lightbox.setAttribute('aria-hidden', 'false');
    document.body.classList.add('has-lightbox-open');
    trackAnalyticsEvent('gallery_preview', getGalleryItems(group)[index]?.title || 'Gallery preview', { group });
}

function closeLightbox() {
    const lightbox = document.querySelector('[data-joya-lightbox]');

    if (!lightbox) {
        return;
    }

    lightbox.classList.remove('is-open');
    lightbox.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('has-lightbox-open');
}

function moveLightbox(direction) {
    const lightbox = document.querySelector('[data-joya-lightbox]');
    const galleryItems = getGalleryItems(lightbox?.dataset.activeGroup || null);

    if (!lightbox || galleryItems.length === 0) {
        return;
    }

    const currentIndex = Number(lightbox.dataset.activeIndex || 0);
    const nextIndex = (currentIndex + direction + galleryItems.length) % galleryItems.length;

    lightbox.dataset.activeIndex = String(nextIndex);
    renderLightbox();
}

function renderLightbox() {
    const lightbox = document.querySelector('[data-joya-lightbox]');
    const galleryItems = getGalleryItems(lightbox?.dataset.activeGroup || null);

    if (!lightbox || galleryItems.length === 0) {
        return;
    }

    const activeIndex = Number(lightbox.dataset.activeIndex || 0);
    const item = galleryItems[activeIndex];
    const image = lightbox.querySelector('img');
    const figure = lightbox.querySelector('figure');

    if (figure) {
        figure.style.setProperty('--lightbox-image-width', '1120px');
    }

    image.onload = () => {
        if (!figure) {
            return;
        }

        const naturalWidth = image.naturalWidth || 1120;
        figure.style.setProperty('--lightbox-image-width', `${Math.min(naturalWidth, 1120)}px`);
    };
    image.src = item.src;
    image.alt = item.alt;
    lightbox.querySelector('[data-lightbox-title]').textContent = item.title;
    lightbox.querySelector('[data-lightbox-category]').textContent = item.category;
    lightbox.querySelector('[data-lightbox-count]').textContent = `${activeIndex + 1} / ${galleryItems.length}`;
}
