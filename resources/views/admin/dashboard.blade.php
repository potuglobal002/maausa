@extends('layouts.admin')

@section('title', 'Dashboard | MAA Administration')

@section('content')
<div class="admin-shell" x-data="{ navOpen: false }">
    @include('admin.partials.sidebar')

    <main class="admin-main">
        @include('admin.partials.topbar')

        <div class="admin-content">
            <div class="admin-heading"><div><p class="eyebrow">Administration</p><h1>Good to see you, {{ str(auth()->user()->name)->before(' ') }}.</h1><p>Here is an overview of the MAA website and community activity.</p></div><span>{{ now()->format('F j, Y') }}</span></div>

            <section class="admin-stats" aria-label="Website statistics">
                @foreach([
                    ['Pages', $stats['pages'], 'Published and draft content'],
                    ['Programs', $stats['programs'], 'Support programs'],
                    ['Events', $stats['events'], 'Upcoming and past events'],
                    ['New inquiries', $stats['inquiries'], 'Waiting for attention'],
                    ['Active staff', $stats['staff'], 'Authorized accounts'],
                ] as [$label, $value, $description])
                    <article><span>{{ $loop->iteration < 10 ? '0'.$loop->iteration : $loop->iteration }}</span><strong>{{ $value }}</strong><h2>{{ $label }}</h2><p>{{ $description }}</p></article>
                @endforeach
            </section>

            <section class="admin-welcome-card">
                <div><p class="eyebrow eyebrow--light">Website control center</p><h2>Your MAA content and configuration workspace is connected.</h2><p>Manage pages, navigation, branding, SEO, analytics, social links and community content from this dashboard.</p></div>
                <a class="button button--light" href="{{ route('home') }}" target="_blank">Review homepage <span>→</span></a>
            </section>
        </div>
    </main>
</div>
@endsection
