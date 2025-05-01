@extends('layouts.master')

@section('title', 'Profile - HAM Store')

@section('content')

<section class="profile spad" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: #111;">
    <div style="background: #222; padding: 40px; border-radius: 8px; width: 100%; max-width: 400px;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Your Profile</h2>
        
        @if (session('status'))
            <div style="color: #fff; background-color: #28a745; padding: 10px; border-radius: 5px; margin-bottom: 20px; text-align: center;">
                {{ session('status') }}
            </div>
        @endif
        
        <div style="color: #fff; margin-bottom: 20px;">
            <strong>Name:</strong> {{ Auth::user()->name }}
        </div>
        <div style="color: #fff; margin-bottom: 20px;">
            <strong>Email:</strong> {{ Auth::user()->email }}
        </div>
        
        @if (Auth::user()->provider)
            <div style="color: #fff; margin-bottom: 20px;">
                <strong>Login Method:</strong> {{ ucfirst(Auth::user()->provider) }}
            </div>
        @endif
        
        <div style="margin-top: 30px;">
            <a href="{{ url('/') }}" style="display: block; text-align: center; color: #e53637; margin-top: 20px;">Back to Home</a>
        </div>
    </div>
</section>

@endsection