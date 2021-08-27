<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class User extends Eloquent implements Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, AuthenticatableTrait;

    protected $connection = 'mongodb';
    protected $collection = 'users';
    /**
     * protected $table = 'users';
     * public $primaryKey = 'id';
     * public $timestamps = true;
     * const CREATED_AT = 'created_at';
     * const UPDATED_AT = 'updated_at';
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'fname', 'lname' , 'password',
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
