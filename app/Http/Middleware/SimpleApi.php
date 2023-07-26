<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\SaveRequest;
use Illuminate\Support\Facades\Log;

class SimpleApi
{
    use SaveRequest;
    private $secret = "3DSberightTheFirstTime";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

	/*
       if ($request->header('authorization') !== null) {
            if ($request->header('authorization') === "Basic ZTcwYzMyZThmNDNhMzQ1ZGQ2NzkzM2U3OWExNGM0NjAzOWVkNDBlMGFkOGE5MDMwODk5NDk5NzQ5NDZhNTIxYw==") {*/
                Log::debug($request->all());
                $this->saveThisRequest($request);
                $this->saveNotEncodeBody($request);
                return $next($request);
     /*       } else {
                return response()->json(['token validate error'], 401);
            }
        } else {
            return response()->json(['token validate error'], 401);
        }*/
    }
/*
    private function base64UrlEncode($text)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($text)
        );
    }

    private function encodeToken($payload)
    {
        // get the local secret key
        $secret = $this->secret;
        // Create the token header
        $header = json_encode([
            "alg" => "HS256",
            "typ" => "JWT"
        ]);

        // Encode Header
        $base64UrlHeader = $this->base64UrlEncode($header);

        // Encode Payload
        $base64UrlPayload = $this->base64UrlEncode($payload);

        // Create Signature Hash
        $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $secret, true);
        $base64UrlSignature = $this->base64UrlEncode($signature);
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }*/
}
