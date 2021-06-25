@extends('auth.layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

<form method="post" class="login-form" action="{{ route('authenticate') }}">

<h1>Login</h1>

@if(session()->has('error'))
                   <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
 @endif          
        
        @csrf
        <div class="txtb">
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <span data-placeholder="email"></span>
        </div>
        <div class="txtb">
        <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <span data-placeholder="Password"></span>
        </div>
        <input type="submit" class="logbtn" value="login">
   </form> 
</div>
</div>


@endsection