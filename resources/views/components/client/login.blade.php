<div class="card p-4">
    <h3 class="card-title text-center mb-4">Login to Your Account</h3>
    {{-- GOOGLE LOGIN BUTTON --}}
    <div class="d-grid gap-2 mb-3">
        <a href="{{ route('google.redirect') }}"
            class="btn btn-light border d-flex align-items-center justify-content-center gap-2 py-2">

            {{-- Google SVG Icon --}}
            <svg class="me-2" width="20" height="20" viewBox="0 0 48 48">
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.23 9.21 3.25l6.86-6.86C35.9 2.41 30.41 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.99 6.21C12.47 13.02 17.74 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.5 24.5c0-1.57-.14-3.08-.41-4.55H24v9.02h12.7c-.55 2.96-2.23 5.47-4.74 7.16l7.63 5.93C43.9 37.64 46.5 31.55 46.5 24.5z"/>
                <path fill="#FBBC05" d="M10.55 28.43A14.47 14.47 0 0 1 9.5 24c0-1.54.27-3.03.76-4.43l-7.99-6.21A23.86 23.86 0 0 0 0 24c0 3.84.91 7.47 2.53 10.68l8.02-6.25z"/>
                <path fill="#34A853" d="M24 48c6.41 0 11.82-2.11 15.76-5.73l-7.63-5.93C29.95 37.78 27.17 38.5 24 38.5c-6.26 0-11.53-3.52-13.45-8.93l-8.02 6.25C6.51 42.62 14.62 48 24 48z"/>
            </svg>

            Login with Google
        </a>
    </div>
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
            <button type="submit" class="btn bg-[#10BC69] hover:bg-[#10BC69] text-white">Login</button>
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