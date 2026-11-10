@extends('layouts.public')

@section('title', 'Site settings')

@section('content')
<section class="section-shell">
    <div class="container" style="max-width:850px">
        <p><a href="{{ route('admin.dashboard') }}">← Dashboard</a></p>
        <h1>Site settings</h1>
        <p>Personalize the public experience without editing Blade templates.</p>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}">
            @csrf
            @method('PUT')
            @php($fields = [
                'site_title' => 'Website title',
                'recipient_name' => 'Birthday recipient name',
                'sender_name' => 'Your name / sender',
                'birthday_date' => 'Birthday date',
                'intro_heading' => 'Intro heading',
                'intro_message' => 'Intro message',
                'contact_email' => 'Public contact email',
                'notification_email' => 'Admin notification email',
                'share_message' => 'Share message',
            ])
            @foreach($fields as $key => $label)
                <div class="mb-3">
                    <label class="form-label" for="{{ $key }}">{{ $label }}</label>
                    @if(in_array($key, ['intro_message', 'share_message']))
                        <textarea class="form-control" rows="3" name="{{ $key }}" id="{{ $key }}">{{ old($key, $settings[$key] ?? '') }}</textarea>
                    @else
                        <input class="form-control" id="{{ $key }}" name="{{ $key }}"
                            type="{{ $key === 'birthday_date' ? 'date' : (str_contains($key, 'email') ? 'email' : 'text') }}"
                            value="{{ old($key, $settings[$key] ?? '') }}">
                    @endif
                </div>
            @endforeach
            <button class="btn btn-dark" type="submit">Save settings</button>
        </form>
    </div>
</section>
@endsection
