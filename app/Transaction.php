<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['code', 'name', 'address','portal_code', 'ekspedisi','user_id','product_id'];

    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    protected $casts = [
        'ekspedisi' => 'array'
    ];


}
