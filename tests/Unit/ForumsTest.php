<?php

namespace Tests\Unit;

use App\Forum;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ForumsTest extends TestCase
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
    public function a_forum_has_posts() {
        $this->assertCount(1, $this->forum->posts);
        $this->assertInstanceOf(Collection::class, $this->forum->posts);
    }

    /** @test */
    public function a_forum_has_replies() {
        factory(Reply::class, 5)->create([
            "user_id" => $this->user->id,
            "post_id" => $this->post->id,
        ]);

        $this->assertCount(5, $this->forum->replies);
        $this->assertInstanceOf(Collection::class, $this->forum->replies);
    }
}
