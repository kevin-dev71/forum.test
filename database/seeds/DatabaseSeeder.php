<?php

use App\Category;
use App\Forum;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'kevin apellido',
            'email' => 'kevin@mail.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'remember_token' => str_random(10)
        ]);
        factory(User::class, 50)->create();
        factory(Forum::class, 20)->create();
        factory(Post::class, 80)->create();
        factory(Reply::class, 100)->create();
        factory(Category::class, 10)->create();
    }
}
