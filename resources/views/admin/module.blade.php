@extends('layouts.admin')

@section('title', $config['title'].' | MAA Administration')

@section('content')
<div class="admin-shell" x-data="{ navOpen: false }">
    @include('admin.partials.sidebar')

    <main class="admin-main">
        @include('admin.partials.topbar')

        <div class="admin-content">
            <div class="module-heading">
                <div><p class="eyebrow">Content management</p><h1>{{ $config['title'] }}</h1><p>{{ $config['description'] }}</p></div>
                @if($config['action'])<button type="button" class="module-action">＋ {{ $config['action'] }}</button>@endif
            </div>

            <section class="module-toolbar" aria-label="Module controls">
                <label><span>Search</span><input type="search" placeholder="Search {{ strtolower($config['title']) }}…"></label>
                <div><button type="button">Filter</button><button type="button">Newest first</button></div>
            </section>

            <section class="module-table-wrap">
                <div class="module-table-head">
                    @foreach($config['columns'] as $column)<strong>{{ $column }}</strong>@endforeach
                </div>

                @if($count === 0)
                    <div class="module-empty">
                        <span>{{ match($module) { 'pages' => '□', 'programs' => '◫', 'resources' => '◇', 'events' => '▦', 'media' => '▧', 'inquiries' => '✉', default => '⚙' } }}</span>
                        <h2>No {{ strtolower($config['title']) }} yet</h2>
                        <p>This module is connected and ready for its first record.</p>
                        @if($config['action'])<button type="button" class="module-action">＋ {{ $config['action'] }}</button>@endif
                    </div>
                @endif
            </section>
        </div>
    </main>
</div>
@endsection
