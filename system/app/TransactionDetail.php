<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_detail';

    public function item(){
      return $this->hasOne('App\Item', 'id', 'item_id');
    }
}
