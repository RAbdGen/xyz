<?php

namespace App\Players\Providers;

use DOMDocument;
use App\Players\TrackDetails;
use App\Players\PlayerInterface;
use App\Exceptions\PlayerException;
use Illuminate\Support\Facades\Http;

class SoundcloudPlayer implements PlayerInterface
{
    /** @var string Provider ID */
    protected string $name = 'soundcloud';

    /** @var string Regular expression to validate SC URL */
    protected string $expression = "(https?:\/\/(?:www.)?soundcloud.com\/[\w-]+\/(?!sets\/)?[\w-]+)";

    /** @inheritDoc */
    public function match(string $url): bool
    {
        return in_array(parse_url($url, PHP_URL_HOST), [
            'www.soundcloud.com',
            'soundcloud.com'
        ]);
    }

    /** @inheritDoc */
    public function validate(string $url): bool
    {
        // Force to reject "sets" (e.g. playlists) URLs
        if (preg_match("(https?:\/\/(?:www.)?soundcloud.com\/[\w-]+\/(sets\/)+[\w-]+)", $url)) {
            return false;
        }

        return (bool) preg_match($this->expression, $url, $matches);
    }

    /** @inheritDoc */
    public function resolve(string $url): TrackDetails
    {
        [$id, $thumbnail] = $this->fetchTrackDetails($url);

        return new TrackDetails($this->name, $url, $id, $thumbnail);
    }

    /** @inheritDoc */
    public function embed(mixed $id): string
    {
        $url = "https://w.soundcloud.com/player/?visual=true&amp;url=https%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F{$id}&amp;show_artwork=true";

        return <<<HTML
        <iframe width="400" height="200" src="$url"
            scrolling="no" frameborder="no" allow="autoplay">
        </iframe>
        HTML;
    }

    /**
     * Fetch Soundcloud track details.
     *
     * There are few more steps to retrieve details from SC :
     * 1. Call https://soundcloud.com/oembed endpoint
     * 2. Parse iframe code to retrieve track ID
     *
     * @throws PlayerException
     */
    private function fetchTrackDetails(string $url): array
    {
        $response = Http::get('https://soundcloud.com/oembed', [
            'format' => 'json',
            'url' => $url,
        ]);

        throw_if(
            $response->failed(),
            PlayerException::class,
            "Unable to fetch details from Soundcloud",
            ['url' => $url, 'status_code' => $response->status()]
        );

        $embed_url = $this->getEmbedUrl($response->json('html'));

        return [
            $this->extractIdFromUrl($embed_url),
            $response->json('thumbnail_url')
        ];
    }

    /**
     * Parse iframe HTML code to retrieve embed URL.
     */
    private function getEmbedUrl(string $html): string
    {
        $document = new DOMDocument();

        // We need to disable error reporting since iframe code is partial HTML
        // @see https://www.php.net/manual/en/domdocument.loadhtml.php
        $document->loadHTML($html, LIBXML_NOERROR | LIBXML_HTML_NOIMPLIED);

        return urldecode(
            $document->getElementsByTagName('iframe')->item(0)->getAttribute('src')
        );
    }

    /**
     * Extract track ID from SC API URL.
     *
     * @throws PlayerException
     */
    private function extractIdFromUrl(string $url): string
    {
        // We need the identifier after "/tracks"
        // The given URL looks like the following :
        // https://w.soundcloud.com/player/?visual=true&url=https://api.soundcloud.com/tracks/273203268&show_artwork=true
        preg_match("*tracks\/?([0-9]+)*", $url, $matches);

        if (isset($matches[1])) {
            return $matches[1];
        }

        throw new PlayerException("Unable to extract track ID.", compact('url'));
    }
}
