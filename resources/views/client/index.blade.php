@extends('layouts.client')

@section('title', 'Index - eNno Bootstrap Template')
@section('description', 'Elegant and creative solutions with eNno Bootstrap Template.')
@section('keywords', 'bootstrap, template, eNno, web design, development')

@section('content')
  @push('scripts')
    <script>

      window.filterJobs = function(key = null, val = null) {
        const search = $('#search').val();
        const province_code_name = $('#listProvince option:selected').val();
        let profession_slug = $('#profession_slug').val();

        let url = new URL(window.location.href)
        let slugs = [];

        console.log(profession_slug);
        if (key == 'profession_slug' && val != null) {
          slugs.push(val);
        }
        
        if (province_code_name) {
            url.searchParams.set('province_code_name', province_code_name);
        }
        if (search) {
            url.searchParams.set('search', search);
        }

        $list_profession = $('#list-filter-profession').children();
        if ($list_profession.length > 0) {
          $list_profession.each(function() {
            var id = $(this).attr('id').replace('profession_tag_', '');
            if (id) {
              slugs.push(id);
            }
          });
        }
        if (slugs.length > 0) {
          let uniqueSLugs = [...new Set(slugs)];
          url.searchParams.set('profession_slug', uniqueSLugs.join(','));
        } else {
          url.searchParams.delete('profession_slug');
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
