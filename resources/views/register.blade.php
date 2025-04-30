@extends('layouts.master')

@section('title', 'Register - HAM Store')

@section('content')

<section class="register spad" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: #111;">
    <div style="background: #222; padding: 40px; border-radius: 8px; width: 100%; max-width: 400px;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Create Account</h2>
        @if ($errors->any())
            <ul style="color: #e53637; text-align: center; margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (session('status'))
            <p style="color: #e53637; text-align: center; margin-bottom: 20px;">{{ session('status') }}</p>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required style="width: 100%; padding: 12px; border: none; border-radius: 5px; background: #333; color: #fff;">
            </div>
            <div style="margin-bottom: 20px;">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width: 100%; padding: 12px; border: none; border-radius: 5px; background: #333; color: #fff;">
            </div>
            <div style="margin-bottom: 20px;">
                <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border: none; border-radius: 5px; background: #333; color: #fff;">
            </div>
            <div style="margin-bottom: 20px;">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required style="width: 100%; padding: 12px; border: none; border-radius: 5px; background: #333; color: #fff;">
            </div>
            <button type="submit" style="width: 100%; padding: 12px; background-color: #e53637; border: none; border-radius: 5px; color: white; font-weight: bold;">Register</button>
            <p style="color: #ccc; text-align: center; margin-top: 15px;">Already have an account? <a href="{{ url('/login') }}" style="color: #e53637;">Sign In</a></p>
        </form>
    </div>
</section>

@endsection