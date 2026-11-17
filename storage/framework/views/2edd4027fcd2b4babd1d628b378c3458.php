<?php $__env->startSection('content'); ?>
<?php
    $heroPosition=$content['hero_image_position'] ?? 'center center';
    $primaryLabel=$content['hero_primary_label'] ?? 'Contact MAA'; $primaryUrl=$content['hero_primary_url'] ?? route('contact');
    $secondaryLabel=$content['hero_secondary_label'] ?? 'Discover MAA'; $secondaryUrl=$content['hero_secondary_url'] ?? '#purpose';
?>
<div x-data="siteHeader" x-on:scroll.window="scrolled = window.scrollY > 20">
    <header class="site-header" :class="{ 'site-header--solid': scrolled || open }">
        <div class="container header-inner">
            <a class="brand" href="<?php echo e(route('home')); ?>" aria-label="MAA home">
                <img class="brand-logo" src="<?php echo e(asset(ltrim($settings['logo_path'],'/'))); ?>" alt="<?php echo e($settings['site_name']); ?>">
            </a>
            <nav class="desktop-nav" aria-label="Primary navigation">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $mainNavigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><a href="<?php echo e(url($item->url)); ?>" target="<?php echo e($item->target); ?>"><?php echo e($item->label); ?></a><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </nav>
            <div class="header-actions">
                <a class="button button--ghost" href="<?php echo e(route('donate')); ?>">Donate</a>
                <button class="menu-button" type="button" x-on:click="open = !open" :aria-expanded="open" aria-controls="mobile-menu" aria-label="Toggle navigation"><span></span><span></span></button>
            </div>
        </div>
        <nav id="mobile-menu" class="mobile-nav" x-show="open" x-transition x-cloak>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $mainNavigation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><a href="<?php echo e(url($item->url)); ?>" target="<?php echo e($item->target); ?>"><?php echo e($item->label); ?></a><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?><a href="<?php echo e(route('donate')); ?>">Donate</a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($socialLinks->isNotEmpty()): ?><div class="mobile-nav-social"><span>Follow MAA</span><?php echo $__env->make('pages.partials.social-icons', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </nav>
    </header>

    <main id="main-content">
        <section id="top" class="hero hero-carousel" x-data="heroCarousel(<?php echo e($heroSlides->count()); ?>)" x-on:focusin="pause()" x-on:focusout="resume()" x-on:keydown.right.window="next()" x-on:keydown.left.window="previous()" x-on:touchstart.passive="touchStart=$event.changedTouches[0].clientX" x-on:touchend.passive="swipe($event.changedTouches[0].clientX)">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <article class="hero-slide" x-show="current === <?php echo e($loop->index); ?>" x-transition:enter="hero-enter" x-transition:enter-start="hero-enter-start" x-transition:enter-end="hero-enter-end" x-transition:leave="hero-leave" x-transition:leave-start="hero-leave-start" x-transition:leave-end="hero-leave-end" <?php if(!$loop->first): ?> x-cloak <?php endif; ?>>
                <div class="hero-slide-media" style="background-image:url('<?php echo e($slide['image']); ?>');background-position:<?php echo e($slide['image_position']); ?>" role="img" aria-label="<?php echo e($slide['eyebrow'] ?: 'MAA community'); ?>"></div>
                <div class="hero-slide-shade"></div>
                <div class="container hero-slide-content">
                    <div class="hero-slide-copy">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slide['eyebrow']): ?><p class="hero-slide-kicker"><span></span><?php echo e($slide['eyebrow']); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->first): ?><h1 class="hero-slide-title <?php echo e(mb_strlen($slide['title']) > 52 ? 'hero-slide-title--compact' : ''); ?>"><?php else: ?><h2 class="hero-slide-title <?php echo e(mb_strlen($slide['title']) > 52 ? 'hero-slide-title--compact' : ''); ?>"><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = preg_split('/\r\n|\r|\n/', $slide['title']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><span><?php echo e($line); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->first): ?></h1><?php else: ?></h2><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slide['description']): ?><p class="hero-slide-description"><?php echo e($slide['description']); ?></p><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="hero-slide-actions">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slide['primary_label'] && $slide['primary_url']): ?><a class="button button--light button--large" href="<?php echo e($slide['primary_url']); ?>"><?php echo e($slide['primary_label']); ?> <span class="material-symbols-outlined">arrow_forward</span></a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($slide['secondary_label'] && $slide['secondary_url']): ?><a class="hero-text-action" href="<?php echo e($slide['secondary_url']); ?>"><?php echo e($slide['secondary_label']); ?> <span class="material-symbols-outlined">north_east</span></a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="container hero-carousel-controls" x-show="count > 1">
                <div class="hero-slide-count"><strong x-text="String(current + 1).padStart(2,'0')">01</strong><span></span><small><?php echo e(str_pad($heroSlides->count(),2,'0',STR_PAD_LEFT)); ?></small></div>
                <div class="hero-progress"><i :style="`width:${progress}%`"></i></div>
                <div class="hero-dots" role="tablist" aria-label="Choose hero slide"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><button type="button" :class="{ 'is-active': current === <?php echo e($loop->index); ?> }" x-on:click="go(<?php echo e($loop->index); ?>)" aria-label="Show slide <?php echo e($loop->iteration); ?>"></button><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></div>
                <div class="hero-arrows"><button type="button" x-on:click="previous()" aria-label="Previous slide"><span class="material-symbols-outlined">arrow_back</span></button><button type="button" x-on:click="next()" aria-label="Next slide"><span class="material-symbols-outlined">arrow_forward</span></button></div>
            </div>
            <a class="hero-scroll" href="<?php echo e($pathways->isNotEmpty() ? '#pathways' : '#purpose'); ?>"><span>Scroll to explore</span><i></i></a>
        </section>

        <section class="hero hero-static" aria-hidden="true">
            <div class="hero-image" role="img" aria-label="MAA community members gathering at an event" style="background-image:url('<?php echo e($content['hero_image']); ?>');background-position:<?php echo e($heroPosition); ?>"></div>
            <div class="hero-overlay"></div><div class="hero-texture" aria-hidden="true"></div>
            <div class="container hero-content">
                <div class="hero-kicker"><span></span><p class="eyebrow eyebrow--light"><?php echo e($content['hero_eyebrow']); ?></p></div>
                <div class="hero-heading-wrap"><span class="hero-section-number">01</span><h1><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = preg_split('/\r\n|\r|\n/', $content['hero_title']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><span class="<?php echo e($loop->last ? 'hero-title-accent' : ''); ?>"><?php echo e($line); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></h1><span class="hero-heading-mark" aria-hidden="true"></span></div>
                <p class="hero-lead"><?php echo e($content['hero_lead']); ?></p>
                <div class="hero-actions hero-actions--dynamic"><a class="button button--light button--large" href="<?php echo e($primaryUrl); ?>"><?php echo e($primaryLabel); ?> <span aria-hidden="true">→</span></a><a class="button button--glass button--large" href="<?php echo e($secondaryUrl); ?>"><span class="play-icon">▶</span> <?php echo e($secondaryLabel); ?></a></div>
                
                <div class="hero-values" aria-label="MAA values"><span>Advocacy</span><span>Guidance</span><span>Community</span></div>
            </div>
            <aside class="hero-photo-note"><span>Community-led support</span><strong>A village where every family belongs.</strong></aside>
            <a class="scroll-cue" href="<?php echo e($pathways->isNotEmpty() ? '#pathways' : '#purpose'); ?>" aria-label="Explore the page"><span></span>Explore</a>
        </section>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(false): ?>
        <section id="pathways" class="pathways" aria-label="Ways MAA can help">
            <div class="container pathway-grid">
                <a href="<?php echo e(route('contact')); ?>" class="pathway-card">
                    <span class="icon-box"><svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                    <span><strong>Child & family support</strong><small>Guidance, resources and empathetic support for your family.</small></span><b>→</b>
                </a>
                <a href="#programs" class="pathway-card">
                    <span class="icon-box"><svg viewBox="0 0 24 24"><path d="M12 22c4-2 7-6 7-11-4 0-7 2-7 6 0-4-3-6-7-6 0 5 3 9 7 11Zm0-11c-2-2-2-6 0-9 2 3 2 7 0 9Z"/></svg></span>
                    <span><strong>Mothers’ well-being</strong><small>Care, connection and tools to support your well-being.</small></span><b>→</b>
                </a>
                <a href="#community" class="pathway-card">
                    <span class="icon-box"><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18M8 14h.01M12 14h.01M16 14h.01"/></svg></span>
                    <span><strong>Community & events</strong><small>Gather, learn and grow with other mothers and families.</small></span><b>→</b>
                </a>
            </div>
        </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pathways->isNotEmpty()): ?>
        <section id="pathways" class="pathways" aria-label="Ways MAA can help">
            <div class="container pathway-grid" style="--pathway-count:<?php echo e(min($pathways->count(), 4)); ?>">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pathways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pathway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e($pathway->link_url); ?>" class="pathway-card">
                    <span class="icon-box"><span class="material-symbols-outlined"><?php echo e($pathway->icon); ?></span></span>
                    <span><strong><?php echo e($pathway->title); ?></strong><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pathway->description): ?><small><?php echo e($pathway->description); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></span>
                    <span class="material-symbols-outlined pathway-arrow" aria-hidden="true">arrow_forward</span>
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </section>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <section id="purpose" class="section purpose-section">
            <div class="container">
                <div class="section-intro purpose-intro">
                    <div><p class="eyebrow"><?php echo e($content['purpose_label']); ?></p><h2><?php echo nl2br(e($content['purpose_title'])); ?></h2></div>
                    <div class="intro-copy"><p><?php echo e($content['purpose_text']); ?></p><a class="text-link" href="<?php echo e(route('about')); ?>">Meet MAA <span>→</span></a></div>
                </div>
                <div class="purpose-media">
                    <figure><img src="<?php echo e($content['purpose_image']); ?>" alt="MAA community members at a public gathering"></figure>
                    <aside><span class="surface-number">01</span><h3><?php echo e($content['purpose_card_title']); ?></h3><p><?php echo e($content['purpose_card_text']); ?></p></aside>
                </div>
            </div>
        </section>

        <section id="programs" class="section programs-section">
            <div class="container programs-layout">
                <div class="programs-heading"><p class="eyebrow"><?php echo e($content['programs_label']); ?></p><h2><?php echo e($content['programs_title']); ?></h2><a class="text-link" href="<?php echo e(route('programs')); ?>">View our programs <span>→</span></a></div>
                <div class="program-list" x-data="programAccordion">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <article class="program-item" :class="{ 'is-active': active === <?php echo e($loop->index); ?> }">
                        <button type="button" x-on:click="toggle(<?php echo e($loop->index); ?>)" :aria-expanded="active === <?php echo e($loop->index); ?>">
                            <span class="program-number">0<?php echo e($loop->iteration); ?></span><strong><?php echo e($program['title']); ?></strong><span class="toggle-mark" x-text="active === <?php echo e($loop->index); ?> ? '−' : '+'"></span>
                        </button>
                        <div class="program-description" x-show="active === <?php echo e($loop->index); ?>"><p><?php echo e($program['description']); ?></p></div>
                    </article>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </section>

        <section id="community" class="section community-section">
            <div class="container">
                <div class="section-title-row"><div><p class="eyebrow"><?php echo e($content['community_label']); ?></p><h2><?php echo e($content['community_title']); ?></h2></div><a class="text-link" href="<?php echo e(route('gallery')); ?>">Explore our community <span>→</span></a></div>
                <div class="community-grid">
                    <article class="story-card story-card--wide"><img src="<?php echo e($content['community_image_1']); ?>" alt="MAA community members outdoors"><p class="card-label"><?php echo e($content['community_card_1_label'] ?? 'Community'); ?></p><h3><?php echo e($content['community_card_1_title'] ?? 'Moments that bring us together.'); ?></h3><p><?php echo e($content['community_card_1_text'] ?? 'Space to connect, exchange experiences and celebrate every family.'); ?></p></article>
                    <article class="story-card"><img src="<?php echo e($content['community_image_2']); ?>" alt="MAA community gathering"><p class="card-label"><?php echo e($content['community_card_2_label'] ?? 'Conversations'); ?></p><h3><?php echo e($content['community_card_2_title'] ?? 'Support starts with being heard.'); ?></h3><p><?php echo e($content['community_card_2_text'] ?? 'Real discussions, shared experiences and practical support from mothers who understand.'); ?></p></article>
                </div>
            </div>
        </section>

        

        <section class="cta-section">
            <div class="container cta-grid"><h2><?php echo nl2br(e($content['cta_title'])); ?></h2><div><p><?php echo e($content['cta_text']); ?></p><div><a class="button button--light button--large" href="<?php echo e(route('contact')); ?>">Get involved <span class="material-symbols-outlined">arrow_forward</span></a><a class="button button--glass button--large" href="<?php echo e(route('donate')); ?>">Donate</a></div></div></div>
        </section>
    </main>

    <?php echo $__env->make('pages.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views/pages/home.blade.php ENDPATH**/ ?>