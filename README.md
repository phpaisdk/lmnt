# aisdk/lmnt

<a href="https://github.com/phpaisdk/lmnt/actions"><img alt="GitHub Workflow Status" src="https://img.shields.io/github/actions/workflow/status/phpaisdk/lmnt/tests.yml?branch=main&label=Tests"></a>
<a href="https://packagist.org/packages/aisdk/lmnt"><img alt="Latest Version" src="https://img.shields.io/packagist/v/aisdk/lmnt"></a>
<a href="https://packagist.org/packages/aisdk/lmnt"><img alt="License" src="https://img.shields.io/packagist/l/aisdk/lmnt"></a>

------

Official LMNT provider for the PHP AI SDK. Uses LMNT's native text-to-speech API.

## Installation

```bash
composer require aisdk/lmnt
```

## Basic Usage

```php
use AiSdk\Generate;
use AiSdk\LMNT;

LMNT::create(['apiKey' => $_ENV['LMNT_API_KEY']]);

$result = Generate::speech('Hello from LMNT.')
    ->model(LMNT::model('default'))
    ->voice('your-lmnt-voice-id')
    ->run();
```

## Configuration

| Variable | Description | Default |
| --- | --- | --- |
| `LMNT_API_KEY` | API key for authentication | Required |
| `LMNT_BASE_URL` | Base URL for API requests | `https://api.lmnt.com` |

## Supported Capabilities

| Capability | Support |
| --- | --- |
| Text-to-speech | Native `POST /v1/ai/speech/bytes` |
| LMNT voice ID | Portable `->voice()` option |

Use `providerOptions('lmnt', [...])` for native request fields, including language, sample rate, temperature, and top-p. LMNT Speech Sessions use a separate WebSocket API and are outside this package's current scope.

## Documentation

- [LMNT speech API reference](https://docs.lmnt.com/api/speech/generate)
- [PHP AI SDK documentation](https://phpaisdk.com/docs/lmnt)
