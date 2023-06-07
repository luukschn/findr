<div id="header-content">
    <div id="header-links-container" class='header-links'>

        <a id="header-home-link" href="{{ url('/') }}"><img src="https://cdn-icons-png.flaticon.com/512/25/25694.png"></a>

        <a class='header-link' id="header-about" href="{{ url('/about') }}">About</a>

        <a class='header-link' id="header-research" href="{{ url('/research') }}">Research basis</a>

        <a class='header-link' id="header-finder" href="{{ url('/finder') }}">Friend Finder</a>

        
        @auth 
            <a class='header-link' id="header-profile" href="{{ url('/profile/' . Auth::id()) }}">Profile Page</a>
        @else
            <a class='header-link' id="header-login" href="{{ url('/login') }}">Login</a>
        @endauth

    </div>
</div>