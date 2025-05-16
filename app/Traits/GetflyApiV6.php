<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait GetflyApiV6
{
    public function urlV6()
    {
        return config('services.getfly-v6.url');
    }

    public function keyV6()
    {
        return config('services.getfly-v6.key_acount');
    }

    public function getToGetFlyV6($data,$url)
    {
        // dd($this->urlV6() .$url. $data);
        $reponse = Http::withHeaders([
            'X-API-KEY'=>$this->keyV6(),
            ])->get($this->urlV6() .$url, $data);
            // dd( $reponse->body());
            return $reponse->body();
        }


}


?>
