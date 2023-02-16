<?php

namespace App\Services\Integrator;

use App\Data\User\Integrator;
use App\Services\Integrator\Traits\HttpMock;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class BaseClient
{
    //TODO: Видалити якщо потрібно щоб запити відправлялися на стороні сервера
    use HttpMock;

    protected PendingRequest $client;

    protected array $headers = [];

    protected Integrator $integrator;

    public function __construct(Integrator $integrator)
    {
        $this->fake();
        $this->integrator = $integrator;
        $this->client = Http::baseUrl($integrator->host);
    }

    public function getHeaders(): array
    {
        return $this->client->getOptions()['headers'] ?? [];
    }

    public function setHeaders(array $headers): void
    {
        $this->client->withHeaders($headers);
    }

    public function pushHeaders(array $headers): void
    {
        $this->setHeaders(array_merge($headers, $this->getHeaders()));
    }

    public function post(string $url, array $data = []): PromiseInterface|Response
    {
        return $this->client->post($url, $data);
    }

    public function get(string $url, array|string|null $query = null): PromiseInterface|Response
    {
        return $this->client->get($url, $query);
    }

    public function put(string $url, array $data = []): PromiseInterface|Response
    {
        return $this->client->put($url, $data);
    }

    public function delete(string $url, array $data = []): PromiseInterface|Response
    {
        return $this->client->delete($url, $data);
    }

    //TODO: Можна додати до всіх відповідей
    public function appendResponse(): array
    {
        return ['global' => true];
    }

    public function toResponse(array $data = []): array
    {
        return array_merge($data, $this->appendResponse());
    }

    //TODO: Можна додати логіку до всіх запитів
    public function prepareData(array $data): array
    {
        return [];
    }
}
