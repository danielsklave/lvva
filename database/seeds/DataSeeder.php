<?php

use App\Post;
use App\Comment;
use App\User;
use App\File;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Post::truncate();
        Comment::truncate();
        File::truncate();

        factory(User::class, 10)->create();
        factory(Post::class, 200)->create();
        factory(Comment::class, 40)->create();
        factory(File::class, 19)->create();

        $user = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@laravelproject.com',
            'password'  => bcrypt('admin')
        ]);

        $user->is_admin = true;
        $user->save();
    }
}
