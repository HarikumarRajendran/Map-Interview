<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected function createUser($name = '', $email = '', $password = '') {

        $InAry = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];

        $Usr = $this->create($InAry);
        return $Usr->id;
    }

    protected function checkLogin($usrnm = '', $pwd = ''){

        $chkUsr = $this->where('email', $usrnm)->where('password', $pwd)->first();

        if($chkUsr){

           return $chkUsr;
    
        }   
        
        return false;
    }

}
