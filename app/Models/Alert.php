<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'currency_id',
        'min',
        'max',
    ];
}