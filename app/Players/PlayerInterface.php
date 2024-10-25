<?php

namespace App\Players;

interface PlayerInterface
{
    /**
     * Check if given URL corresponds to provider.
     */
    public function match(string $url): bool;

    /**
     * Validate given URL.
     */
    public function validate(string $url): bool;

    /**
     * Get track details for given URL.
     */
    public function resolve(string $url): TrackDetails;

    /**
     * Get embed code for given track ID.
     */
    public function embed(mixed $id): string;
}
