<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>
 */
final class TranslationResponseSegment implements Response
{
    /**
     * @use ArrayAccessible<array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>
     */
    use ArrayAccessible;
    /**
     * @readonly
     * @var int
     */
    public $id;
    /**
     * @readonly
     * @var int
     */
    public $seek;
    /**
     * @readonly
     * @var float
     */
    public $start;
    /**
     * @readonly
     * @var float
     */
    public $end;
    /**
     * @readonly
     * @var string
     */
    public $text;
    /**
     * @var array<int, int>
     * @readonly
     */
    public $tokens;
    /**
     * @readonly
     * @var float
     */
    public $temperature;
    /**
     * @readonly
     * @var float
     */
    public $avgLogprob;
    /**
     * @readonly
     * @var float
     */
    public $compressionRatio;
    /**
     * @readonly
     * @var float
     */
    public $noSpeechProb;
    /**
     * @readonly
     * @var bool
     */
    public $transient;
    /**
     * @param  array<int, int>  $tokens
     */
    private function __construct(int $id, int $seek, float $start, float $end, string $text, array $tokens, float $temperature, float $avgLogprob, float $compressionRatio, float $noSpeechProb, bool $transient)
    {
        $this->id = $id;
        $this->seek = $seek;
        $this->start = $start;
        $this->end = $end;
        $this->text = $text;
        $this->tokens = $tokens;
        $this->temperature = $temperature;
        $this->avgLogprob = $avgLogprob;
        $this->compressionRatio = $compressionRatio;
        $this->noSpeechProb = $noSpeechProb;
        $this->transient = $transient;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        return new self($attributes['id'], $attributes['seek'], $attributes['start'], $attributes['end'], $attributes['text'], $attributes['tokens'], $attributes['temperature'], $attributes['avg_logprob'], $attributes['compression_ratio'], $attributes['no_speech_prob'], $attributes['transient']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'seek' => $this->seek,
            'start' => $this->start,
            'end' => $this->end,
            'text' => $this->text,
            'tokens' => $this->tokens,
            'temperature' => $this->temperature,
            'avg_logprob' => $this->avgLogprob,
            'compression_ratio' => $this->compressionRatio,
            'no_speech_prob' => $this->noSpeechProb,
            'transient' => $this->transient,
        ];
    }
}
