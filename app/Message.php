<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends BaseModel
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'message_text', 'message_type', 'message_status',
  ];

  public function sender()
  {
    return $this->belongsTo(Contact::class);
  }

  public function recipient()
  {
    return $this->belongsTo(Contact::class);
  }

}
