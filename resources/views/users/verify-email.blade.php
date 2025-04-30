@extends('layouts.master')

@section('title', 'Verify Email - HAM Store')

@section('content')

<section class="verify-email spad" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: #111;">
    <div style="background: #222; padding: 40px; border-radius: 8px; width: 100%; max-width: 400px;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Verify Your Email Address</h2>
        @if (session('message'))
            <p style="color: #e53637; text-align: center; margin-bottom: 20px;">{{ session('message') }}</p>
        @endif
        <p style="color: #ccc; text-align: center; margin-bottom: 20px;">
            A verification link has been sent to your email address. Please check your inbox (and spam/junk folder) to verify your email.
        </p>
        <form action="{{ route('verification.send') }}" method="POST" style="margin-bottom: 20px;">
            @csrf
            <button type="submit" style="width: 100%; padding: 12px; background-color: #e53637; border: none; border-radius: 5px; color: white; font-weight: bold;">Resend Verification Email</button>
        </form>
        <a href="{{ url('/') }}" style="display: block; text-align: center; color: #e53637;">Back to Home</a>
    </div>
</section>

@endsection 

