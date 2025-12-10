@extends('layouts.client')

@section('title', 'Index - eNno Bootstrap Template')
@section('description', 'Elegant and creative solutions with eNno Bootstrap Template.')
@section('keywords', 'bootstrap, template, eNno, web design, development')

@section('content')
  @push('scripts')
    <script>
      window.filterJobs = function(key, val) {
        console.log(key, val);
        const url = new URL(window.location)
        if (val === '' || val === null || val === undefined) {
          url.searchParams.delete(key);
        } else {
          url.searchParams.set(key, val);
        }
        window.location.href = url.toString();
      };
    </script>
  @endpush
  <!-- Hero Section -->
  <section id="hero" class="hero section">

  @include('client.home.index')

  </section><!-- /Hero Section -->

@endsection
