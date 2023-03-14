<?php

namespace LaravelFlutterGetx\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);

        if(config('laravel-flutter-getx.config.protected', null)) {
            $data['appProtected'] = true;

            foreach(config('laravel-flutter-getx.config.protection_headers') as $key => $val) {
                $data['appHeaders'] = [
                    $key => $val
                ];
            }
        }

        return $data;
    }
}
