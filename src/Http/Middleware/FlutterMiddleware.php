<?php

namespace KSPEdu\LaravelFlutterGetx\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FlutterMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $config = config('ksp-lfg.config');

        if($config['is_auth_protected']) {
            // TODO: Check authorization
        }

        if ($config['is_api_protected']) {
            foreach ($config['config']['api_protection_headers'] ?? [] as $header => $val) {
                $requestHeader = $request->header($header, null);

                if (!$requestHeader) {
                    return $this->unknownRequestError($header.' header is missing!');
                }

                $configParams = $config['config']['params'];

                if (Str::contains($val, '.')) {
                    $explodedVal = explode('.', $val);

                    $compareTo = '';

                    foreach ($explodedVal as $configCompare) {
                        $compareTo .= $configParams[$configCompare].'.' ?? '';
                    }
                } else {
                    $compareTo = $configParams[$val] ?? '';
                }

                if($compareTo === null || $compareTo === '') {
                    $compareTo = $val;
                }

                if ($requestHeader !== $compareTo) {
                    return $this->unknownRequestError($header.' is not equilant to '.$compareTo);
                }
            }
        }

        return $next($request);
    }

    protected function unknownRequestError($message = null) {
        return response()->json(['errors' => [$message ?? 'Unknown request!']], 402);
    }
}
