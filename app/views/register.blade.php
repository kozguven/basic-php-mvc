@extends('layout')

@section('title', 'Register')

@section('content')
    <h1 class="text-center">Register</h1>
    <form action="/register" method="post">
        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection