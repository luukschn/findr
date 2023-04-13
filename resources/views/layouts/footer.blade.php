<div id="footer-content">
    <ul id="footer-links">
        <li><b>Links</b></li>
        <li><a id="footer-home-link" href="{{ url('/') }}">Home</a></li>
        <li><a id="footer-about" href="{{ url('/about') }}">About</a></li>
        <li><a id="footer-research" href="{{ url('/research') }}">Research basis</a></li>
        <li><a id="footer-finder" href="{{ url('/finder') }}">Friend Finder</a></li>
        @auth
            <li><a id="footer-profile" href="{{ url('/profile/{id}') }}">Profile page</a></li>
        @else
            <li><a id="footer-login" href="{{ url('/login') }}">Login</a></li>
        @endauth
    </ul>

    <p>Name Placeholder - email@placeholder.com</p>
</div>
