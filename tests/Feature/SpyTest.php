<?php

namespace Tests\Feature;

use App\Models\Spy;
use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\Api\SpyController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpyTest extends TestCase
{

    public function test_api_get_spies_random_list_endpoint()
    {
        $this->json('GET', 'api/spies-random')->assertStatus(200);
    }

    public function test_api_returns_spies_random_list_with_five_records()
    {
        $this->json('GET', 'api/spies-random')->assertStatus(200)->assertJsonCount(5);
    }
}
