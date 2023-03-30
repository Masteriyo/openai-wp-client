<?php

declare(strict_types=1);

namespace OpenAI\Resources\Concerns;

use OpenAI\Contracts\Transporter;

trait Transportable
{
    private $transporter;

    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(Transporter $transporter)
    {
        $this->transporter = $transporter;
    }
}
