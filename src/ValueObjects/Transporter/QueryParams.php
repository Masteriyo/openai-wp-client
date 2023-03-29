<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects\Transporter;

/**
 * @internal
 */
final class QueryParams
{
    /**
     * @var array<string, (string | int)>
     * @readonly
     */
    private $params;
    /**
     * Creates a new Query Params value object.
     *
     * @param  array<string, string|int>  $params
     */
    private function __construct(array $params)
    {
        $this->params = $params;
        // ..
    }

    /**
     * Creates a new Query Params value object
     */
    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Creates a new Query Params value object, with the newly added param, and the existing params.
     * @param string|int $value
     */
    public function withParam(string $name, $value): self
    {
        $item0Unpacked = $this->params;
        return new self(array_merge($item0Unpacked, [$name => $value]));
    }

    /**
     * @return array<string, string|int>
     */
    public function toArray(): array
    {
        return $this->params;
    }
}
