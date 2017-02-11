<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;

    const CREATED_AT = 'created';

    const UPDATED_AT = 'modified';

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'clients';

    /**
     *  Setting primary key
     * @var string
     */
    protected $primaryKey = 'client_id';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_nm', 'last_nm', 'email_nm', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
