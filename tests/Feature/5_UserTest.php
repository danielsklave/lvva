<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanNotViewProfile()
    {
        $this->get(route('profile'))
            ->assertRedirect(route('login'));
    }

    public function testUserCanViewProfileWhenAuthenticated()
    {
        $this->actingAs(User::factory()->create())->get(route('profile'))
            ->assertSuccessful()
            ->assertViewIs('profile');
    }

    public function testAuthCanNotChangePasswordWithEmptyFields()
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $this->actingAs(User::factory()->create())->from(route('profile'))
            ->post(route('users.change_password'), [
                'current_password' => '',
                'new_password' => '',
                'new_password_confirmation' => ''
            ])
            ->assertRedirect(route('profile'))
            ->assertSessionHasErrors(['new_password', 'current_password']);
            
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }

    public function testAuthCanChangePassword()
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password'),
        ]);

        $this->actingAs($user)
            ->post(route('users.change_password'), [
                'current_password' => 'old-password',
                'new_password' => 'new-password',
                'new_password_confirmation' => 'new-password'
            ])
            ->assertRedirect(route('login'));

        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));

        $this->assertGuest();
    }

    public function testAuthCanBeDeleted()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->delete(route('users.destroy'))
            ->assertRedirect(route('home'));

        $this->assertDatabaseMissing('users', $user->toArray());

        $this->assertGuest();
    }
}