<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 客戶端
 *
 * @property string client_id
 *
 * @mixin \Eloquent
 */
class Client extends Model
{
    protected $fillable = [
        'client_id',
    ];
}
