@extends('layouts.master')

@section('title', 'Home - HAM Store')

@section('content')

<div style="text-align: center; margin-top: 100px;">
    <h2 style="color: white;">Coming Soon</h2>
    <a href="{{ url('/') }}" style="margin-top: 20px; display: inline-block; background-color: #ff4c4c; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: bold;">
        Back to Home
    </a>
</div>
<div style="text-align: center; margin-top: 20px;">
    <img src="{{ asset('img/coming-soon.jpg') }}" alt="Coming Soon" style="max-width: 100%; height: auto; margin-top: 20px;">



@endsection