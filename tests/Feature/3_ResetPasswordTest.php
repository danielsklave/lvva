<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    // public function testUserCanViewPasswordResetForm()
    // {
    //     $user = User::factory()->create();

    //     $this->get(route('password.reset', $token = Password::broker()->createToken($user)))
    //         ->assertSuccessful()
    //         ->assertViewIs('auth.passwords.reset')
    //         ->assertViewHas('token', $token);
    // }

    // public function testAuthUserCanNotViewAPasswordResetForm()
    // {
    //     $user = User::factory()->create();

    //     $this->actingAs($user)->get(route('password.reset', $token = Password::broker()->createToken($user)))
    //         ->assertRedirect(route('home'));
    // }

    public function testUserCanResetPasswordWithValidToken()
    {
        $user = User::factory()->create();

        $this->post(route('password.update'), [
            'token' => Password::broker()->createToken($user),
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
            ->assertRedirect(route('home'));

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));

        $this->assertAuthenticatedAs($user);
    }

    public function testUserCanNotResetPasswordWithInvalidToken()
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $this->from(route('password.reset', $token = 'invalid-token'))->post(route('password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
            ->assertRedirect(route('password.reset', $token))
            ->assertSessionHasErrors('email');

        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
        
        $this->assertGuest();
    }

    public function testAuthCanNotResetPassword()
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $this->actingAs($user)->post(route('password.update'), [
            'token' => Password::broker()->createToken($user),
            'email' => $user->email,
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ])
            ->assertRedirect(route('home'));

        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    // public function testUserCanNotResetPasswordWithEmptyFields()
    // {
    //     $user = User::factory()->create([
    //         'password' => Hash::make('old-password'),
    //     ]);

    //     $this->from(route('password.reset', $token = Password::broker()->createToken($user)))->post(route('password.update'), [
    //         'token' => $token,
    //         'email' => $user->email,
    //         'password' => '',
    //         'password_confirmation' => '',
    //     ])
    //         ->assertRedirect(route('password.reset', $token))
    //         ->assertSessionHasErrors('password');

    //     $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    // }

    // public function testUserCannotResetPasswordWithoutProvidingAnEmail()
    // {
    //     $user = User::factory()->create([
    //         'password' => Hash::make('old-password'),
    //     ]);

    //     $this->from(route('password.reset', $token = $this->getValidToken($user)))->post(route('password.update'), [
    //         'token' => $token,
    //         'email' => '',
    //         'password' => 'new-password',
    //         'password_confirmation' => 'new-password',
    //     ])
    //         ->assertRedirect(route('password.reset', $token))
    //         ->assertSessionHasErrors('email');
    // }
}