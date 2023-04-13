@extends('layouts.app')

@section('title', 'About')

@section('content')
<div>
    <h3>About</h3>

    <a href="{{ route('scale', ['scaleId' => 1]) }}">Take the Loneliness Scale </p>
</div>
@endsection