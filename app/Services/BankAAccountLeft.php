<?php

namespace App\Services;

use App\Exceptions\BankServiceIsNotAvailableException;
use Closure;
use Exception;
use Illuminate\Support\Facades\Http;

class BankAAccountLeft
{
    /**
     * @throws BankServiceIsNotAvailableException
     */
    public function handle($request, Closure $next)
    {
        try {
            $response = Http::get('https://hediehsara.ir/a.php');
            $response->throw();
        } catch (Exception $exception) {
            throw new BankServiceIsNotAvailableException();
        }

        $request += intval($response->body());
        return $next($request);
    }
}
