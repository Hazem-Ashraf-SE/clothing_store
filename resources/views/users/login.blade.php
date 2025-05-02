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
            <p style="color: #ccc; text-align: center; margin-top: 15px; margin-bottom: 15px;">Or sign in with:</p>
            <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 20px;">
                <a href="{{ route('socialite.redirect', 'google') }}" style="display: inline-block; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; background-color: #DB4437; color: white; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" title="Sign in with Google" onmouseover="this.style.boxShadow='0 5px 15px rgba(219,68,55,0.5)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 2px 5px rgba(0,0,0,0.2)'; this.style.transform='translateY(0)'">
                    <i class="fa fa-google"></i>
                </a>
                <a href="{{ route('socialite.redirect', 'facebook') }}" style="display: inline-block; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; background-color: #3b5998; color: white; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" title="Sign in with Facebook" onmouseover="this.style.boxShadow='0 5px 15px rgba(59,89,152,0.5)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 2px 5px rgba(0,0,0,0.2)'; this.style.transform='translateY(0)'">
                    <i class="fa fa-facebook"></i>
                </a>
                <a href="{{ route('socialite.redirect', 'github') }}" style="display: inline-block; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; background-color: #333; color: white; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" title="Sign in with Github" onmouseover="this.style.boxShadow='0 5px 15px rgba(51,51,51,0.5)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 2px 5px rgba(0,0,0,0.2)'; this.style.transform='translateY(0)'">
                    <i class="fa fa-github"></i>
                </a>
                <a href="{{ route('socialite.redirect', 'twitter') }}" style="display: inline-block; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; background-color: #1DA1F2; color: white; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" title="Sign in with Twitter" onmouseover="this.style.boxShadow='0 5px 15px rgba(29,161,242,0.5)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 2px 5px rgba(0,0,0,0.2)'; this.style.transform='translateY(0)'">
                    <i class="fa fa-twitter"></i>
                </a>
                <a href="{{ route('socialite.redirect', 'linkedin') }}" style="display: inline-block; width: 40px; height: 40px; line-height: 40px; text-align: center; border-radius: 50%; background-color: #0077b5; color: white; transition: all 0.3s ease; box-shadow: 0 2px 5px rgba(0,0,0,0.2);" title="Sign in with LinkedIn" onmouseover="this.style.boxShadow='0 5px 15px rgba(0,119,181,0.5)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='0 2px 5px rgba(0,0,0,0.2)'; this.style.transform='translateY(0)'">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
            <p style="color: #ccc; text-align: center; margin-top: 15px;">Dont't have an account? <a href="{{ url('/register') }}" style="color: #e53637;">Sign Up</a></p>
        </form>
    </div>
</section>
@endsection