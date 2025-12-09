@extends('layouts.admin')

@section('title', 'Admin Dashboard - Users')
@section('page_title') 
  {{ __('user.txt_add_user') }}
@endsection

@section('content')
  <!-- [ Main Content ] start -->
  <div class="row">
    <!-- [ sample-page ] start -->
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h3>{{ __('user.txt_add_user') }}</h3>
        </div>
        <form action="{{ route('admin.blog.store') }}" method="POST" class="form-horizontal">
          @csrf
          <!-- <div class="card-body">
            <div class="form-group">
              <label class="form-label" for="username">{{ __('user.txt_username') }}</label>
              <input 
                type="text" 
                class="form-control @error('username') is-invalid @enderror" 
                name="username" 
                placeholder="{{ __('user.txt_username') }}" 
                id="username"
                value="{{ old('username') }}"
              >
              @error('username')
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </div>
              @enderror
              <small>{{ __('default.maxlength_set_to_characters', ['length' => 100]) }}</small>
            </div> -->
       

           

           
           
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success me-2">{{__('default.button_add')}}</button>
            <button type="reset" class="btn btn-light">{{__('default.button_reset')}}</button>
          </div>
        </form>
      </div>

    </div>
    <!-- [ sample-page ] end -->
  </div>
  <!-- [ Main Content ] end -->
@endsection