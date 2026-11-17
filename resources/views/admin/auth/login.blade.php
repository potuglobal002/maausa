@extends('layouts.admin')

@section('title', 'Staff Login | MAA')

@section('content')
<main class="admin-login-shell">
    <section class="admin-login-brand">
        <a class="brand" href="{{ route('home') }}"><img class="brand-logo" src="{{ asset(ltrim($settings['logo_path'],'/')) }}" alt="{{ $settings['site_name'] }}"></a>
        <div>
            <p class="eyebrow eyebrow--light">Staff administration</p>
            <h1>Manage support with clarity and care.</h1>
            <p>Secure access for MAA staff to manage website content, programs, events and community inquiries.</p>
        </div>
        <small>Authorized staff access only</small>
    </section>

    <section class="admin-login-form-wrap">
        <div class="admin-login-form">
            <p class="eyebrow">Welcome back</p>
            <h2>Sign in to MAA</h2>
            <p class="form-intro">Use your staff account to continue to the dashboard.</p>

            <form method="POST" action="{{ route('admin.login.store') }}">
                @csrf
                <label for="email">Email address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                @error('email')<p class="field-error">{{ $message }}</p>@enderror

                <div class="label-row"><label for="password">Password</label></div>
                <input id="password" name="password" type="password" autocomplete="current-password" required>
                @error('password')<p class="field-error">{{ $message }}</p>@enderror

                <label class="remember-row"><input type="checkbox" name="remember" value="1"><span>Keep me signed in on this device</span></label>
                <button class="admin-submit" type="submit">Sign in <span>→</span></button>
            </form>

            <a class="back-link" href="{{ route('home') }}">← Return to website</a>
        </div>
    </section>
</main>
@endsection
