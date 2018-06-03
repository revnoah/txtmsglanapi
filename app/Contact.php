<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends BaseModel
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'phone_number', 'user_id'
  ];

/*
  public function user()
  {
    return $this->belongsTo(User::class);
  }
*/

}
