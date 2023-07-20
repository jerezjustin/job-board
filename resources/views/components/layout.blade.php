<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
    <title>@yield('title', 'Job Board | Find your dream job')</title>
</head>
<body>
<x-navigation/>

<main>
    {{$slot}}
</main>

@include('includes.footer')
</body>
</html>
