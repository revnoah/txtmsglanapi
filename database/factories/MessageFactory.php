<?php

//TODO: review factory and test
use Faker\Generator as Faker;
use App\Message;
use App\Contact;

//TODO: test factory
$factory->define(Message::class, function (Faker $faker) {
    $user_id = 1;

    //set message type and user ids
    $message_type = str_random(1) == 1 ? 'sent' : 'received';
    switch($message_type) {
      case 'sent':
        $sender_id = 1;
        $recipient_id = factory('App\User')->create()->id;

        break;
      case 'received':
      default:
        $sender_id = factory('App\User')->create()->id;
        $recipient_id = 1;
        break;
    }

    //set sender and recipient
    $sender = factory('App\Contact')->create([
      'phone_number' => $faker->phoneNumber,
      'user_id' => $sender_id
    ]);
    $recipient = factory('App\Contact')->create([
      'phone_number' => $faker->phoneNumber,
      'user_id' => $recipient_id
    ]);

    //return stuff
    return [
        'recipient_id' => $recipient->user_id,
        'sender_id' => $sender->user_id,
        'message_type' => $message_type,
        'message_status' => 'draft',
        'message_text' => $faker->text
    ];
});
