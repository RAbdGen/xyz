<?php

namespace Database\Samples;

use Illuminate\Support\Collection;

class TrackSamples
{
    /**
     * Get samples as Collection.
     */
    public function collect(): Collection
    {
        return collect(self::data());
    }

    /**
     * Some random beats.
     */
    static function data(): array
    {
        return [
            // ['title' => '', 'artist' => '', 'url' => '', 'player' => 'soundcloud', 'player_track_id' => '', 'player_thumbnail_url' => ''],
            ['title' => 'Under the Bridge', 'artist' => 'Red Hot Chili Peppers', 'url' => 'https://soundcloud.com/red-hot-chili-peppers-official/under-the-bridge', 'player' => 'soundcloud', 'player_track_id' => '273203268', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-EUkelXwqc9ui-0-t200x200.jpg'],
            ['title' => 'Boulevard of Broken Dreams', 'artist' => 'Green Day', 'url' => 'https://soundcloud.com/greenday/holiday-boulevard-of-broken-1', 'player' => 'soundcloud', 'player_track_id' => '256240492', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-yNj3WsRogPVx-0-t200x200.jpg'],
            ['title' => 'Get Promiscuous', 'artist' => 'Jake Sharp', 'url' => 'https://soundcloud.com/user-725571360/get-promiscous', 'player' => 'soundcloud', 'player_track_id' => '612193893', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-cGuaL43C9X5HkDdh-mXFVmw-t200x200.jpg'],
            ['title' => 'Magic Drum Machine', 'artist' => 'Magic Flowers', 'url' => 'https://soundcloud.com/magic_flowers/magic-drum-machine', 'player' => 'soundcloud', 'player_track_id' => '631005330', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-000546015849-4nwp4k-t200x200.jpg'],
            ['title' => 'Super Koto', 'artist' => 'Ponzu Island', 'url' => 'https://soundcloud.com/ponzuisland/super-koto', 'player' => 'soundcloud', 'player_track_id' => '10117501', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-000042337576-hyott3-t200x200.jpg'],
            ['title' => 'Le Chill', 'artist' => 'L\'Or Du Commun', 'url' => 'https://soundcloud.com/dealerdemusique/lor-du-commun-le-chill', 'player' => 'soundcloud', 'player_track_id' => '151511191', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-000080643112-w859yy-t500x500.jpg'],
            ['title' => 'Your House', 'artist' => 'Steel Pulse','url' => 'https://soundcloud.com/steelpulseofficial/steel-pulse-your-house', 'player' => 'soundcloud', 'player_track_id' => '232952324', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-tUvPeJ73XagI-0-t500x500.jpg'],
            ['title' => 'Oh Honey', 'artist' => 'Delegation','url' => 'https://soundcloud.com/lechrometlecoton/oh-honey-delegation', 'player' => 'soundcloud', 'player_track_id' => '232582384', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-000135791229-rkmyqt-t500x500.jpg'],
            ['title' => 'A.I.E (A Mwana)', 'artist' => 'Blackblood','url' => 'https://soundcloud.com/blackblood-scmusic/a-i-e-a-mwana', 'player' => 'soundcloud', 'player_track_id' => '1291630309', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-ruqI6fSYrQ7g-0-t500x500.jpg'],
            ['title' => 'Going the Distance', 'artist' => 'Menahan Street Band','url' => 'https://soundcloud.com/menahan-street-band/going-the-distance', 'player' => 'soundcloud', 'player_track_id' => '299076824', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-D5CBRoKAcoFx-0-t500x500.jpg'],
            ['title' => 'Wonderwall', 'artist' => 'Oasis','url' => 'https://soundcloud.com/oasisofficial/wonderwall-2', 'player' => 'soundcloud', 'player_track_id' => '283975559', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-uJHErW4MVdvl-0-t500x500.jpg'],
            ['title' => 'Bad karma (Panda Dub remix)', 'artist' => 'Axel thesleff','url' => 'https://soundcloud.com/pandadub/06-solace-bad-karma-panda-dub', 'player' => 'soundcloud', 'player_track_id' => '619846746', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-000533999694-wonn3j-t500x500.jpg'],
            ['title' => 'Sinnernan', 'artist' => 'Tutankhamun','url' => 'https://soundcloud.com/niceguysrecords/sinnernan', 'player' => 'soundcloud', 'player_track_id' => '1233971902', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-JQFYDHoYVnUfnCgy-yrVzdA-t500x500.jpg'],
            ['title' => 'Amsterdam (DJ Tennis Remix)', 'artist' => 'Orofino','url' => 'https://soundcloud.com/user-13504394/amsterdam-dj-tennis-remix-1', 'player' => 'soundcloud', 'player_track_id' => '1533469585', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-ixhgjqZOJbuG-0-t500x500.jpg'],
            ['title' => 'Stupeflip vite !!! (feat. Cadillac)', 'artist' => 'Stupeflip','url' => 'https://soundcloud.com/stupeflip-music/stupeflip-vite-feat-cadillac?in=stupeflip-music/sets/the-hypnoflip-invasion-1', 'player' => 'soundcloud', 'player_track_id' => '1688100192', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-gdYucbj8gcsu-0-t500x500.jpg'],
            ['title' => 'Don\'t Make Me Leave You Again, Girl', 'artist' => 'Folamour','url' => 'https://soundcloud.com/folamour/folamour-dont-make-me-leave-you-again-girl', 'player' => 'soundcloud', 'player_track_id' => '584804298', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-000498447150-pvnzax-t500x500.jpg'],
            ['title' => 'Jolie', 'artist' => 'Les Deux','url' => 'https://soundcloud.com/deux/jolie', 'player' => 'soundcloud', 'player_track_id' => '139010722', 'player_thumbnail_url' => 'https://i1.sndcdn.com/artworks-000073209502-94eiz9-t500x500.jpg']
        ];
    }
}