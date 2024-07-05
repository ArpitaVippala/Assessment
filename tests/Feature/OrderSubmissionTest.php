<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderSubmissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testSubmitOrder(){
        $data = [
            'products' => ['3', '7'],
            'email' => 'tes66@gmail.com',
            'ship_address' => 'Hyderabad, Telangana'
        ];

        $response = $this->withHeaders(['X-Requested-With' => 'XMLHttpRequest'])->postJson('saveDetails', $data);

        $response->assertStatus(200);
        // $response->assertSessionHas(['email', 'products']);
    }
}
