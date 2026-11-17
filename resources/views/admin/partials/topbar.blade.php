<header class="admin-topbar">
    <button type="button" class="admin-menu" x-on:click="navOpen = !navOpen" aria-label="Toggle sidebar"><span class="material-symbols-outlined">menu</span></button>
    <div><small>Signed in as</small><strong>{{ auth()->user()->name }}</strong></div>
    <a href="{{ route('home') }}" target="_blank">View website <span aria-hidden="true">↗</span></a>
</header>
