<?php

namespace App\Players;

class TrackDetails
{
    /**
     * Track details
     */
    public function __construct(
        public string $player_id,
        public string $url,
        public string $track_id,
        public string $thumbnail_url,
    ) {
        //
    }
}
