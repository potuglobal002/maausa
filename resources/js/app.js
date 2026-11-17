import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.data('siteHeader', () => ({
    open: false,
    scrolled: false,
    init() { this.scrolled = window.scrollY > 20; },
}));

Alpine.data('programAccordion', () => ({
    active: 0,
    toggle(index) { this.active = this.active === index ? -1 : index; },
}));

Alpine.data('animatedCounter', (target = 0) => ({
    display: 0,
    started: false,
    observer: null,
    init() {
        const finalValue = Math.max(0, Number(target) || 0);
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            this.display = finalValue;
            return;
        }

        this.observer = new IntersectionObserver(([entry]) => {
            if (!entry.isIntersecting || this.started) return;
            this.started = true;
            this.observer?.disconnect();
            const startedAt = performance.now();
            const duration = 1400;
            const animate = (time) => {
                const progress = Math.min((time - startedAt) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                this.display = Math.round(finalValue * eased);
                if (progress < 1) requestAnimationFrame(animate);
            };
            requestAnimationFrame(animate);
        }, { threshold: 0.45 });

        this.observer.observe(this.$el);
    },
}));

Alpine.data('videoModal', () => ({
    open: false,
    url: '',
    title: '',
    type: 'iframe',
    play(source, title) {
        const media = this.normalize(source);
        this.url = media.url;
        this.type = media.type;
        this.title = title || 'MAA video';
        this.open = true;
        document.documentElement.style.overflow = 'hidden';
    },
    close() {
        this.open = false;
        this.url = '';
        document.documentElement.style.overflow = '';
    },
    normalize(source) {
        const raw = String(source || '').trim();
        if (/\.(mp4|webm|ogg)(\?.*)?$/i.test(raw)) return { type: 'video', url: raw };
        try {
            const parsed = new URL(raw, window.location.origin);
            const host = parsed.hostname.replace(/^www\./, '');
            if (host === 'youtu.be') return { type: 'iframe', url: `https://www.youtube.com/embed/${parsed.pathname.split('/').filter(Boolean)[0]}?autoplay=1&rel=0` };
            if (host.includes('youtube.com')) {
                const id = parsed.searchParams.get('v') || parsed.pathname.split('/').filter(Boolean).pop();
                return { type: 'iframe', url: `https://www.youtube.com/embed/${id}?autoplay=1&rel=0` };
            }
            if (host.includes('vimeo.com')) {
                const id = parsed.pathname.split('/').filter(Boolean).pop();
                return { type: 'iframe', url: `https://player.vimeo.com/video/${id}?autoplay=1` };
            }
            if (host.includes('facebook.com') || host.includes('fb.watch')) return { type: 'iframe', url: `https://www.facebook.com/plugins/video.php?href=${encodeURIComponent(raw)}&show_text=false&autoplay=true` };
        } catch (error) { /* Use the original URL as a standard iframe source. */ }
        return { type: 'iframe', url: raw };
    },
}));

Alpine.data('heroCarousel', (slideCount = 1) => ({
    current: 0,
    count: Number(slideCount) || 1,
    progress: 0,
    timer: null,
    touchStart: 0,
    duration: 7000,
    init() { if (this.count > 1) this.start(); },
    start() {
        this.stop();
        this.progress = 0;
        const step = 100 / (this.duration / 100);
        this.timer = window.setInterval(() => {
            this.progress += step;
            if (this.progress >= 100) this.next();
        }, 100);
    },
    stop() { if (this.timer) window.clearInterval(this.timer); this.timer = null; },
    pause() { this.stop(); },
    resume() { if (this.count > 1 && !this.timer) this.start(); },
    go(index) { this.current = index; this.start(); },
    next() { this.current = (this.current + 1) % this.count; this.start(); },
    previous() { this.current = (this.current - 1 + this.count) % this.count; this.start(); },
    swipe(end) {
        const distance = end - this.touchStart;
        if (Math.abs(distance) < 45) return;
        distance < 0 ? this.next() : this.previous();
    },
}));

Alpine.data('mediaPicker', (initial = '') => ({
    value: initial || '',
    preview: initial || '',
    objectUrl: null,
    choose(event) {
        const file = event.target.files?.[0];
        if (!file) return;
        if (this.objectUrl) URL.revokeObjectURL(this.objectUrl);
        this.objectUrl = URL.createObjectURL(file);
        this.preview = this.objectUrl;
    },
    clear() {
        if (this.objectUrl) URL.revokeObjectURL(this.objectUrl);
        this.value = '';
        this.preview = '';
        this.objectUrl = null;
    },
}));

Alpine.data('repeatableParagraphs', (initial = [], limit = 20) => ({
    limit: Number(limit) || 20,
    nextId: 1,
    items: [],
    init() {
        const paragraphs = Array.isArray(initial) && initial.length ? initial : [''];
        this.items = paragraphs.map((text) => ({ id: this.nextId++, text: String(text || '') }));
    },
    add() {
        if (this.items.length >= this.limit) return;
        this.items.push({ id: this.nextId++, text: '' });
        this.$nextTick(() => this.$root.querySelector('.repeatable-item:last-child textarea')?.focus());
    },
    remove(index) {
        if (this.items.length === 1) return;
        this.items.splice(index, 1);
    },
    move(index, direction) {
        const destination = index + direction;
        if (destination < 0 || destination >= this.items.length) return;
        const [item] = this.items.splice(index, 1);
        this.items.splice(destination, 0, item);
    },
}));

Alpine.data('galleryExperience', (items = []) => ({
    items,
    filter: 'All',
    selected: null,
    current() { return this.selected === null ? null : this.items[this.selected]; },
    open(index) { this.selected = index; document.documentElement.style.overflow = 'hidden'; },
    close() { this.selected = null; document.documentElement.style.overflow = ''; },
    next() { if (this.items.length) this.selected = (this.selected + 1) % this.items.length; },
    previous() { if (this.items.length) this.selected = (this.selected - 1 + this.items.length) % this.items.length; },
}));

Alpine.data('richEditor', (initial = '') => ({
    value: initial || '',
    init() { this.$nextTick(() => { this.$refs.editor.innerHTML = this.value; }); },
    sync() { this.value = this.$refs.editor.innerHTML; },
    format(command) { this.$refs.editor.focus(); document.execCommand(command, false, null); this.sync(); },
    block(tag) { this.$refs.editor.focus(); document.execCommand('formatBlock', false, tag); this.sync(); },
}));

Alpine.start();

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (!reduceMotion) {
    const revealItems = [...document.querySelectorAll('main > section, .site-footer')];
    revealItems.forEach((item, index) => {
        item.classList.add('reveal-section');
        item.style.setProperty('--reveal-order', index % 3);
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -8% 0px' });

    revealItems.forEach((item) => observer.observe(item));

    const hero = document.querySelector('.hero-carousel');
    const heroImages = [...document.querySelectorAll('.hero-slide-media')];
    if (hero && heroImages.length) {
        let ticking = false;
        const updateHero = () => {
            const offset = Math.min(window.scrollY * 0.12, 70);
            heroImages.forEach((image) => image.style.setProperty('--hero-shift', `${offset}px`));
            ticking = false;
        };
        window.addEventListener('scroll', () => {
            if (!ticking) { requestAnimationFrame(updateHero); ticking = true; }
        }, { passive: true });
    }
}
