<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadMessagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function an_authenticated_user_may_read_messages()
    {
        //given we have an authd user, be this user
        // $this->be($contact = factory('App\Contact')->create());
        $contact = factory('App\Contact')->create();

        //add existing thread
        $message = factory('App\Message')->create();

        $response = $this->get('/api/messages');
        $response->assertStatus(200);
    }
}
