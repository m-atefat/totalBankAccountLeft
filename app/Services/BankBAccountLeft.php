<?php

namespace App\Services;

use Closure;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class BankBAccountLeft
{
    /**
     * @throws RequestException
     */
    public function handle($totalAccountLeft, Closure $next)
    {
        $response = Http::get('https://hediehsara.ir/b.php');
        $response->throw();

        $totalAccountLeft += $response->json()[0];
        return $next($totalAccountLeft);
    }
}
