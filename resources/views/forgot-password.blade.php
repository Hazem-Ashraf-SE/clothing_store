@extends('layouts.master')

@section('title', 'Forgot Password - HAM Store')

@section('content')
<section class="forgot-password spad" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: #111;">
    <div style="background: #222; padding: 40px; border-radius: 8px; width: 100%; max-width: 400px;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Forgot Password</h2>
        @if (session('status'))
            <p style="color: #e53637; text-align: center; margin-bottom: 20px;">{{ session('status') }}</p>
        @endif
        @if ($errors->any())
            <ul style="color: #e53637; text-align: center; margin-bottom: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width: 100%; padding: 12px; border: none; border-radius: 5px; background: #333; color: #fff;">
            </div>
            <button type="submit" style="width: 100%; padding: 12px; background-color: #e53637; border: none; border-radius: 5px; color: white; font-weight: bold;">Send Reset Link</button>
        </form>
        <p style="color: #ccc; text-align: center; margin-top: 15px;">
            Remember your password? <a href="{{ route('login') }}" style="color: #e53637;">Sign In</a>
        </p>
    </div>
</section>
@endsection