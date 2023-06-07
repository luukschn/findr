@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div>

    <form action="/user/login" method="post" class="login_form" id="login-form">
        @csrf
        <table class="login-form">
            <tr>
                <td>E-mail</td>
                <td><input type="text" name="email"/></td>
            </tr>
        
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="button-primary" value="Login"/>
                </td>
            </tr>
        </table>
    </form>

    @If($errors->any())
        <br>
        <h4>{{ $errors->first() }}</h4>
        <br>
    @endif

    <a href="{{ url('/register') }}">No account yet? Register here</a>
</div>
@endsection