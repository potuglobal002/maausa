@extends('layouts.app')

@section('title', ucfirst(str_replace('-', ' ', $page)).' | MAA')

@section('content')
<main class="placeholder-page">
    <a class="brand brand--dark" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset(ltrim($settings['logo_path'],'/')) }}" alt="{{ $settings['site_name'] }}"></a>
    <div>
        <p class="eyebrow">Page in development</p>
        <h1>{{ ucfirst(str_replace('-', ' ', $page)) }}</h1>
        <p>This page shell is ready and will be connected to the MAA content system during the next development phase.</p>
        <a class="button button--primary" href="{{ route('home') }}">Return home <span>→</span></a>
    </div>
</main>
@endsection
