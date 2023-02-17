<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BrandCollection extends ResourceCollection
{
    public $status;
    public $message;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function __construct($resource, $status = null, $message = null,)
    {
        parent::__construct($resource);
        $this->status =  $status;
        $this->message = $message;
    }

    public function toArray($request)
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => [
                'brand' => $this->collection,
                'brandCount' => $this->count()
            ]
        ];
    }
}
