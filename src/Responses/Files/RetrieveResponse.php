<?php

declare(strict_types=1);

namespace OpenAI\Responses\Files;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>
 */
final class RetrieveResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>
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
    public $bytes;
    /**
     * @readonly
     * @var int
     */
    public $createdAt;
    /**
     * @readonly
     * @var string
     */
    public $filename;
    /**
     * @readonly
     * @var string
     */
    public $purpose;
    /**
     * @readonly
     * @var string
     */
    public $status;
    /**
     * @var array<array-key, mixed>|null
     * @readonly
     */
    public $statusDetails;
    /**
     * @param  array<array-key, mixed>|null  $statusDetails
     */
    private function __construct(string $id, string $object, int $bytes, int $createdAt, string $filename, string $purpose, string $status, $statusDetails)
    {
        $this->id = $id;
        $this->object = $object;
        $this->bytes = $bytes;
        $this->createdAt = $createdAt;
        $this->filename = $filename;
        $this->purpose = $purpose;
        $this->status = $status;
        $this->statusDetails = $statusDetails;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        return new self($attributes['id'], $attributes['object'], $attributes['bytes'], $attributes['created_at'], $attributes['filename'], $attributes['purpose'], $attributes['status'], $attributes['status_details']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'bytes' => $this->bytes,
            'created_at' => $this->createdAt,
            'filename' => $this->filename,
            'purpose' => $this->purpose,
            'status' => $this->status,
            'status_details' => $this->statusDetails,
        ];
    }
}
