@props(['title'])

<x-layout :title="$title">
    <header>
        <x-navigation />
    </header>

    {{ $slot }}

    <footer>
        <div class="container-wide">
            <div>
                <strong>{{ config('app.name') }}</strong> &copy; 2024
            </div>
            @auth
            <div class="tracks_count uppercase">
                {{ trans_choice('tracks.posts', $tracks_count) }}
            </div>
            @endauth
        </div>
    </footer>
</x-layout>