<?php

namespace App\Players\Providers;

use App\Players\TrackDetails;
use App\Players\PlayerInterface;
use App\Exceptions\PlayerException;

class YoutubePlayer implements PlayerInterface
{
    /** @var string Provider ID */
    protected string $name = 'youtube';

    /** @var string Regular expression to extract Youtube ID and validate URL */
    protected string $expression = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/";

    /** @inheritDoc */
    public function match(string $url): bool
    {
        return in_array(parse_url($url, PHP_URL_HOST), [
            'www.youtube.com',
            'youtube.com',
            'youtu.be',
        ]);
    }

    /** @inheritDoc */
    public function validate(string $url): bool
    {
        return (bool) preg_match($this->expression, $url, $matches);
    }

    /** @inheritDoc */
    final public function resolve(string $url): TrackDetails
    {
        $id = $this->getId($url);
        $thumbnail = "https://img.youtube.com/vi/{$id}/hqdefault.jpg";

        return new TrackDetails($this->name, $url, $id, $thumbnail);
    }

    /** @inheritDoc */
    public function embed(mixed $id): string
    {
        $url = "https://www.youtube-nocookie.com/embed/{$id}";

        return <<<HTML
        <iframe width="560" height="315" 
            src="$url" 
            title="YouTube video player" frameborder="0" 
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">
        </iframe>
        HTML;
    }

    /**
     * Extract track ID from given URL.
     *
     * @throws PlayerException
     */
    protected function getId(string $url): string
    {
        preg_match($this->expression, $url, $matches);

        if (isset($matches[1])) {
            return $matches[1];
        }

        throw new PlayerException("Unable to extract track ID.", compact('url'));
    }
}
