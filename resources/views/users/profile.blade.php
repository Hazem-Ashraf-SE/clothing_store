@extends('layouts.master')

@section('title', 'Profile - HAM Store')

@section('content')

<section class="profile spad" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: #111;">
    <div style="background: #222; padding: 40px; border-radius: 8px; width: 100%; max-width: 400px;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Your Profile</h2>
        <div style="color: #fff; margin-bottom: 20px;">
            <strong>Name:</strong> {{ Auth::user()->name }}
        </div>
        <div style="color: #fff; margin-bottom: 20px;">
            <strong>Email:</strong> {{ Auth::user()->email }}
        </div>
        <a href="{{ url('/') }}" style="display: block; text-align: center; color: #e53637; margin-top: 20px;">Back to Home</a>
    </div>
</section>

@endsection