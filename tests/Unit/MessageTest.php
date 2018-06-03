<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MessageTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function it_has_a_sender()
    {
        $message = factory('App\Message')->create();

        //$response = factory('App\Message')->create();
        //$response->assertStatus(201);

        $response = $this->get('/api/messages');
        $response->assertStatus(200);

        //$this->assertInstanceOf('App\Contact', $message->sender_id);

        //$this->assertInstanceOf('App\User', $message->sender_id);
    }

    /** @test */
    function it_has_a_recipient()
    {
        $message = factory('App\Message')->create();

        $response = $this->get('/api/messages');
        $response->assertStatus(200);

        //$this->assertInstanceOf('App\Contact', $message->recipient_id);

        //$this->assertInstanceOf('App\User', $message->recipient_id);
        //$this->assertInstanceOf('unsignedInteger', $message->recipient_id);
    }

}
