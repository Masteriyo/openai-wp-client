<?php

declare(strict_types=1);

namespace OpenAI\Responses\FineTunes;

use OpenAI\Contracts\Response;
use OpenAI\Responses\Concerns\ArrayAccessible;

/**
 * @implements Response<array{id: string, object: string, model: string, created_at: int, events: array<int, array{object: string, created_at: int, level: string, message: string}>, fine_tuned_model: ?string, hyperparams: array{batch_size: ?int, learning_rate_multiplier: ?float, n_epochs: int, prompt_loss_weight: float}, organization_id: string, result_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, status: string, validation_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, training_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, updated_at: int}>
 */
final class RetrieveResponse implements Response
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, model: string, created_at: int, events: array<int, array{object: string, created_at: int, level: string, message: string}>, fine_tuned_model: ?string, hyperparams: array{batch_size: ?int, learning_rate_multiplier: ?float, n_epochs: int, prompt_loss_weight: float}, organization_id: string, result_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, status: string, validation_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, training_files: array<int, array{id: string, object: string, created_at: int, bytes: int, filename: string, purpose: string, status: string, status_details: array<array-key, mixed>|string|null}>, updated_at: int}>
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
     * @var string
     */
    public $model;
    /**
     * @readonly
     * @var int
     */
    public $createdAt;
    /**
     * @var array<int, RetrieveResponseEvent>
     * @readonly
     */
    public $events;
    /**
     * @readonly
     * @var string|null
     */
    public $fineTunedModel;
    /**
     * @readonly
     * @var \OpenAI\Responses\FineTunes\RetrieveResponseHyperparams
     */
    public $hyperparams;
    /**
     * @readonly
     * @var string
     */
    public $organizationId;
    /**
     * @var array<int, RetrieveResponseFile>
     * @readonly
     */
    public $resultFiles;
    /**
     * @readonly
     * @var string
     */
    public $status;
    /**
     * @var array<int, RetrieveResponseFile>
     * @readonly
     */
    public $validationFiles;
    /**
     * @var array<int, RetrieveResponseFile>
     * @readonly
     */
    public $trainingFiles;
    /**
     * @readonly
     * @var int
     */
    public $updatedAt;
    /**
     * @param  array<int, RetrieveResponseEvent>  $events
     * @param  array<int, RetrieveResponseFile>  $resultFiles
     * @param  array<int, RetrieveResponseFile>  $validationFiles
     * @param  array<int, RetrieveResponseFile>  $trainingFiles
     * @param string|null $fineTunedModel
     */
    private function __construct(string $id, string $object, string $model, int $createdAt, array $events, $fineTunedModel, RetrieveResponseHyperparams $hyperparams, string $organizationId, array $resultFiles, string $status, array $validationFiles, array $trainingFiles, int $updatedAt)
    {
        $this->id = $id;
        $this->object = $object;
        $this->model = $model;
        $this->createdAt = $createdAt;
        $this->events = $events;
        $this->fineTunedModel = $fineTunedModel;
        $this->hyperparams = $hyperparams;
        $this->organizationId = $organizationId;
        $this->resultFiles = $resultFiles;
        $this->status = $status;
        $this->validationFiles = $validationFiles;
        $this->trainingFiles = $trainingFiles;
        $this->updatedAt = $updatedAt;
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param mixed[] $attributes
     */
    public static function from($attributes): self
    {
        $events = array_map(function (array $result) : RetrieveResponseEvent {
            return RetrieveResponseEvent::from(
                $result
            );
        }, $attributes['events'] ?? []);

        $resultFiles = array_map(function (array $result) : RetrieveResponseFile {
            return RetrieveResponseFile::from(
                $result
            );
        }, $attributes['result_files']);

        $validationFiles = array_map(function (array $result) : RetrieveResponseFile {
            return RetrieveResponseFile::from(
                $result
            );
        }, $attributes['validation_files']);

        $trainingFiles = array_map(function (array $result) : RetrieveResponseFile {
            return RetrieveResponseFile::from(
                $result
            );
        }, $attributes['training_files']);

        return new self($attributes['id'], $attributes['object'], $attributes['model'], $attributes['created_at'], $events, $attributes['fine_tuned_model'], RetrieveResponseHyperparams::from($attributes['hyperparams']), $attributes['organization_id'], $resultFiles, $attributes['status'], $validationFiles, $trainingFiles, $attributes['updated_at']);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'model' => $this->model,
            'created_at' => $this->createdAt,
            'events' => array_map(
                static function (RetrieveResponseEvent $result) : array {
                    return $result->toArray();
                },
                $this->events
            ),
            'fine_tuned_model' => $this->fineTunedModel,
            'hyperparams' => $this->hyperparams->toArray(),
            'organization_id' => $this->organizationId,
            'result_files' => array_map(
                static function (RetrieveResponseFile $result) : array {
                    return $result->toArray();
                },
                $this->resultFiles
            ),
            'status' => $this->status,
            'validation_files' => array_map(
                static function (RetrieveResponseFile $result) : array {
                    return $result->toArray();
                },
                $this->validationFiles
            ),
            'training_files' => array_map(
                static function (RetrieveResponseFile $result) : array {
                    return $result->toArray();
                },
                $this->trainingFiles
            ),
            'updated_at' => $this->updatedAt,
        ];
    }
}
