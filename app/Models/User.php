<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    /**
    // protected $connection = 'mongodb';
    // protected $collection = 'users';
     */
      protected $table = 'users';
      public $primaryKey = 'id';
      public $timestamps = true;
      const CREATED_AT = 'created_at';
      const UPDATED_AT = 'updated_at';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email','email_token', 'approvedEmail', 'fname', 'lname' , 'password', 'roles','user_id', "buildIndex", "hasPistol","hasAxe","health","x","y","z",
        "progress","monsterKilled","deathCount",
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
