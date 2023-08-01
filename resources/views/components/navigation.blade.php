<nav class="navbar">
    <a class="navbar__logo" href="{{ route('home') }}">Job Board</a>

    <div class="navbar__links">
        @guest()
            <a class="navbar__link" href="">Log In</a>
        @endguest

        <a class="button" href="{{ route('listings.create') }}">
            Post a job
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</nav>
