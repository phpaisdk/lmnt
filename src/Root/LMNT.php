<?php

declare(strict_types=1);

namespace AiSdk;

use AiSdk\Contracts\Model;
use AiSdk\LMNT\LMNTOptions;
use AiSdk\LMNT\LMNTProvider;

final class LMNT
{
    private static ?LMNTProvider $default = null;
    /** @param array<string,mixed> $config */ public static function create(array $config = []): LMNTProvider
    {
        return self::$default = new LMNTProvider(LMNTOptions::fromArray($config));
    } public static function default(): LMNTProvider
    {
        return self::$default ??= self::create();
    } public static function reset(): void
    {
        self::$default = null;
    } public static function model(string $modelId): Model
    {
        return self::default()->model($modelId);
    }
}
