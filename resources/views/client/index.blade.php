@extends('layouts.client')

@section('title', 'Index - eNno Bootstrap Template')
@section('description', 'Elegant and creative solutions with eNno Bootstrap Template.')
@section('keywords', 'bootstrap, template, eNno, web design, development')

@section('content')
  @push('scripts')
    <script>
      // window.filterJobs = function(key, val) {
      //   console.log(key, val);
      //   const url = new URL(window.location)
      //   if (val === '' || val === null || val === undefined) {
      //     url.searchParams.delete(key);
      //   } else {
      //     url.searchParams.set(key, val);
      //   }
      //   window.location.href = url.toString();
      // };

      window.filterJobs = function(key = null, val = null) {
        const search = $('#search').val();
        const province_id = $('#listProvince option:selected').val();
        let profession_id = $('#profession_id').val();

        if (key == 'profession_id' && val != null) {
          profession_id = val;
        }

        let url = new URL(window.location);
        if (search) {
            url.searchParams.set('search', search);
        } else {
            if (url.searchParams.has('search')) {
                url.searchParams.delete('search');
            }
        }
        if (province_id) {
            url.searchParams.set('province_id', province_id);
        } else {
            if (url.searchParams.has('province_id')) {
                url.searchParams.delete('province_id');
            }
        }
        if (profession_id) {
            url.searchParams.set('profession_id', profession_id);
        } else {
            if (url.searchParams.has('profession_id')) {
                url.searchParams.delete('profession_id');
            }
        }
        window.location.href = url.toString();
      }
    </script>
  @endpush
  <!-- Hero Section -->
  <section id="hero" class="hero section">

  @include('client.home.index')

  </section><!-- /Hero Section -->

@endsection
