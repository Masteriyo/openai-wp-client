<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTunes;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{object: string, created_at: int, level: string, message: string}>
 */
final class RetrieveStreamedResponseEvent implements Response
{
    /**
     * @use ArrayAccessible<array{object: string, created_at: int, level: string, message: string}>
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
    public $createdAt;
    /**
     * @readonly
     * @var string
     */
    public $level;
    /**
     * @readonly
     * @var string
     */
    public $message;
    private function __construct(string $object, int $createdAt, string $level, string $message)
    {
        $this->object = $object;
        $this->createdAt = $createdAt;
        $this->level = $level;
        $this->message = $message;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        return new self($attributes['object'], $attributes['created_at'], $attributes['level'], $attributes['message']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'level' => $this->level,
            'message' => $this->message,
        ];
    }
}
