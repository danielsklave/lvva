<?php

namespace Tests\Feature\Auth;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanNotCreatePost()
    {        
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('news.store'), [
            'title' => 'test',
            'created_at' => '31.12.2022',
        ])
            ->assertRedirect(route('login'));
            
        $this->assertEquals(0, Post::count());
    }

    public function testAdminCanNotCreateEmptyPost()
    {        
        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user)->from(route('news.create'))->post(route('news.store'), [
            'title' => '',
            'created_at' => '',
        ])
            ->assertRedirect(route('news.create'))
            ->assertSessionHasErrors(['title', 'created_at']);
            
        $this->assertEquals(0, Post::count());
    }

    public function testAdminCanCreatePost()
    {        
        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user)->post(route('news.store'), [
            'title' => 'test',
            'created_at' => '31.12.2022',
        ])
            ->assertRedirect(route('news.show', $post = Post::find(Post::count())));

        $this->assertEquals($post->user_id, $user->id);
        $this->assertEquals($post->title, 'test');
        $this->assertEquals($post->created_at->format('d.m.Y'), '31.12.2022');
    }

    public function testAdminCanDeletePost()
    {        
        $post = Post::factory([
            'category' => 'new',
            'cover_image' => null
        ])->create();

        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user)->delete(route('news.destroy', $post))
            ->assertRedirect(route('news.index'));
            
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    public function testUserCanViewHome()
    {
        $this->get(route('home'))
            ->assertSuccessful()
            ->assertViewIs('home');
    }

    public function testUserCanViewPostCategory()
    {
        $this->get(route('news.index'))
            ->assertSuccessful()
            ->assertViewIs('news');
    }

    public function testUserCanViewPublishedPost()
    {
        $post = Post::factory([
            'category' => 'new',
            'is_published' => 1
        ])->create();

        $this->get(route('news.show', $post))
            ->assertSuccessful()
            ->assertViewIs('posts.show');
    }

    public function testUserCanNotViewUnpublishedPost()
    {
        $post = Post::factory([
            'category' => 'new',
            'is_published' => 0
        ])->create();

        $this->get(route('news.show', $post))
            ->assertRedirect(route('home'));
    }

    public function testAdminCanViewUnpublishedPost()
    {
        $post = Post::factory([
            'category' => 'new',
            'is_published' => 0
        ])->create();
        
        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user)->get(route('news.show', $post))
            ->assertSuccessful()
            ->assertViewIs('posts.show');
    }

    public function testAdminCanViewAllPosts()
    {        
        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user)->get(route('posts.index'))
            ->assertSuccessful()
            ->assertViewIs('posts');
    }

    public function testUserCanNotViewAllPosts()
    {        
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('posts.index'))
            ->assertRedirect(route('login'));
    }
}