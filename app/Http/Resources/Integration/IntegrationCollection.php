<?php

namespace App\Http\Resources\Integration;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class IntegrationCollection extends ResourceCollection
{
    public $collects = IntegrationResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'data' => $this->collection
        ];
    }
}
