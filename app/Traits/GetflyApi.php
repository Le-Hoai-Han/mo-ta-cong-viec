<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait GetflyApi
{
    public function url()
    {
        return config('services.getfly.url');
    }

    public function key()
    {
        
        return config('services.getfly.key');
    }

    //post to getfly
    public function postToGetFly($data, $url)
    {

        $response = Http::withHeaders([
            'X-API-KEY' => $this->key()
        ])->post($this->url() . $url, $data);
        return $response->body();
    }

    // post to getfly
    // public function putToGetFly($data, $url)
    // {

    //     $response = Http::withHeaders([
    //         'X-API-KEY' => $this->key(),
    //     ])->put($this->url() . $url, $data);
    //     return $response->body();
    // }

    //get to getfly
    public function getToGetFly($data, $url)
    {
        // dd($this->url().$url);
        $response = Http::withHeaders([
            'X-API-KEY' => $this->key(),
        ])->get($this->url() . $url, $data);
        return $response->body();
    }
  
}
