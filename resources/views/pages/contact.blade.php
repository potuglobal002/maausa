@extends('layouts.public')
@section('title', 'Contact Us | MAA')

@section('page-content')
@include('pages.partials.page-hero', ['eyebrow' => $content['hero_eyebrow'], 'title' => $content['hero_title'], 'description' => $content['hero_description']])

<section class="section contact-page">
    <div class="container contact-layout">
        <aside><p class="eyebrow">Contact information</p><h2>We’re here to help.</h2><div class="contact-detail"><span>01</span><div><small>Address</small><strong>{!! nl2br(e($settings['address'])) !!}</strong></div></div><div class="contact-detail"><span>02</span><div><small>Phone</small><a href="tel:{{ $settings['phone_link'] }}">{{ $settings['phone'] }}</a></div></div><div class="contact-detail"><span>03</span><div><small>Email</small><a href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a></div></div></aside>

        <div class="contact-form-card">
            <p class="eyebrow">Send a message</p><h2>{{ $content['form_title'] }}</h2>
            @if(session('success'))<div class="form-success" role="status">{{ session('success') }}</div>@endif
            <form method="POST" action="{{ route('contact.submit') }}">@csrf
                <div class="form-grid"><label><span>Your name</span><input name="name" value="{{ old('name') }}" required></label><label><span>Email address</span><input name="email" type="email" value="{{ old('email') }}" required></label></div>
                <div class="form-grid"><label><span>Phone number <em>Optional</em></span><input name="phone" value="{{ old('phone') }}"></label><label><span>Subject</span><input name="subject" value="{{ old('subject') }}" required></label></div>
                <label><span>Your message</span><textarea name="message" rows="6" required>{{ old('message') }}</textarea></label>
                <label class="consent-row"><input type="checkbox" name="consent" value="1" required><span>I agree that MAA may use this information to respond to my inquiry.</span></label>
                @if($errors->any())<div class="field-error">Please check the highlighted fields and try again.</div>@endif
                <button class="button button--primary button--large" type="submit">Send message <span>→</span></button>
            </form>
        </div>
    </div>
</section>
@endsection
