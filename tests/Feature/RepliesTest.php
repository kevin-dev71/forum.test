<?php

namespace Tests\Feature;

use App\Forum;
use App\Post;
use App\Reply;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RepliesTest extends TestCase
{
    use DatabaseMigrations;

    protected $forum, $post, $user;

    protected function setUp() {
        parent::setUp();
        $this->forum = factory(Forum::class)->create();

        $this->user = factory(User::class)->create();

        $this->post = factory(Post::class)->create([
            'user_id' => $this->user->id,
            'forum_id' => $this->forum->id,
        ]);
    }

    /** @test */
    public function any_can_see_replies() {
        $reply = factory(Reply::class)->create([
            "user_id" => $this->user->id,
            "post_id" => $this->post->id
        ]);

        $response = $this->get("/posts/" . $this->post->slug);

        $response->assertSee($reply->reply);
    }

    /** @test */
    public function an_user_logged_can_submit_replies() {
        $this->withExceptionHandling();

        $this->signIn();

        $reply = factory(Reply::class)->make([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id,
            'reply'   => null
        ]);

        $response = $this->post("/replies", $reply->toArray());

        $response->assertSessionHasErrors('reply');

        $reply->reply = "Nueva respuesta de pruebas";

        $response = $this->post(
            '/replies',
            $reply->toArray()
        );

        $response
            ->assertStatus(302)
            ->assertSessionHas('message', ['success', __('Respuesta añadida correctamente')]);
    }
}
