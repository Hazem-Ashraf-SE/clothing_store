@extends('layouts.master')

@section('title', 'Login - HAM Store')

@section('content')
<section class="login spad" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; background-color: #111;">
    <div style="background: #222; padding: 40px; border-radius: 8px; width: 100%; max-width: 400px;">
        <h2 style="color: #fff; text-align: center; margin-bottom: 30px;">Sign In</h2>
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
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required style="width: 100%; padding: 12px; border: none; border-radius: 5px; background: #333; color: #fff;">
            </div>
            <div style="margin-bottom: 20px;">
                <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border: none; border-radius: 5px; background: #333; color: #fff;">
            </div>
            <button type="submit" style="width: 100%; padding: 12px; background-color: #e53637; border: none; border-radius: 5px; color: white; font-weight: bold;">Sign In</button>
            <p style="color: #ccc; text-align: center; margin-top: 15px;">
                Don't have an account? <a href="{{ route('register') }}" style="color: #e53637;">Register</a>
            </p>
            <p style="color: #ccc; text-align: center; margin-top: 10px;">
                Forgot your password? <a href="{{ route('password.request') }}" style="color: #e53637;">Reset Password</a>
            </p>
        </form>
    </div>
</section>
@endsection