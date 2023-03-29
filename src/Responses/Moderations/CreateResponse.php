<?php

declare(strict_types=1);

namespace OpenAI\Responses\Moderations;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, model: string, results: array<int, array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}>}>
 */
final class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, model: string, results: array<int, array{categories: array<string, bool>, category_scores: array<string, float>, flagged: bool}>}>
     */
    use ArrayAccessible;
    /**
     * @readonly
     * @var string
     */
    public $id;
    /**
     * @readonly
     * @var string
     */
    public $model;
    /**
     * @var array<int, CreateResponseResult>
     * @readonly
     */
    public $results;
    /**
     * @param  array<int, CreateResponseResult>  $results
     */
    private function __construct(string $id, string $model, array $results)
    {
        $this->id = $id;
        $this->model = $model;
        $this->results = $results;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        $results = array_map(function (array $result) : CreateResponseResult {
            return CreateResponseResult::from(
                $result
            );
        }, $attributes['results']);

        return new self($attributes['id'], $attributes['model'], $results);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'model' => $this->model,
            'results' => array_map(static function (CreateResponseResult $result) : array {
                return $result->toArray();
            }, $this->results),
        ];
    }
}
