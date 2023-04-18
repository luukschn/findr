@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <h3> Insert your details to register.</h3>

    <div>
        <form action="/user/register" method="post" class="registration_form">
            @csrf

            {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

            <table class="registration-form">
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" /></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td><input type="submit" value="register" /></td>
                </tr>
            </table>
        </form>

        @if($errors->any())
            <br>
            <p>{{ $errors->first() }}</p>
        @endif
        
    </div>

@endsection