<?php

declare(strict_types=1);

namespace OpenAI\Responses\Audio;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
 */
final class TranscriptionResponse implements Response
{
    /**
     * @use ArrayAccessible<array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}>
     */
    use ArrayAccessible;
    /**
     * @readonly
     * @var string|null
     */
    public $task;
    /**
     * @readonly
     * @var string|null
     */
    public $language;
    /**
     * @readonly
     * @var float|null
     */
    public $duration;
    /**
     * @var array<int, TranscriptionResponseSegment>
     * @readonly
     */
    public $segments;
    /**
     * @readonly
     * @var string
     */
    public $text;
    /**
     * @param  array<int, TranscriptionResponseSegment>  $segments
     * @param string|null $task
     * @param string|null $language
     * @param float|null $duration
     */
    private function __construct($task, $language, $duration, array $segments, string $text)
    {
        $this->task = $task;
        $this->language = $language;
        $this->duration = $duration;
        $this->segments = $segments;
        $this->text = $text;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{task: ?string, language: ?string, duration: ?float, segments: array<int, array{id: int, seek: int, start: float, end: float, text: string, tokens: array<int, int>, temperature: float, avg_logprob: float, compression_ratio: float, no_speech_prob: float, transient: bool}>, text: string}|string  $attributes
     */
    public static function from($attributes): self
    {
        if (is_string($attributes)) {
            $attributes = ['text' => $attributes];
        }

        $segments = isset($attributes['segments']) ? array_map(function (array $result) : TranscriptionResponseSegment {
            return TranscriptionResponseSegment::from(
                $result
            );
        }, $attributes['segments']) : [];

        return new self($attributes['task'] ?? null, $attributes['language'] ?? null, $attributes['duration'] ?? null, $segments, $attributes['text']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'task' => $this->task,
            'language' => $this->language,
            'duration' => $this->duration,
            'segments' => array_map(static function (TranscriptionResponseSegment $result) : array {
                return $result->toArray();
            }, $this->segments),
            'text' => $this->text,
        ];
    }
}
