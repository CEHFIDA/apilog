<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Api_Token;
use App\Models\APILog;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->hasHeader('auth-api-token'))
        {
            $token = $request->header('auth-api-token');
            $tokenGet = Api_Token::where("token", $token)->first();
            if(isset($tokenGet->token))
            {
                $ips = explode(', ', $tokenGet->ip_address);
                foreach($ips as $ip)
                {
                    $test_ip = explode('.', \Request::ip());
                    $compare = range_parser($ip);
                    if(compare_ip_addresses($test_ip, $compare[0], $compare[1]))
                    {
                        return $next($request);
                    }
                }

                $response = [
                    "code"  =>  102,
                    "response"  =>  [
                        "message"  =>  "Access denied"
                    ]
                ];

                return response()->json($response, 200);
            }

            $response = [
                "code"  =>  100,
                "response"  =>  [
                    "message"  =>  "Token is no longer supported"
                ]
            ];

            return response()->json($response, 200);
        }
    }

    public function terminate($request, $response)
    {
        if($request->hasHeader('auth-api-token'))
        {
            $data = [
                'method' => $request->method(),
                'ip' => \Request::ip(),
                'token' => $request->header('auth-api-token'),
                'url' => $request->path(),
                'data' => json_encode($request->all()),
                'status' => $response->getStatusCode(),
                'answer' => $response->content()
            ];

            APILog::create($data);
        }
    }
}