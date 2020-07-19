<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model {
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'customer_id', 'balance', 'session_id', 'token', 'created_at', 'updated_at'
    ];
}