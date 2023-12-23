<?php

namespace Tests\Feature;

use App\Models\Spy;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    public function test_require_name_email_and_password()
    {
        $this->json('POST', 'api/register')
        ->assertStatus(422)
        ->assertJsonFragment([
            'name' => ['The name field is required.'],
            'email' => ['The email field is required.'],
            'password' => ['The password field is required.']
        ]);
    }


    public function test_successful_registration()
    {
        $user = User::factory()->create(); 
        $this->assertDatabaseHas('users', ['name' => $user->name]);

    }


    public function test_must_enter_email_and_password()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJsonFragment([
                'email' => ["The email field is required."],
                'password' => ["The password field is required."],                
            ]);
    }

    public function test_successful_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('test')
        ]);
 
        $loginData = ['email' => $user->email, 'password' => 'test'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "access_token"
            ]);

        $this->assertAuthenticated();
    }
}
