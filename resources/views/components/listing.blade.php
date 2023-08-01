@props(['listing'])

<div class="listing">
    <div class="listing__logo">
        @if($listing->logo)
            <img src="{{ '/storage/' . $listing->logo }}" alt="">
        @else
            <i class="fa-regular fa-building"></i>
        @endif
    </div>

    <div class="listing__info">
        <div class="listing__info--left">
            <h3 class="listing__title">
                {{ $listing->title }}
            </h3>

            <p class="listing__company">{{ $listing->company }}</p>

            <span>{{ $listing->contract_type }}</span>
        </div>

        <div class="listing__info--right">
            <span class="listing__tags">
                @foreach($listing->tags as $tag)
                    <span>{{ $tag->name}}</span>
                @endforeach
            </span>

            <div>
                <span class="listing__location">
                    <i class="fa-solid fa-globe"></i>
                    {{ $listing->location }}
                </span>

                <span class="listing__date">
                    <i class="fa-regular fa-calendar-days"></i>
                    {{ $listing->created_at->diffForHumans() }}
                </span>
            </div>

            <span class="listing__salary">
                    <i class="fa-regular fa-dollar-sign"></i>
                    {{ number_format($listing->salary, 0, ',') }}
            </span>
        </div>
    </div>
</div>
