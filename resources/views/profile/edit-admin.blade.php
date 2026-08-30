@extends('layouts.admin')

@section('title', 'Profil Saya')
@section('page_title', 'Profil Saya')
@section('page_description', 'Kelola informasi profil dan pengaturan keamanan akun Anda.')

@section('content')
<div class="max-w-4xl space-y-8 pb-12">
    @include('profile.content')
</div>
@endsection
