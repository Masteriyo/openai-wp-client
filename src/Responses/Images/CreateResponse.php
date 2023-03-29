<?php

declare(strict_types=1);

namespace OpenAI\Responses\Images;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}>
 */
final class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{created: int, data: array<int, array{url?: string, b64_json?: string}>}>
     */
    use ArrayAccessible;
    /**
     * @readonly
     * @var int
     */
    public $created;
    /**
     * @var array<int, CreateResponseData>
     * @readonly
     */
    public $data;
    /**
     * @param  array<int, CreateResponseData>  $data
     */
    private function __construct(int $created, array $data)
    {
        $this->created = $created;
        $this->data = $data;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        $results = array_map(function (array $result) : CreateResponseData {
            return CreateResponseData::from(
                $result
            );
        }, $attributes['data']);

        return new self($attributes['created'], $results);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'created' => $this->created,
            'data' => array_map(static function (CreateResponseData $result) : array {
                return $result->toArray();
            }, $this->data),
        ];
    }
}
