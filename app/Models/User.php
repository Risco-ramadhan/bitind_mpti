<?php

namespace App\Models;

use App\Notifications\VerifyEmailCode;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;



class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'bussiness_name',
        'id_country',
        'id_city',
        'phone_number',
        'role',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime'];


    public function getJWTIdentifier()
    {
        return $this->getKey();

    }//end getJWTIdentifier()


    public function getJWTCustomClaims()
    {
        return [];

    }//end getJWTCustomClaims()



    public function generateEmailCode(){
        $this -> timestamps = false;
        $this -> email_code_verify = rand(100000,999999);
        $this -> email_code_expires_at = now()->addMinutes(10);
        $this -> save();
    }

    public function resetEmailCode(){
        $this ->timestamps = false;
        $this ->email_code_expires = null;
        $this -> save();

    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailCode); 
    }


}//end class
