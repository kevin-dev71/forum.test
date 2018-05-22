<?php

namespace Tests\Unit;

use App\Category;
use App\Forum;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use DatabaseMigrations;

    protected $user, $forum, $post;

    protected function setUp() {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->forum = factory(Forum::class)->create();
        $this->post = factory(Post::class)->create([
            "user_id" => $this->user->id,
            "forum_id" => $this->forum->id
        ]);
    }

    /** @test */
    public function a_post_belongs_to_forum() {
        $this->assertInstanceOf(Forum::class, $this->post->forum);
    }

    /** @test */
    public function a_post_belongs_to_an_owner() {
        $this->assertInstanceOf(User::class, $this->post->owner);
    }

    /** @test */
    public function a_post_has_categories() {
        $categories = factory(Category::class, 5)->create();

        $this->post->categories()->attach($categories->pluck("id"));

        $this->assertCount(5, $this->post->categories);
        $this->assertInstanceOf(Collection::class, $this->post->categories);
    }

    /** @test */
    public function a_post_has_replies() {
        factory(Reply::class, 10)->create([
            "user_id" => $this->user->id,
            "post_id" => $this->post->id,
        ]);

        $this->assertCount(10, $this->post->replies);
        $this->assertInstanceOf(Collection::class, $this->post->replies);
        $this->assertInstanceOf(Reply::class, $this->post->replies->first());
    }
}
