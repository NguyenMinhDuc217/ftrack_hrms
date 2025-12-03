@extends('layouts.client')

@section('title', 'Index - eNno Bootstrap Template')
@section('description', 'Elegant and creative solutions with eNno Bootstrap Template.')
@section('keywords', 'bootstrap, template, eNno, web design, development')

@section('content')
  <!-- Hero Section -->
  <section id="hero" class="hero section">

  @include('client.home.index')

  </section><!-- /Hero Section -->

@endsection