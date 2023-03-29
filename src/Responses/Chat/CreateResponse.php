<?php

declare(strict_types=1);

namespace OpenAI\Responses\Chat;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, message: array{role: string, content: string}, finish_reason: string|null}>, usage: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
 */
final class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, model: string, choices: array<int, array{index: int, message: array{role: string, content: string}, finish_reason: string|null}>, usage: array{prompt_tokens: int, completion_tokens: int|null, total_tokens: int}}>
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
     * @var array<int, CreateResponseChoice>
     * @readonly
     */
    public $choices;
    /**
     * @readonly
     * @var \OpenAI\Responses\Chat\CreateResponseUsage
     */
    public $usage;
    /**
     * @param  array<int, CreateResponseChoice>  $choices
     */
    private function __construct(string $id, string $object, int $created, string $model, array $choices, CreateResponseUsage $usage)
    {
        $this->id = $id;
        $this->object = $object;
        $this->created = $created;
        $this->model = $model;
        $this->choices = $choices;
        $this->usage = $usage;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        $choices = array_map(function (array $result) : CreateResponseChoice {
            return CreateResponseChoice::from(
                $result
            );
        }, $attributes['choices']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['model'],
            $choices,
            CreateResponseUsage::from($attributes['usage'])
        );
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
            'choices' => array_map(static function (CreateResponseChoice $result) : array {
                return $result->toArray();
            }, $this->choices),
            'usage' => $this->usage->toArray(),
        ];
    }
}
