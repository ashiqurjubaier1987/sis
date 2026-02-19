@extends('mail.layouts.app')

@section('title', 'Reset Password')

@section('content')
<h3>Hello {{ $user->name }},</h3>

<p>You requested a password reset. Click below to continue.</p>

<div class="btn-wrapper">
    <a href="{{ $resetUrl }}" class="btn">Reset Password</a>
</div>

<p>This link will expire in {{ config('auth.passwords.users.expire') }} minutes.</p>
<p>If you didn’t request this, you can ignore this email.</p>
<p>Regards</p>
<p><strong>{{ config('app.name') }} Team</strong></p>
@endsection

@section('sub-content')
    <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:{{ $resetUrl }}</p>
@endsection