<?php

namespace KSPEdu\LaravelFlutterGetx\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{
    public function toArray($request)
    {
        $data = parent::toArray($request);

        if(config('ksp-lfg.config.protected', null)) {
            $data['appProtected'] = true;

            foreach(config('ksp-lfg.config.protection_headers') as $key => $val) {
                $data['appHeaders'] = [
                    $key => $val
                ];
            }
        }

        return $data;
    }
}
