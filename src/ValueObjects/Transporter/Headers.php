<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects\Transporter;

use OpenAI\Enums\Transporter\ContentType;
use OpenAI\ValueObjects\ApiKey;

/**
 * @internal
 */
final class Headers
{
    /**
     * @var array<string, string>
     * @readonly
     */
    private $headers;
    /**
     * Creates a new Headers value object.
     *
     * @param  array<string, string>  $headers
     */
    private function __construct(array $headers)
    {
        $this->headers = $headers;
        // ..
    }

    /**
     * Creates a new Headers value object
     */
    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Creates a new Headers value object with the given API token.
     */
    public static function withAuthorization(ApiKey $apiKey): self
    {
        return new self([
            'Authorization' => "Bearer {$apiKey->toString()}",
        ]);
    }

    /**
     * Creates a new Headers value object, with the given content type, and the existing headers.
     */
    public function withContentType(ContentType $contentType, string $suffix = ''): self
    {
        $item0Unpacked = $this->headers;
        return new self(array_merge($item0Unpacked, ['Content-Type' => $contentType->value.$suffix]));
    }

    /**
     * Creates a new Headers value object, with the given organization, and the existing headers.
     */
    public function withOrganization(string $organization): self
    {
        $item0Unpacked = $this->headers;
        return new self(array_merge($item0Unpacked, ['OpenAI-Organization' => $organization]));
    }

    /**
     * Creates a new Headers value object, with the newly added header, and the existing headers.
     */
    public function withCustomHeader(string $name, string $value): self
    {
        $item0Unpacked = $this->headers;
        return new self(array_merge($item0Unpacked, [$name => $value]));
    }

    /**
     * @return array<string, string> $headers
     */
    public function toArray(): array
    {
        return $this->headers;
    }
}
