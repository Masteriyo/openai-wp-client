<?php

declare(strict_types=1);

namespace OpenAI\Responses\Files;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>}>
 */
final class ListResponse implements Response
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>}>
     */
    use ArrayAccessible;
    /**
     * @readonly
     * @var string
     */
    public $object;
    /**
     * @var array<int, RetrieveResponse>
     * @readonly
     */
    public $data;
    /**
     * @param  array<int, RetrieveResponse>  $data
     */
    private function __construct(string $object, array $data)
    {
        $this->object = $object;
        $this->data = $data;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        $data = array_map(function (array $result) : RetrieveResponse {
            return RetrieveResponse::from(
                $result
            );
        }, $attributes['data']);

        return new self($attributes['object'], $data);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(static function (RetrieveResponse $response) : array {
                return $response->toArray();
            }, $this->data),
        ];
    }
}
