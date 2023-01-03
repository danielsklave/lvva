<?php

namespace Database\Seeders;

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

        User::factory()->count(10)->create();
        Post::factory()->count(200)->create();
        Comment::factory()->count(40)->create();
        File::factory()->count(19)->create();

        $user = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@laravelproject.com',
            'password'  => bcrypt('admin')
        ]);

        $user->is_admin = true;
        $user->save();
    }
}
