<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{url: string}|array{b64_json: string}>
 */
final class CreateResponseData implements Response
{
    /**
     * @use ArrayAccessible<array{url: string}|array{b64_json: string}>
     */
    use ArrayAccessible;
    /**
     * @readonly
     * @var string
     */
    public $url = '';
    /**
     * @readonly
     * @var string
     */
    public $b64_json = '';
    private function __construct(string $url = '', string $b64_json = '')
    {
        $this->url = $url;
        $this->b64_json = $b64_json;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        return new self($attributes['url'] ?? '', $attributes['b64_json'] ?? '');
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return $this->url !== '' && $this->url !== '0' ?
            ['url' => $this->url] :
            ['b64_json' => $this->b64_json];
    }
}
