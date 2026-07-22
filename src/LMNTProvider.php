<?php

declare(strict_types=1);

namespace AiSdk\LMNT;

use AiSdk\Contracts\BaseProvider;
use AiSdk\Contracts\SpeechModelInterface;
use AiSdk\Contracts\SpeechProviderInterface;
use AiSdk\LMNT\Models\LMNTSpeechModel;

final class LMNTProvider extends BaseProvider implements SpeechProviderInterface
{
    public function __construct(public readonly LMNTOptions $options) {}
    public function name(): string
    {
        return LMNTOptions::PROVIDER_NAME;
    }
    protected function speechModel(string $modelId): SpeechModelInterface
    {
        return new LMNTSpeechModel($modelId, $this->options);
    }
}
