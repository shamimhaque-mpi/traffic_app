<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Transaction;


class PaymentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMockResponseAccepted()
    {
        $response = $this->withHeaders(['X-Mock-Status' => 'accepted'])->get('/api/mock-response');
        $response->assertStatus(200)->assertJson(['status' => 'accepted']);
    }

    public function testMockResponseFailed()
    {
        $response = $this->withHeaders(['X-Mock-Status' => 'failed'])->get('/api/mock-response');
        $response->assertStatus(400)->assertJson(['status' => 'failed']);
    }

    public function testProcessPayment()
    {
        $response = $this->withHeaders(['X-Mock-Status' => 'accepted'])
                         ->postJson('/api/process-payment', ['user_id' => 1, 'amount' => 100.00]);

        $response->assertStatus(200)
                 ->assertHeader('Cache-Control', 'no-store')
                 ->assertJsonStructure(['transaction_id', 'status']);
    }

    public function testUpdateTransaction()
    {
        $transaction = Transaction::create(['user_id' => 1, 'amount' => 100.00, 'status' => 'accepted']);

        $response = $this->postJson('/api/callback/'.$transaction->id, ['status' => 'completed']);
        $response->assertStatus(200)->assertJson(['message' => 'Transaction updated successfully']);
        
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => 'completed'
        ]);
    }
}
