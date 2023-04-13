@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div id="homepage-parent">
    <div class='child inline-block-child'>
        <h3>Placeholder explanatory content</h3>
        <p>Loneliness video. Research what data gets taken if i embedd the video. Maybe better not to.:</p>
        <p>https://youtu.be/VpOan0hqdNA</p>
    </div>
    @auth
    <div class='child inline-block-child'>
        <table id="friend-listings">
            <tr>
                <td>listing 1 example</td>
            </tr>
            <tr>
                <td>listing 2 example</td>
            </tr>
        </table>
    </div>
    @endauth
</div>
@endsection