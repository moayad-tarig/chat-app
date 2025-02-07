<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Message;

use App\Models\User;

it('return 302 status code', function () {
    $receiver = User::factory()->create();
    $response = $this->get('/messages/'.$receiver->id);
    $response->assertStatus(302);
    $response->assertRedirect('/login');
});

it('return 200 status code', function () {
    $sender = User::factory()->create();
    $receiver = User::factory()->create();
    $this->actingAs($sender);
    $response = $this->get('/messages/'.$receiver->id);
    $response->assertStatus(200);
});
