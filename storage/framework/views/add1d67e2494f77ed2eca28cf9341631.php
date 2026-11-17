<?php $__env->startSection('title', 'Edit '.$page->title.' | MAA Administration'); ?>
<?php $__env->startSection('content'); ?>
<div class="admin-shell" x-data="{ navOpen:false }">
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <main class="admin-main">
        <?php echo $__env->make('admin.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="admin-content page-editor-page">
            <div class="page-editor-heading">
                <div><p class="eyebrow">Content workspace</p><div class="editor-title-row"><h1><?php echo e($page->title); ?></h1><span class="status-pill <?php echo e($page->status); ?>"><?php echo e(ucfirst($page->status)); ?></span></div><p>Manage page content, imagery, publishing and search information.</p></div>
                <a class="secondary-action" target="_blank" href="<?php echo e($page->slug === 'home' ? route('home') : url($page->slug)); ?>">Preview page <span class="material-symbols-outlined">open_in_new</span></a>
            </div>
            <?php echo $__env->make('admin.partials.flash', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <form class="cms-form page-editor-form" method="POST" action="<?php echo e(route('admin.pages.update',$page)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="page-editor-layout">
                    <aside class="editor-outline">
                        <strong>Page outline</strong>
                        <a href="#publishing"><span class="material-symbols-outlined">tune</span> Publishing & SEO</a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page->slug === 'home'): ?><a href="<?php echo e(route('admin.hero-slides.index',$page)); ?>"><span class="material-symbols-outlined">view_carousel</span> Hero carousel</a><a href="<?php echo e(route('admin.home-pathways.index',$page)); ?>"><span class="material-symbols-outlined">route</span> Support pathways</a><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group=>$fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><a href="#section-<?php echo e(Str::slug($group)); ?>"><span class="outline-number"><?php echo e(str_pad($loop->iteration,2,'0',STR_PAD_LEFT)); ?></span> <?php echo e($group); ?></a><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <div class="editor-tip"><span class="material-symbols-outlined">lightbulb</span><p>Upload optimized WebP or JPG images for faster page loading.</p></div>
                    </aside>

                    <div class="editor-panels">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page->slug === 'home'): ?>
                        <section class="cms-card editor-card carousel-manager-card">
                            <div class="carousel-manager-icon"><span class="material-symbols-outlined">view_carousel</span></div>
                            <div><p class="eyebrow">Homepage spotlight</p><h2>Hero carousel</h2><p>Manage slide copy, photography, links, order and visibility in a dedicated workspace.</p></div>
                            <div class="carousel-manager-meta"><strong><?php echo e($heroSlideCount); ?></strong><span><?php echo e(Str::plural('slide',$heroSlideCount)); ?></span><a class="module-action" href="<?php echo e(route('admin.hero-slides.index',$page)); ?>">Manage carousel <span class="material-symbols-outlined">arrow_forward</span></a></div>
                        </section>
                        <section class="cms-card editor-card carousel-manager-card">
                            <div class="carousel-manager-icon"><span class="material-symbols-outlined">route</span></div>
                            <div><p class="eyebrow">Homepage navigation</p><h2>Support pathways</h2><p>Manage the cards below the hero, including their copy, icons, links, order and visibility.</p></div>
                            <div class="carousel-manager-meta"><strong><?php echo e($homePathwayCount); ?></strong><span><?php echo e(Str::plural('pathway',$homePathwayCount)); ?></span><a class="module-action" href="<?php echo e(route('admin.home-pathways.index',$page)); ?>">Manage pathways <span class="material-symbols-outlined">arrow_forward</span></a></div>
                        </section>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($page->slug, ['gallery','news-pr'], true)): ?>
                        <?php
                            $collectionRoute = $page->slug === 'gallery' ? route('admin.gallery.index') : route('admin.news.index');
                            $collectionTitle = $page->slug === 'gallery' ? 'Image gallery' : 'News & PR articles';
                            $collectionIcon = $page->slug === 'gallery' ? 'photo_library' : 'newspaper';
                        ?>
                        <section class="cms-card editor-card carousel-manager-card">
                            <div class="carousel-manager-icon"><span class="material-symbols-outlined"><?php echo e($collectionIcon); ?></span></div>
                            <div><p class="eyebrow">Dedicated content module</p><h2><?php echo e($collectionTitle); ?></h2><p>Manage individual records, images, publishing status and display order in the dedicated workspace.</p></div>
                            <div class="carousel-manager-meta"><a class="module-action" href="<?php echo e($collectionRoute); ?>">Manage content <span class="material-symbols-outlined">arrow_forward</span></a></div>
                        </section>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <section id="publishing" class="cms-card editor-card">
                            <div class="editor-card-heading"><div><span class="material-symbols-outlined">tune</span><div><h2>Publishing & SEO</h2><p>Control the page identity, visibility and search appearance.</p></div></div></div>
                            <div class="cms-grid">
                                <label><span>Page name</span><input name="title" value="<?php echo e(old('title',$page->title)); ?>" required></label>
                                <label><span>Publication status</span><select name="status"><option value="published" <?php if(old('status',$page->status)==='published'): echo 'selected'; endif; ?>>Published</option><option value="draft" <?php if(old('status',$page->status)==='draft'): echo 'selected'; endif; ?>>Draft</option></select></label>
                                <label><span>SEO title</span><input name="seo_title" maxlength="180" value="<?php echo e(old('seo_title',$page->seo_title)); ?>"><small>Leave empty to use the global SEO title.</small></label>
                                <label><span>SEO description</span><textarea name="seo_description" rows="3" maxlength="500"><?php echo e(old('seo_description',$page->seo_description)); ?></textarea><small>Recommended length: 140–160 characters.</small></label>
                            </div>
                        </section>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group=>$fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <section id="section-<?php echo e(Str::slug($group)); ?>" class="cms-card editor-card">
                            <div class="editor-card-heading"><div><span class="section-index"><?php echo e(str_pad($loop->iteration,2,'0',STR_PAD_LEFT)); ?></span><div><h2><?php echo e($group); ?></h2><p>Update this section’s content and media.</p></div></div><span class="field-count"><?php echo e(count($fields)); ?> fields</span></div>
                            <div class="cms-grid">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <?php
                                        $type=$field['type'] ?? 'text';
                                        $current=old('body.'.$field['name'],data_get($page->body,$field['name'],''));
                                        if ($type === 'repeatable' && empty($current) && !empty($field['fallback'])) {
                                            $current=collect($field['fallback'])->map(fn($key)=>data_get($page->body,$key))->filter()->values()->all();
                                        }
                                    ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type === 'media'): ?>
                                        <div class="cms-full media-field" x-data="mediaPicker(<?php echo \Illuminate\Support\Js::from($current)->toHtml() ?>)">
                                            <div class="field-label"><span><?php echo e($field['label']); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($field['help'])): ?><small><?php echo e($field['help']); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                                            <div class="media-picker">
                                                <div class="media-preview" :class="{ 'is-empty': !preview && !value }">
                                                    <img x-show="preview || value" :src="preview || value" alt="" onerror="this.style.display='none'">
                                                    <div class="media-empty"><span class="material-symbols-outlined">add_photo_alternate</span><strong>No image selected</strong><small>Upload an image or paste an image URL.</small></div>
                                                </div>
                                                <div class="media-controls">
                                                    <label class="upload-button"><span class="material-symbols-outlined">upload</span> Upload new image<input type="file" name="media[<?php echo e($field['name']); ?>]" accept="image/jpeg,image/png,image/webp,image/avif" x-on:change="choose($event)"></label>
                                                    <label><span>Or use an image URL</span><input class="media-url-input" type="text" inputmode="url" autocomplete="off" name="body[<?php echo e($field['name']); ?>]" x-model="value" x-on:input="preview=value" placeholder="https://... or /uploads/..."></label>
                                                    <div class="media-control-footer"><button class="remove-media" type="button" x-show="preview || value" x-on:click="clear()">Remove image</button><small>JPG, PNG, WebP or AVIF · Max 8 MB</small></div>
                                                </div>
                                            </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['media.'.$field['name']];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                    <?php elseif($type === 'richtext'): ?>
                                        <div class="cms-full rich-field" x-data="richEditor(<?php echo \Illuminate\Support\Js::from($current)->toHtml() ?>)">
                                            <div class="field-label"><span><?php echo e($field['label']); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($field['help'])): ?><small><?php echo e($field['help']); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                                            <div class="rich-editor">
                                                <div class="rich-toolbar" role="toolbar" aria-label="Text formatting">
                                                    <button type="button" x-on:click="format('bold')" title="Bold"><span class="material-symbols-outlined">format_bold</span></button>
                                                    <button type="button" x-on:click="format('italic')" title="Italic"><span class="material-symbols-outlined">format_italic</span></button>
                                                    <button type="button" x-on:click="block('h2')" title="Heading"><span class="material-symbols-outlined">format_h2</span></button>
                                                    <button type="button" x-on:click="format('insertUnorderedList')" title="Bullet list"><span class="material-symbols-outlined">format_list_bulleted</span></button>
                                                    <button type="button" x-on:click="format('insertOrderedList')" title="Numbered list"><span class="material-symbols-outlined">format_list_numbered</span></button>
                                                    <button type="button" x-on:click="block('blockquote')" title="Quote"><span class="material-symbols-outlined">format_quote</span></button>
                                                    <button type="button" x-on:click="format('removeFormat')" title="Clear formatting"><span class="material-symbols-outlined">format_clear</span></button>
                                                </div>
                                                <div class="rich-canvas" contenteditable="true" x-ref="editor" x-on:input="sync()"></div>
                                                <textarea class="sr-only" name="body[<?php echo e($field['name']); ?>]" x-model="value"></textarea>
                                            </div>
                                        </div>
                                    <?php elseif($type === 'repeatable'): ?>
                                        <div class="cms-full repeatable-field" x-data="repeatableParagraphs(<?php echo \Illuminate\Support\Js::from(is_array($current) ? $current : [])->toHtml() ?>, <?php echo e($field['max'] ?? 20); ?>)">
                                            <div class="repeatable-heading">
                                                <div class="field-label"><span><?php echo e($field['label']); ?></span><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($field['help'])): ?><small><?php echo e($field['help']); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></div>
                                                <button class="repeatable-add" type="button" x-on:click="add()" :disabled="items.length >= limit"><span class="material-symbols-outlined">add</span> Add paragraph</button>
                                            </div>
                                            <div class="repeatable-list">
                                                <template x-for="(item,index) in items" :key="item.id">
                                                    <div class="repeatable-item">
                                                        <div class="repeatable-item-top"><strong><?php echo e($field['item_label'] ?? 'Item'); ?> <span x-text="index + 1"></span></strong><div class="repeatable-actions"><button type="button" x-on:click="move(index,-1)" :disabled="index === 0" aria-label="Move paragraph up"><span class="material-symbols-outlined">arrow_upward</span></button><button type="button" x-on:click="move(index,1)" :disabled="index === items.length - 1" aria-label="Move paragraph down"><span class="material-symbols-outlined">arrow_downward</span></button><button class="repeatable-remove" type="button" x-on:click="remove(index)" :disabled="items.length === 1" aria-label="Remove paragraph"><span class="material-symbols-outlined">delete</span></button></div></div>
                                                        <textarea name="body[<?php echo e($field['name']); ?>][]" rows="<?php echo e($field['rows'] ?? 4); ?>" x-model="item.text" placeholder="Enter biography paragraph"></textarea>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    <?php elseif($type === 'select'): ?>
                                        <label><span><?php echo e($field['label']); ?></span><select name="body[<?php echo e($field['name']); ?>]"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue=>$optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?><option value="<?php echo e($optionValue); ?>" <?php if($current===$optionValue): echo 'selected'; endif; ?>><?php echo e($optionLabel); ?></option><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?></select><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($field['help'])): ?><small><?php echo e($field['help']); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></label>
                                    <?php elseif($type === 'textarea'): ?>
                                        <label class="cms-full"><span><?php echo e($field['label']); ?></span><textarea name="body[<?php echo e($field['name']); ?>]" rows="<?php echo e($field['rows'] ?? 5); ?>"><?php echo e($current); ?></textarea><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($field['help'])): ?><small><?php echo e($field['help']); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></label>
                                    <?php else: ?>
                                        <label><span><?php echo e($field['label']); ?></span><input name="body[<?php echo e($field['name']); ?>]" value="<?php echo e($current); ?>"><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($field['help'])): ?><small><?php echo e($field['help']); ?></small><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></label>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['body.'.$field['name']];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><small class="field-error"><?php echo e($message); ?></small><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </section>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
                <div class="cms-save editor-save"><a href="<?php echo e(route('admin.pages.index')); ?>">← All pages</a><div><span>Last updated <?php echo e($page->updated_at->diffForHumans()); ?></span><button class="module-action" type="submit"><span class="material-symbols-outlined">save</span> Save changes</button></div></div>
            </form>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\maausa\resources\views\admin\pages\edit.blade.php ENDPATH**/ ?>