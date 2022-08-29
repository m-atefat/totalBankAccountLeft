<?php

namespace Tests\Feature;

use App\Exceptions\BankServiceIsNotAvailableException;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AccountLeftTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $user = User::factory()->create();
        Http::fake([
            'hediehsara.ir/a.php' => Http::response(15000),
            'hediehsara.ir/b.php' => Http::response(20000)
        ]);

        $response = $this->actingAs($user)->get('/api/account/left');
        $response->assertStatus(200);
        $response->assertJson([
            'total' => 35000
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_exception_if_can_not_connect_to_bank_api()
    {
        $this->withoutExceptionHandling();
        $this->expectException(BankServiceIsNotAvailableException::class);

        $user = User::factory()->create();
        $this->actingAs($user)->get('/api/account/left');
    }
}
