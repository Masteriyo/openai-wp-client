<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}, finish_reason: string|null}>}>
 */
final class CreateStreamedResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, delta: array{role?: string, content?: string}, finish_reason: string|null}>}>
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
    public $object;
    /**
     * @readonly
     * @var int
     */
    public $created;
    /**
     * @readonly
     * @var string
     */
    public $model;
    /**
     * @var array<int, CreateStreamedResponseChoice>
     * @readonly
     */
    public $choices;
    /**
     * @param  array<int, CreateStreamedResponseChoice>  $choices
     */
    private function __construct(string $id, string $object, int $created, string $model, array $choices)
    {
        $this->id = $id;
        $this->object = $object;
        $this->created = $created;
        $this->model = $model;
        $this->choices = $choices;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        $choices = array_map(function (array $result) : CreateStreamedResponseChoice {
            return CreateStreamedResponseChoice::from(
                $result
            );
        }, $attributes['choices']);

        return new self($attributes['id'], $attributes['object'], $attributes['created'], $attributes['model'], $choices);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'model' => $this->model,
            'choices' => array_map(static function (CreateStreamedResponseChoice $result) : array {
                return $result->toArray();
            }, $this->choices),
        ];
    }
}
