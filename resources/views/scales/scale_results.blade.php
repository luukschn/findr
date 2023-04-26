@extends('layouts.app')

{{-- Add actual scale title -> probably need to save this in db or something --}}
@section('title', 'Results')

@section('content')
<p>Result: {{ $results['score'] }}</p>
<p>Average: {{ $results['average'] }}</p>
<p>Standard Deviation: {{ $results['sd'] }}</p>
<p>Score percentile: {{ $results['percentile'] }}</p>

@endsection