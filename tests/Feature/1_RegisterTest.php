<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    
    public function testUserCanNotRegisterWithExistingUsersData()
    {
        User::factory()->create([
            'name' => 'Test user 1',
            'email' => 'test1@test.com',
        ]);

        $this->from(route('register'))->post(route('register'), [
            'name' => 'Test user 1',
            'email' => 'test1@test.com',
            'password' => '',
            'password_confirmation' => '',
        ])
            ->assertRedirect(route('register'))
            ->assertSessionHasErrors(['name', 'email', 'password']);

        $this->assertEquals(1, User::count());

        $this->assertGuest();
    }

    public function testUserCanRegister()
    {
        $this->post(route('register'), [
            'name' => 'Test user 3',
            'email' => 'test3@test.com',
            'password' => 'valid-password',
            'password_confirmation' => 'valid-password',
        ])
            ->assertRedirect(route('home'));

        $user = User::find(User::count());

        $this->assertAuthenticatedAs($user);

        $this->assertEquals('Test user 3', $user->name);
        $this->assertEquals('test3@test.com', $user->email);
        $this->assertTrue(Hash::check('valid-password', $user->password));
    }

    public function testAuthCanNotRegister()
    {
        $data = [
            'name' => 'Test user 4',
            'email' => 'test4@test.com',
        ];

        $this->actingAs(User::factory()->create())->post(route('register'), [
            ...$data,
            'password' => 'valid-password',
            'password_confirmation' => 'valid-password',
        ])
            ->assertRedirect(route('home'));

        $this->assertDatabaseMissing('users', $data);
    }

    // public function testUserCanViewRegistrationForm()
    // {
    //     $this->get(route('register'))
    //         ->assertSuccessful()
    //         ->assertViewIs('auth.register');
    // }

    // public function testAuthCanNotViewRegistrationForm()
    // {
    //     $this->actingAs(User::factory()->create())->get(route('register'))
    //         ->assertRedirect(route('home'));
    // }

    // public function testUserCannotRegisterWithInvalidEmail()
    // {
    //     $this->from(route('register'))->post(route('register'), [
    //         'name' => 'Test user',
    //         'email' => 'invalid-email',
    //         'password' => 'valid-password',
    //         'password_confirmation' => 'valid-password',
    //     ])
    //         ->assertRedirect(route('register'))
    //         ->assertSessionHasErrors('email');
    // }

    // public function testUserCannotRegisterWithPasswordsNotMatching()
    // {
    //     $this->from(route('register'))->post(route('register'), [
    //         'name' => 'Test user',
    //         'email' => 'test@test.com',
    //         'password' => 'valid-password',
    //         'password_confirmation' => 'invalid-password',
    //     ])
    //         ->assertRedirect(route('register'))
    //         ->assertSessionHasErrors('password');
    // }
}