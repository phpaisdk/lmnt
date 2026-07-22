# LMNT provider for PHP AI SDK

```bash
composer require aisdk/lmnt
```

```php
use AiSdk\LMNT;
use AiSdk\Generate;

LMNT::create(['apiKey' => $_ENV['LMNT_API_KEY']]);

$result = Generate::speech('Hello from LMNT.')
    ->model(LMNT::model('default'))
    ->voice('your-lmnt-voice-id')
    ->run();
```

This package uses LMNT's speech API at `POST /v1/ai/speech/bytes`. Supply an LMNT voice ID with `->voice()`; provider options are forwarded to LMNT's native request body, including language, sample rate, temperature, and top-p. LMNT Speech Sessions use its separate WebSocket API. See [LMNT's API reference](https://docs.lmnt.com/api/speech/generate).
