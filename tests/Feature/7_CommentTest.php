<?php

namespace Tests\Feature\Auth;

use App\User;
use App\Comment;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testAuthCanNotCreateEmptyComment()
    {
        $post = Post::factory([
            'is_published' => 1,
            'category' => 'new'
        ])->create();

        $user = User::factory()->create();

        $this->actingAs($user)->from(route('news.show', $post))
            ->post(route('posts.comment', $post), [
                'comment' => '',
            ])
            ->assertRedirect(route('news.show', $post))
            ->assertSessionHasErrors('comment');
            
        $this->assertEquals(0, Comment::count());
    }

    public function testUserCanNotCreateComment()
    {
        $post = Post::factory(['is_published' => 1])->create();

        $this->post(route('posts.comment', $post), [
                'comment' => 'test',
            ])
            ->assertRedirect(route('login'));
            
        $this->assertEquals(0, Comment::count());
    }

    public function testAuthCanCreateComment()
    {
        $post = Post::factory([
            'category' => 'new',
            'is_published' => 1
        ])->create();

        $user = User::factory()->create();

        $this->actingAs($user)->from(route('news.show', $post))
            ->post(route('posts.comment', $post), [
                'comment' => 'test',
            ])
            ->assertRedirect(route('news.show', $post))
            ->assertSessionHasNoErrors();
            
        $comment = Comment::find(Comment::count());

        $this->assertEquals($comment->post_id, $post->id);
        $this->assertEquals($comment->user_id, $user->id);
        $this->assertEquals($comment->body, 'test');

    }

    public function testAuthCanDeleteOwnComment()
    {
        $post = Post::factory(['is_published' => 1])->create();
        
        $user = User::factory()->create();

        $comment = Comment::factory([
            'post_id' => $post->id,
            'user_id' => $user->id
        ])->create();

        $this->actingAs($user)->from(route('news.show', $post))->delete(route('comments.destroy', $comment))
            ->assertRedirect(route('news.show', $post));
            
        $this->assertDatabaseMissing('comments', $comment->toArray());
    }

    public function testAuthCanNotDeleteNotOwnComment()
    {
        $post = Post::factory(['is_published' => 1])->create();
        
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $comment = Comment::factory([
            'post_id' => $post->id,
            'user_id' => $user2->id
        ])->create();

        $this->actingAs($user)->from(route('news.show', $post))->delete(route('comments.destroy', $comment))
            ->assertRedirect(route('news.show', $post));

        $this->assertModelExists($comment);
    }

    public function testAdminCanDeleteNotOwnComment()
    {
        $post = Post::factory(['is_published' => 1])->create();
        
        $user = User::factory()->create(['is_admin' => 1]);
        $user2 = User::factory()->create();

        $comment = Comment::factory([
            'post_id' => $post->id,
            'user_id' => $user2->id
        ])->create();

        $this->actingAs($user)->from(route('news.show', $post))->delete(route('comments.destroy', $comment))
            ->assertRedirect(route('news.show', $post));
            
        $this->assertDatabaseMissing('comments', $comment->toArray());
    }
}