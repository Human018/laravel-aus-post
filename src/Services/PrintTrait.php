<?php

namespace Human018\LaravelAusPost\Services;

trait PrintTrait
{
    public function toArray()
    {
        return [
            'service' => $this::SERVICE,
            'name' => $this::NAME,
            'description' => $this::DESCRIPTION,
            'delivery_time' => $this::DELIVERY_TIME,
        ];
    }
}
