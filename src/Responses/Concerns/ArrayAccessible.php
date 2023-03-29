<?php

declare(strict_types=1);

namespace OpenAI\Responses\Concerns;

use BadMethodCallException;
use OpenAI\Contracts\Response;

/**
 * @template TArray of array
 *
 * @mixin Response<TArray>
 */
trait ArrayAccessible
{
    /**
     * {@inheritDoc}
     * @param mixed $offset
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->toArray());
    }

    /**
     * {@inheritDoc}
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->toArray()[$offset];
    }

    /**
     * {@inheritDoc}
     * @return never
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        throw new BadMethodCallException('Cannot set response attributes.');
    }

    /**
     * {@inheritDoc}
     * @return never
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        throw new BadMethodCallException('Cannot unset response attributes.');
    }
}
