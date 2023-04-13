<div id="header-content">
    <div id="header-links-container">

        <a id="header-home-link" href="{{ url('/') }}"><img src="https://cdn-icons-png.flaticon.com/512/25/25694.png"></a>

        <a id="header-about" href="{{ url('/about') }}">About</a>

        <a id="header-research" href="{{ url('/research') }}">Research basis</a>

        <a id="header-finder" href="{{ url('/finder') }}">Friend Finder</a>

        
        @auth 
            <a id="header-profile" href="{{ url('/profile/' . Auth::id()) }}">Profile Page</a>
        @else
            <a id="header-login" href="{{ url('/login') }}">Login</a>
        @endauth

    </div>
</div>