<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    public function transaction(){
      return $this->hasMany('App\TransactionDetail', 'item_id', 'id'); 
    }
}
