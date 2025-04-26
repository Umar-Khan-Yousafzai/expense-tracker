<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{

    protected $table = 'settlements';

    protected $fillable = [
        'payer_id',
        'receiver_id',
        'amount',
        'settled_at',
    ];

    // Relationships
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }//end payer()


    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }//end receiver()


}//end class
