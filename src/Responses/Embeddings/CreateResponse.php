<?php

declare(strict_types=1);

namespace OpenAI\Responses\Embeddings;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{object: string, data: array<int, array{object: string, embedding: array<int, float>, index: int}>, usage: array{prompt_tokens: int, total_tokens: int}}>
 */
final class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{object: string, data: array<int, array{object: string, embedding: array<int, float>, index: int}>, usage: array{prompt_tokens: int, total_tokens: int}}>
     */
    use ArrayAccessible;
    /**
     * @readonly
     * @var string
     */
    public $object;
    /**
     * @var array<int, CreateResponseEmbedding>
     * @readonly
     */
    public $embeddings;
    /**
     * @readonly
     * @var \OpenAI\Responses\Embeddings\CreateResponseUsage
     */
    public $usage;
    /**
     * @param  array<int, CreateResponseEmbedding>  $embeddings
     */
    private function __construct(string $object, array $embeddings, CreateResponseUsage $usage)
    {
        $this->object = $object;
        $this->embeddings = $embeddings;
        $this->usage = $usage;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        $embeddings = array_map(function (array $result) : CreateResponseEmbedding {
            return CreateResponseEmbedding::from(
                $result
            );
        }, $attributes['data']);

        return new self(
            $attributes['object'],
            $embeddings,
            CreateResponseUsage::from($attributes['usage'])
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(static function (CreateResponseEmbedding $result) : array {
                return $result->toArray();
            }, $this->embeddings),
            'usage' => $this->usage->toArray(),
        ];
    }
}
