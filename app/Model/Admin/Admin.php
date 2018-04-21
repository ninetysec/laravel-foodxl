<?php

namespace App\Model\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mysql';

    protected $table      = 'admins';

    protected $primaryKey = 'adminid';

    public    $timestamps = false;

    protected $fillable = [
        'name', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
