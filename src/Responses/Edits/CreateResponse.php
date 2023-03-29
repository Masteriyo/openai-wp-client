<?php

declare(strict_types=1);

namespace OpenAI\Responses\Edits;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{object: string, created: int, choices: array<int, array{text: string, index: int}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}>
 */
final class CreateResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created: int, model: string, choices: array<int, array{text: string, index: int, logprobs: int|null, finish_reason: string}>, usage: array{prompt_tokens: int, completion_tokens: int, total_tokens: int}}>
     */
    use ArrayAccessible;
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
     * @var array<int, CreateResponseChoice>
     * @readonly
     */
    public $choices;
    /**
     * @readonly
     * @var \OpenAI\Responses\Edits\CreateResponseUsage
     */
    public $usage;
    /**
     * @param  array<int, CreateResponseChoice>  $choices
     */
    private function __construct(string $object, int $created, array $choices, CreateResponseUsage $usage)
    {
        $this->object = $object;
        $this->created = $created;
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
            $attributes['object'],
            $attributes['created'],
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
            'object' => $this->object,
            'created' => $this->created,
            'choices' => array_map(static function (CreateResponseChoice $result) : array {
                return $result->toArray();
            }, $this->choices),
            'usage' => $this->usage->toArray(),
        ];
    }
}
