<?php

declare(strict_types=1);

namespace OpenAI\Enums\Moderations;

class Category
{
    const Hate = 'hate';
    const HateThreatening = 'hate/threatening';
    const SelfHarm = 'self-harm';
    const Sexual = 'sexual';
    const SexualMinors = 'sexual/minors';
    const Violence = 'violence';
    const ViolenceGraphic = 'violence/graphic';
}
