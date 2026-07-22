<?php

declare(strict_types=1);

use AiSdk\Generate;
use AiSdk\LMNT;
use AiSdk\Support\Sdk;
use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

afterEach(function (): void {
    Generate::reset();
    LMNT::reset();
});

it('uses LMNT speech generation', function (): void {
    $client = new class implements ClientInterface {
        public ?RequestInterface $request = null;
        public function sendRequest(RequestInterface $request): ResponseInterface
        {
            $this->request = $request;
            return new Response(200, ['Content-Type' => 'audio/mpeg'], 'audio-bytes');
        }
    };
    $factory = new Psr17Factory();
    Generate::configure(new Sdk($client, $factory, $factory));
    LMNT::create(['apiKey' => 'lmnt-test']);
    $result = Generate::speech('Hello from LMNT')->model(LMNT::model('default'))->voice('voice-id')->run();
    $body = json_decode((string) $client->request?->getBody(), true);
    expect($result->output->data)->toBe('audio-bytes')->and((string) $client->request?->getUri())->toBe('https://api.lmnt.com/v1/ai/speech/bytes')->and($client->request?->getHeaderLine('X-API-Key'))->toBe('lmnt-test')->and($client->request?->getHeaderLine('lmnt-version'))->toBe('1.1')->and($body['voice'])->toBe('voice-id');
});
