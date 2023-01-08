<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    // public function testUserCanViewLoginForm()
    // {
    //     $this->get(route('login'))
    //         ->assertSuccessful()
    //         ->assertViewIs('auth.login');
    // }

    // public function testAuthCanNotViewLoginForm()
    // {
    //     $this->actingAs(User::factory()->create())->get(route('login'))
    //         ->assertRedirect(route('home'));
    // }

    public function testUserCanLogin()
    {
        $user = User::factory()->create([
            'password' => Hash::make('valid-password'),
        ]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'valid-password',
        ])
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($user);
    }

    public function testUserCanNotLoginWithIncorrectPassword()
    {
        $user = User::factory()->create([
            'password' => Hash::make('valid-password'),
        ]);

        $this->from(route('login'))->post(route('login'), [
            'email' => $user->email,
            'password' => 'invalid-password',
        ])
            ->assertRedirect(route('login'))
            ->assertSessionHasErrors('email');
            
        $this->assertGuest();
    }

    // public function testUserCannotLoginWithEmailThatDoesNotExist()
    // {
    //     $this->from(route('login'))->post(route('login'), [
    //         'email' => 'nobody@test.com',
    //         'password' => 'invalid-password',
    //     ])
    //         ->assertRedirect(route('login'))
    //         ->assertSessionHasErrors('email');
    // }

    public function testAuthCanLogout()
    {
        $this->actingAs(User::factory()->create())->post(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    // public function testUserCanNotLogout()
    // {
    //     $this->post(route('logout'))
    //         ->assertRedirect(route('home'));
    // }

    // public function testUserCannotMakeMoreThanFiveAttemptsInOneMinute()
    // {
    //     $user = User::factory()->create([
    //         'password' => Hash::make($password = 'valid-password'),
    //     ]);

    //     foreach (range(0, 5) as $_) {
    //         $response = $this->from(route('login'))->post(route('login'), [
    //             'email' => $user->email,
    //             'password' => 'invalid-password',
    //         ]);
    //     }

    //     $response->assertRedirect(route('login'))
    //             ->assertSessionHasErrors('email');

    //     $this->assertMatchesRegularExpression(
    //         sprintf('/^%s$/', str_replace('\:seconds', '\d+', preg_quote(__('auth.throttle'), '/'))),
    //         collect(
    //             $response
    //                 ->baseResponse
    //                 ->getSession()
    //                 ->get('errors')
    //                 ->getBag('default')
    //                 ->get('email')
    //         )->first()
    //     );
    // }
}
