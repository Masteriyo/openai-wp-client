<?php

declare(strict_types=1);

namespace OpenAI\Responses\Models;

final class RetrieveResponsePermission
{
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
    public $created;
    /**
     * @readonly
     * @var bool
     */
    public $allowCreateEngine;
    /**
     * @readonly
     * @var bool
     */
    public $allowSampling;
    /**
     * @readonly
     * @var bool
     */
    public $allowLogprobs;
    /**
     * @readonly
     * @var bool
     */
    public $allowSearchIndices;
    /**
     * @readonly
     * @var bool
     */
    public $allowView;
    /**
     * @readonly
     * @var bool
     */
    public $allowFineTuning;
    /**
     * @readonly
     * @var string
     */
    public $organization;
    /**
     * @readonly
     * @var string|null
     */
    public $group;
    /**
     * @readonly
     * @var bool
     */
    public $isBlocking;
    /**
     * @param string|null $group
     */
    private function __construct(string $id, string $object, int $created, bool $allowCreateEngine, bool $allowSampling, bool $allowLogprobs, bool $allowSearchIndices, bool $allowView, bool $allowFineTuning, string $organization, $group, bool $isBlocking)
    {
        $this->id = $id;
        $this->object = $object;
        $this->created = $created;
        $this->allowCreateEngine = $allowCreateEngine;
        $this->allowSampling = $allowSampling;
        $this->allowLogprobs = $allowLogprobs;
        $this->allowSearchIndices = $allowSearchIndices;
        $this->allowView = $allowView;
        $this->allowFineTuning = $allowFineTuning;
        $this->organization = $organization;
        $this->group = $group;
        $this->isBlocking = $isBlocking;
    }
    /**
     * @param  array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self($attributes['id'], $attributes['object'], $attributes['created'], $attributes['allow_create_engine'], $attributes['allow_sampling'], $attributes['allow_logprobs'], $attributes['allow_search_indices'], $attributes['allow_view'], $attributes['allow_fine_tuning'], $attributes['organization'], $attributes['group'], $attributes['is_blocking']);
    }

    /**
     * @return array{id: string, object: string, created: int, allow_create_engine: bool, allow_sampling: bool, allow_logprobs: bool, allow_search_indices: bool, allow_view: bool, allow_fine_tuning: bool, organization: string, group: ?string, is_blocking: bool}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'allow_create_engine' => $this->allowCreateEngine,
            'allow_sampling' => $this->allowSampling,
            'allow_logprobs' => $this->allowLogprobs,
            'allow_search_indices' => $this->allowSearchIndices,
            'allow_view' => $this->allowView,
            'allow_fine_tuning' => $this->allowFineTuning,
            'organization' => $this->organization,
            'group' => $this->group,
            'is_blocking' => $this->isBlocking,
        ];
    }
}
