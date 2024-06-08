@extends('layout')

@section('title', 'Profile')

@section('content')
    <h1 class="text-center">Profile</h1>
    <p class="text-center">User ID: {{ $user['id'] }}</p>
    <p class="text-center">Username: {{ $user['username'] }}</p>
    <p class="text-center">Created at: {{ $user['created_at'] }}</p>
@endsection