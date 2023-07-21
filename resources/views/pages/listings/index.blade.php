@php
    use App\Models\Tag;
@endphp

<x-layout>
    <div class="listings">
        <h1 class="listings__title">Listings ({{ $listings->total() }})</h1>

        <form class="filter" action="{{ route('listings.index') }}" method="GET">
            <input class="input" name="title" type="text" placeholder="Title" value="{{ request()->input('title') }}">

            <input class="input" name="salary" type="number" step="1" min="0" placeholder="Salary" value="{{ request
            ()->input('salary') }}">

            <input class="input" name="tags" type="text" placeholder="Tags ex: php, react, css" value="{{ request()
            ->input('tags') }}">

            <select class="select-multiple input" name="orderBy">
                <option value="" selected hidden="">Order By</option>
                <option value="title" {{ request()->input('orderBy') == 'title' ? 'selected': '' }}>Title</option>
                <option value="salary" {{ request()->input('orderBy') == 'salary' ? 'selected': '' }}>Salary</option>
                <option value="created_at" {{ request()->input('orderBy') == 'created_at' ? 'selected': ''
                }}>Date</option>
            </select>

            <select class="input" name="direction">
                <option value="" selected hidden="">Direction</option>
                <option value="asc" {{ request()->input('direction') === 'asc' ? 'selected' : '' }}>Ascendant</option>
                <option value="desc" {{ request()->input('direction') === 'desc' ? 'selected' : ''
                }}>Descendant</option>
            </select>

            <select class="input" name="results">
                <option value="5" {{ request()->input('results') === '5' ? 'selected' : '' }}>5</option>
                <option value="10" {{ request()->input('results') === '10' ? 'selected' : '' }} selected>10</option>
                <option value="20" {{ request()->input('results') === '20' ? 'selected' : ''
                }}>20</option>
            </select>

            <button class="button button--secondary" type="submit">Search</button>
        </form>

        @foreach($listings as $listing)
            <x-listing :listing="$listing"/>
        @endforeach

        {{ $listings->links() }}
    </div>
</x-layout>
