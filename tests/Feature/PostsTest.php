<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_posts()
    {
        $posts = Post::factory()->count(3)->create();

        $response = $this->get(route('posts.index'));

        $response->assertStatus(200);
        $response->assertViewHas('posts', function ($viewPosts) use ($posts) {
            return $viewPosts->count() === $posts->count();
        });
    }

    public function test_store_creates_post_for_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $postData = [
            'title' => 'Test Title',
            'body' => 'Test Body',
        ];

        $response = $this->post(route('posts.store'), $postData);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Title',
            'body' => 'Test Body',
            'user_id' => $user->id,
        ]);
    }

    public function test_show_returns_correct_post()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post));

        $response->assertStatus(200);
        $response->assertViewHas('post', $post);
    }

    public function test_update_updates_post_for_owner()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $updateData = [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ];

        $response = $this->put(route('posts.update', $post), $updateData);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ]);
    }

    public function test_update_fails_for_non_owner()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create();

        $updateData = [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ];

        $response = $this->put(route('posts.update', $post), $updateData);

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('error', 'Unauthorized action.');
    }

    public function test_destroy_deletes_post_for_owner()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('posts.destroy', $post));

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_destroy_fails_for_non_owner()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post = Post::factory()->create();

        $response = $this->delete(route('posts.destroy', $post));

        $response->assertRedirect(route('posts.index'));
        $response->assertSessionHas('error', 'Unauthorized action.');
    }
}
