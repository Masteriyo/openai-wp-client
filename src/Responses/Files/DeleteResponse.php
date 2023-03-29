<?php

declare(strict_types=1);

namespace OpenAI\Responses\Files;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, deleted: bool}>
 */
final class DeleteResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, deleted: bool}>
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
     * @var bool
     */
    public $deleted;
    private function __construct(string $id, string $object, bool $deleted)
    {
        $this->id = $id;
        $this->object = $object;
        $this->deleted = $deleted;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        return new self($attributes['id'], $attributes['object'], $attributes['deleted']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'deleted' => $this->deleted,
        ];
    }
}
