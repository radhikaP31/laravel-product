<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        $user = new User(['name' => 'Test App','email' => 'abd@gmail.assd', 'date_of_birth' => '2021-12-22', 'gender' => 'male', 'username' => 'testapp', 'password' => '12345678', 'status' => 'active', 'role_id' => '2']);

        $this->assertEquals('Test App', $user->name);

        // $response->assertStatus(200);
    }
}
