<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'document', 'name', 'email', 'cellphone', 'created_at', 'updated_at'
    ];
}