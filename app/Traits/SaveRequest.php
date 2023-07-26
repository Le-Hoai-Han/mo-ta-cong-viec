<?php

namespace App\Traits;

use App\Models\RequestStoring;

trait SaveRequest
{
    public function saveThisRequest($request)
    {
        $model = new RequestStoring();

        $model->create([
            'action' => $request->url(),
            'method' => $request->method(),
            'body' => json_encode($request->all()),            
            'header' => json_encode($request->header())
        ]);
    }

    public function saveNotEncodeBody($request)
    {
        $model = new RequestStoring();
        $obj = $request->all();
        $body = "";
        foreach ($obj as $key => $val) {
            $body = $key;
            break;
        }

        $model->create([
            'body' => $body,
            'action' => $request->url(),
            'method' => $request->method(),
            'header' => json_encode($request->header())
        ]);
    }
}
