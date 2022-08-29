<?php

namespace App\Http\Controllers;

use App\Services\BankAAccountLeft;
use App\Services\BankBAccountLeft;
use Illuminate\Http\JsonResponse;
use Illuminate\Pipeline\Pipeline;

class UserAccountController extends Controller
{
    public function accountLeft(): JsonResponse
    {
        $totalAccountLeft = 0;
        $totalAccountLeft = app(Pipeline::class)
            ->send($totalAccountLeft)
            ->through([
                BankAAccountLeft::class,
                BankBAccountLeft::class,
            ])
            ->thenReturn();

        return response()->json(['total' => $totalAccountLeft]);
    }
}
