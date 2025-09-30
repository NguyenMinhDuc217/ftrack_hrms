@extends('layouts.client')

@section('title', 'Client Login')

@section('content')
    <section class="section d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="card p-4">
                        <h3 class="card-title text-center mb-4">Login to Your Account</h3>
                        <form method="POST" action="{{ route('login') }}" class="">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="pb-2">Email Address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="pb-2">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Remember Me
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>

                            <div class="text-center mt-3">
                                Don't have an account? <a href="{{ route('register') }}">Register here</a>
                            </div>
                            {{-- Optionally add forgot password link if you implement it later --}}
                            {{-- <div class="text-center mt-2">
                                <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection