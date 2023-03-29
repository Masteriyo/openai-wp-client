<?php

declare(strict_types=1);

namespace OpenAI\Transporters;

use Closure;
use JsonException;
use OpenAI\Contracts\Transporter;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\TransporterException;
use OpenAI\Exceptions\UnserializableResponse;
use OpenAI\ValueObjects\Transporter\BaseUri;
use OpenAI\ValueObjects\Transporter\Headers;
use OpenAI\ValueObjects\Transporter\Payload;
use OpenAI\ValueObjects\Transporter\QueryParams;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @internal
 */
final class HttpTransporter implements Transporter
{
    /**
     * @readonly
     * @var \Psr\Http\Client\ClientInterface
     */
    private $client;
    /**
     * @readonly
     * @var \OpenAI\ValueObjects\Transporter\BaseUri
     */
    private $baseUri;
    /**
     * @readonly
     * @var \OpenAI\ValueObjects\Transporter\Headers
     */
    private $headers;
    /**
     * @readonly
     * @var \OpenAI\ValueObjects\Transporter\QueryParams
     */
    private $queryParams;
    /**
     * @readonly
     * @var \Closure
     */
    private $streamHandler;
    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(ClientInterface $client, BaseUri $baseUri, Headers $headers, QueryParams $queryParams, Closure $streamHandler)
    {
        $this->client = $client;
        $this->baseUri = $baseUri;
        $this->headers = $headers;
        $this->queryParams = $queryParams;
        $this->streamHandler = $streamHandler;
        // ..
    }
    /**
     * {@inheritDoc}
     * @return mixed[]|string
     * @param \OpenAI\ValueObjects\Transporter\Payload $payload
     */
    public function requestObject($payload)
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = (string) $response->getBody();

        if ($response->getHeader('Content-Type')[0] === 'text/plain; charset=utf-8') {
            return $contents;
        }

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $response */
            $response = json_decode($contents, true, 512, 0);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        if (isset($response['error'])) {
            throw new ErrorException($response['error']);
        }

        return $response;
    }

    /**
     * {@inheritDoc}
     * @param \OpenAI\ValueObjects\Transporter\Payload $payload
     */
    public function requestContent($payload): string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        $contents = $response->getBody()->getContents();

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $response */
            $response = json_decode($contents, true, 512, 0);

            if (isset($response['error'])) {
                throw new ErrorException($response['error']);
            }
        } catch (JsonException $exception) {
            // ..
        }

        return $contents;
    }

    /**
     * {@inheritDoc}
     * @param \OpenAI\ValueObjects\Transporter\Payload $payload
     */
    public function requestStream($payload): ResponseInterface
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        try {
            $response = ($this->streamHandler)($request);
        } catch (ClientExceptionInterface $clientException) {
            throw new TransporterException($clientException);
        }

        return $response;
    }
}
