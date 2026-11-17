<aside class="admin-sidebar" :class="{ 'is-open': navOpen }">
    <a class="admin-brand" href="{{ route('admin.dashboard') }}"><img src="{{ asset(ltrim($settings['logo_path'],'/')) }}" alt="MAA"><small>Administration</small></a>
    <nav aria-label="Administration">
        <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><span class="material-symbols-outlined">dashboard</span> Overview</a>
        <a class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}"><span class="material-symbols-outlined">article</span> Pages</a>
        <a class="{{ request()->routeIs('admin.navigation.*') ? 'active' : '' }}" href="{{ route('admin.navigation.index') }}"><span class="material-symbols-outlined">account_tree</span> Navigation</a>
        <a class="{{ request()->route('module') === 'programs' ? 'active' : '' }}" href="{{ route('admin.module', 'programs') }}"><span class="material-symbols-outlined">diversity_3</span> Programs</a>
        <a class="{{ request()->route('module') === 'events' ? 'active' : '' }}" href="{{ route('admin.module', 'events') }}"><span class="material-symbols-outlined">calendar_month</span> Events</a>
        <a class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}" href="{{ route('admin.gallery.index') }}"><span class="material-symbols-outlined">photo_library</span> Gallery</a>
        <a class="{{ request()->routeIs('admin.news.*') ? 'active' : '' }}" href="{{ route('admin.news.index') }}"><span class="material-symbols-outlined">newspaper</span> News & PR</a>
        <a class="{{ request()->route('module') === 'media' ? 'active' : '' }}" href="{{ route('admin.module', 'media') }}"><span class="material-symbols-outlined">perm_media</span> Media</a>
        <a class="{{ request()->route('module') === 'inquiries' ? 'active' : '' }}" href="{{ route('admin.module', 'inquiries') }}"><span class="material-symbols-outlined">mail</span> Inquiries</a>
        <span class="admin-nav-label">Configuration</span>
        <a class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.edit') }}"><span class="material-symbols-outlined">settings</span> Site settings</a>
        <a class="{{ request()->routeIs('admin.seo.*') ? 'active' : '' }}" href="{{ route('admin.seo.edit') }}"><span class="material-symbols-outlined">search</span> SEO</a>
        <a class="{{ request()->routeIs('admin.tracking.*') ? 'active' : '' }}" href="{{ route('admin.tracking.edit') }}"><span class="material-symbols-outlined">monitoring</span> Analytics & tracking</a>
        <a class="{{ request()->routeIs('admin.social.*') ? 'active' : '' }}" href="{{ route('admin.social.edit') }}"><span class="material-symbols-outlined">share</span> Social media</a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">@csrf<button type="submit"><span class="material-symbols-outlined">logout</span> Sign out</button></form>
</aside>
