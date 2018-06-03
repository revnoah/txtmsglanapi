<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;

use App\Contact;
use App\Message;

class MessageController extends Controller
{
    //private unsignedBigInteger phone_number;

    private $user = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: get messages for user
        $messages = Message::where('recipient_id', '=', 1)->get();

        return response()->json([
          'message' => 'Recent messages',
          'data' => $messages
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //get user
      $user = $this->getAuthenticatedUser();

      $message_type = $request->message_type;
      switch($message_type) {
        case 'sent':
          //sent by user

          break;
        case 'received':
        default:
          //received by user


          break;
      }

      //get sender
      $senderAddress = $request->sender_address;
      $sender = $this->getContactByPhoneNumber($senderAddress);

      //store new message
      $message = new Message;
      $message->message_text = $request->message_text;
      $message->message_status = $request->message_status;
      $message->message_type = $request->message_type;
      $message->sender_id = $sender->id;
      $message->recipient_id = $user->contact->id;
      $result = $message->save();

      if($result) {
        $response = array(
          'status' => 200,
          'data' => array(
            'message' => $message
          )
        );
      } else {
        $response = array(
          'status' => 500,
          'message' => 'Internal server error'
        );
      }

      return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //return requested message
        return response()->json([
          'status' => 'success',
          'data' => $message
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //TODO: ensure user has access to the message
        $message->delete();
    }

    public function pollNewMessages()
    {
        //get user
        try {
          //get user id from current user
          $contact = $this->getCurrentUser();

          //get messages for current uesr
          $last_message = Message::where('message_type', '=', 'sent')
            ->where('sender_id', '=', $contact->id)
            ->orderBy('id', 'desc')
            ->select('created_at')
            ->first();

          //get new messages for user and return count and/or timestamp
          $response = array(
            'data' => $last_message
          );

          return response()->json(
            $response, 200
          );
        } catch(Exception $e) {
          $response = array(
            'status' => 'error',
            'message' => $e->getMessage.toString()
          );

          return response()->json(
            $response, $e->getStatusCode
          );
        }
    }

    private function getCurrentUser()
    {
      $contact = $this->setCurrentUser();

      return $contact;
    }

    private function setCurrentUser($user = null)
    {
      //set user, accept user object or get from jwt token
      if($user != null) {
        $this->user = $user;
      } else {
        $this->user = $this->getAuthenticatedUser();
      }

      //attempt to get contact associated with user_id
      $contact = Contact::where('user_id', '=', $this->user->id)->first();

      Log::debug('user and contact');
      Log::debug($this->user->id);
      Log::debug($contact->id);

      //contact does not exist, create
      if(!$contact->exists()) {
        $contact = new Contact;
        $contact->user_id = $this->user->id;
        $contact->phone_number = '5191234560';
        $contact->save();
      }

      return $contact;
    }

    private function getNewOutgoingMessages()
    {
      $messages = Message::where('sender_id', '=', '')->get();

      return $messages;
    }

    //get authenticated user from bearer token or throw exception
    private function getAuthenticatedUser()
    {
    	try {
    		if (! $user = JWTAuth::parseToken()->authenticate()) {
    			return response()->json(['user_not_found'], 404);
    		}

    	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

    		return response()->json(['token_expired'], $e->getStatusCode());

    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

    		return response()->json(['token_invalid'], $e->getStatusCode());

    	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

    		return response()->json(['token_absent'], $e->getStatusCode());
    	}

    	// the token is valid and we have found the user via the sub claim
    	return $user;
    }

    public function test() {
        //$this->getContactByPhoneNumber('123456');

        return response()->json([
          "message" => "test"
        ], 200);
    }

    //get contact by phone number, create if non-existent
    private function getContactByPhoneNumber($phoneNumber) {
        //attempt to find contact with phone number
        $contact = Contact::where('phone_number', '=', $phoneNumber)->first();
        if($contact == null) {
          $contact = new Contact();
          $contact->phone_number = $phoneNumber;
          $contact->save();
        }

        return $contact;
    }
}
