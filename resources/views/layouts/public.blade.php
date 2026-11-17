@extends('layouts.app')

@section('content')
    @include('pages.partials.header')
    <main id="main-content">@yield('page-content')</main>
    @include('pages.partials.footer')
@endsection
