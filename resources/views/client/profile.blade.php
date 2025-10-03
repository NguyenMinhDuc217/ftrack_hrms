@extends('layouts.client')

@section('title', 'Client Profile')

@section('content')
    <section id="client-profile" class="section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2>Your Profile</h2>
                    <p>Manage your personal information.</p>

                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">User Details</h5>
                            <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            {{-- Add more profile details or an edit form here --}}
                            <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

