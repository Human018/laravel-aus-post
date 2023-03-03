<?php

namespace Human018\LaravelAusPost\Client;

class Http
{
    private $request;

    const API = 'digitalapi.auspost.com.au';

    public function __construct()
    {
        $this->request = \Illuminate\Support\Facades\Http::withHeaders([
            'AUTH-KEY' => config('services.auspost.key'),
        ]);

        return $this;
    }

    public function get($url, $query = [])
    {
        return $this->request->get('https://'.self::API.$url, $query);
    }
}
