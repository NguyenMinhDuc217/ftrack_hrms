@extends('layouts.client')

@section('title', 'Client Dashboard')

@section('content')
    <section id="client-dashboard" class="section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h2>Welcome to Your Dashboard, {{ Auth::user()->name }}!</h2>
                    <p>This is your personalized area where you can manage your account and access special features.</p>

                    <div class="mt-4">
                        <h3>Your Features:</h3>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-person-fill me-2"></i> <a href="{{ route('client.profile') }}">View/Edit Profile</a></li>
                            <li><i class="bi bi-box-seam me-2"></i> <a href="#">My Orders</a></li>
                            <li><i class="bi bi-gear-fill me-2"></i> <a href="#">Settings</a></li>
                            {{-- Add more client-specific features here --}}
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="mt-5">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection