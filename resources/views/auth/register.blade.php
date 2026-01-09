@extends('layouts.client')

@section('title', 'Client Registration')

@section('content')
    <section class="section d-flex align-items-center justify-content-center py-12" style="min-height: 80vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="card p-4 rounded-0">
                        <h3 class="card-title text-center mb-4 h3 alumni-font !text-3xl">{{ __('auth.txt_register_for_an_acc') }}</h3>
                        <form method="POST" action="{{ route('register') }}" class="">
                            @csrf

                            <div class="mb-3">
                                <label for="username" class="pb-2">{{ __('user.txt_username') }}</label>
                                <input id="username" type="text" class="rounded-0 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="pb-2">{{ __('user.txt_phone_number') }}</label>
                                <input id="phone_number" type="text" class="rounded-0 form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="first_name" class="pb-2">{{ __('user.txt_lastname') }}</label>
                                <input id="first_name" type="text" class="rounded-0 form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="last_name" class="pb-2">{{ __('user.txt_firstname') }}</label>
                                <input id="last_name" type="text" class="rounded-0 form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="pb-2">{{ __('user.txt_email') }}</label>
                                <input id="email" type="email" class="rounded-0 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="pb-2">{{ __('user.txt_password') }}</label>
                                <input id="password" type="password" class="rounded-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="pb-2">{{ __('user.txt_confirm_password') }}</label>
                                <input id="password-confirm" type="password" class="rounded-0 form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="d-grid gap-2">
                                <x-client.elements.button type="submit">
                                    {{ __('auth.txt_register') }}
                                </x-client.elements.button>
                            </div>

                            <div class="text-center mt-3">
                               {{ __('auth.txt_already_account') }} <a class="text-[var(--accent-color)]" href="{{ route('login') }}">{{ __('auth.txt_login_here') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
