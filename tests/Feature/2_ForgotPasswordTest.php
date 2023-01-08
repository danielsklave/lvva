<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    // public function testUserCanViewEmailPasswordForm()
    // {
    //     $this->get(route('password.request'))
    //         ->assertSuccessful()
    //         ->assertViewIs('auth.passwords.email');
    // }

    // public function testAuthCanNotViewEmailPasswordForm()
    // {
    //     $this->actingAs(User::factory()->make())->get(route('password.request'))
    //         ->assertRedirect(route('home'));
    // }

    public function testUserDoesNotReceiveEmailIfNotRegistered()
    {
        Notification::fake();

        $this->from(route('password.email'))->post(route('password.email'), [
            'email' => 'nobody@test.com',
        ])
            ->assertRedirect(route('password.email'))
            ->assertSessionHasErrors('email');

        $this->assertNull(DB::table('password_resets')->first());

        Notification::assertNotSentTo(User::factory()->make([
            'email' => 'nobody@test.com',
        ]), ResetPassword::class);
    }

    public function testAuthDoesNotReceiveEmail()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'test5@test.com',
        ]);

        $this->actingAs($user)->post(route('password.email'), [
            'email' => 'test5@test.com',
        ])
            ->assertRedirect(route('home'));

        $this->assertNull(DB::table('password_resets')->first());

        Notification::assertNotSentTo(User::factory()->make([
            'email' => 'test5@test.com',
        ]), ResetPassword::class);
    }

    public function testUserReceivesResetEmail()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email' => 'test6@test.com',
        ]);

        $this->post(route('password.email'), [
            'email' => 'test6@test.com',
        ]);

        $this->assertNotNull($token = DB::table('password_resets')->first());

        Notification::assertSentTo($user, ResetPassword::class, function ($notification, $channels) use ($token) {
            return Hash::check($notification->token, $token->token) === true;
        });
    }

    // public function testEmailIsAValidEmail()
    // {
    //     $this->from(route('password.email'))->post(route('password.email'), [
    //         'email' => 'invalid-email',
    //     ])
    //         ->assertRedirect(route('password.email'))
    //         ->assertSessionHasErrors('email');
    // }
}