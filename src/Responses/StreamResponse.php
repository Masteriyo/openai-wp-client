<?php

namespace OpenAI\Responses;

use Generator;
use IteratorAggregate;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @template TResponse
 *
 * @implements IteratorAggregate<int, TResponse>
 */
final class StreamResponse implements IteratorAggregate
{
    /**
     * @var class-string<TResponse>
     * @readonly
     */
    private $responseClass;
    /**
     * @readonly
     * @var \Psr\Http\Message\ResponseInterface
     */
    private $response;
    /**
     * Creates a new Stream Response instance.
     *
     * @param  class-string<TResponse>  $responseClass
     */
    public function __construct(string $responseClass, ResponseInterface $response)
    {
        $this->responseClass = $responseClass;
        $this->response = $response;
        //
    }
    /**
     * {@inheritDoc}
     */
    public function getIterator(): Generator
    {
        while (! $this->response->getBody()->eof()) {
            $line = $this->readLine($this->response->getBody());

            if (strncmp($line, 'data:', strlen('data:')) !== 0) {
                continue;
            }

            $data = trim(substr($line, strlen('data:')));

            if ($data === '[DONE]') {
                break;
            }

            $response = json_decode($data, true, 512, 0);

            yield $this->responseClass::from($response);
        }
    }

    /**
     * Read a line from the stream.
     */
    private function readLine(StreamInterface $stream): string
    {
        $buffer = '';

        while (! $stream->eof()) {
            if ('' === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;
            if ($byte === "\n") {
                break;
            }
        }

        return $buffer;
    }
}
