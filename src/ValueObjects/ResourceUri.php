<?php

declare(strict_types=1);

namespace OpenAI\ValueObjects;

use OpenAI\Contracts\Stringable;

/**
 * @internal
 */
final class ResourceUri implements Stringable
{
    /**
     * @readonly
     * @var string
     */
    private $uri;
    /**
     * Creates a new ResourceUri value object.
     */
    private function __construct(string $uri)
    {
        $this->uri = $uri;
        // ..
    }

    /**
     * Creates a new ResourceUri value object that creates the given resource.
     * @param string $resource
     */
    public static function create($resource): self
    {
        return new self($resource);
    }

    /**
     * Creates a new ResourceUri value object that uploads to the given resource.
     * @param string $resource
     */
    public static function upload($resource): self
    {
        return new self($resource);
    }

    /**
     * Creates a new ResourceUri value object that lists the given resource.
     * @param string $resource
     */
    public static function list($resource): self
    {
        return new self($resource);
    }

    /**
     * Creates a new ResourceUri value object that retrieves the given resource.
     * @param string $resource
     * @param string $id
     * @param string $suffix
     */
    public static function retrieve($resource, $id, $suffix): self
    {
        return new self("{$resource}/{$id}{$suffix}");
    }

    /**
     * Creates a new ResourceUri value object that retrieves the given resource content.
     * @param string $resource
     * @param string $id
     */
    public static function retrieveContent($resource, $id): self
    {
        return new self("{$resource}/{$id}/content");
    }

    /**
     * Creates a new ResourceUri value object that cancels the given resource.
     * @param string $resource
     * @param string $id
     */
    public static function cancel($resource, $id): self
    {
        return new self("{$resource}/{$id}/cancel");
    }

    /**
     * Creates a new ResourceUri value object that deletes the given resource.
     * @param string $resource
     * @param string $id
     */
    public static function delete($resource, $id): self
    {
        return new self("{$resource}/{$id}");
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return $this->uri;
    }
}
