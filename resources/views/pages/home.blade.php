<x-layout>
    <section class="header">
        <div class="header__information">
            <h1 class="header__title">{{ __('Find your dream job') }}</h1>

            <p class="header__paragraph">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.
            </p>

            <div class="header__search-bar">
                <input class="input" type="text" placeholder="{{ __('Job Title') }}">
                <button class="button button">Search</button>
            </div>
        </div>

        <div class="header__image">
            <img src="{{ Vite::asset('resources/img/image_1.png') }}" alt="Reflection">
        </div>
    </section>

    <section class="listings">
        <h2 class="listings__title">Recent Openings</h2>

        @foreach($listings as $listing)
            <x-listing :listing="$listing"/>
        @endforeach

        <a class="button listing__button" href="">See All</a>
    </section>
</x-layout>
