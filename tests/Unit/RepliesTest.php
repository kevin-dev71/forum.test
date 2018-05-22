<?php

namespace Tests\Unit;

use App\Forum;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RepliesTest extends TestCase {
    use DatabaseMigrations;

    protected $user, $forum, $post, $reply;

    protected function setUp() {
        parent::setUp();
        $this->user  = factory( User::class )->create();
        $this->forum = factory( Forum::class )->create();
        $this->post  = factory( Post::class )->create([
            "user_id"  => $this->user->id,
            "forum_id" => $this->forum->id
        ]);
        $this->reply = factory(Reply::class)->create([
            "user_id" => $this->user->id,
            "post_id" => $this->post->id
        ]);
    }

    /** @test */
    public function a_reply_is_related_with_a_forum() {
        $this->assertInstanceOf(Forum::class, $this->reply->forum);
    }

    /** @test */
    public function a_reply_belongs_to_author() {
        $this->assertInstanceOf(User::class, $this->reply->author);
    }

    /** @test */
    public function a_reply_belongs_to_post() {
        $this->assertInstanceOf(Post::class, $this->reply->post);
    }
}