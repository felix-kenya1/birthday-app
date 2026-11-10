@extends('layouts.public')

@section('title', 'A little world made for you')
@section('description', 'Someone very special deserves something extraordinary.')

@section('content')
<section class="welcome-screen">
    <div class="welcome-orbit orbit-one"></div>
    <div class="welcome-orbit orbit-two"></div>
    <div class="welcome-content container text-center">
        <span class="eyebrow">A LITTLE WORLD, CREATED WITH LOVE</span>
        <div class="welcome-flower" aria-hidden="true">✿</div>
        <h1>Someone very special<br>deserves <em>something extraordinary.</em></h1>
        <p class="welcome-copy">This little world was created with love, just for you. Take your time, explore, and let every moment remind you how wonderfully special you are.</p>
        <a class="btn btn-rose btn-lg" href="{{ route('birthday.show') }}">Open your surprise <span aria-hidden="true">♡</span></a>
        <div class="welcome-note">A birthday made just for you</div>
    </div>
    <span class="floating-heart heart-a">♡</span>
    <span class="floating-heart heart-b">♥</span>
    <span class="floating-heart heart-c">♡</span>
</section>
@endsection
