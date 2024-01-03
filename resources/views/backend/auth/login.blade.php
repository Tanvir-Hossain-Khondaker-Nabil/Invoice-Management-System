@extends('backend.auth.layouts.master')

@section('content')
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="username" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
        @error('email')
        <code>*{{$message}}</code>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group auth-pass-inputgroup">
            <input type="password" name="password" class="form-control" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
        </div>
        @error('password')
        <code>*{{$message}}</code>
        @enderror
    </div>

    
    <div class="mt-5 d-grid">
        <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
    </div>

</form>
@endsection