<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Route;

class User extends Authenticatable
{
    use Notifiable;
    protected $table  = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function rules()
    {
        switch(Route::getCurrentRoute()->getActionMethod())
        {
            case 'store':
                return [
                    'name'                  => 'required|string',
                    'email'                 => 'required|email',
                    'password'              => 'min:6|required_with:password_confirmation|same:password_confirmation',
                    'password_confirmation' => 'min:6'
                ];
            case 'update':
                return [
                    'name'                  => 'required|string',
                    'email'                 => 'required|email',
                ];
            default:break;
        }

        return [
            
        ];
    }
    public static function message()
    {
        return [
            'name.required'     => 'Name required',
            'email.required'    => 'Email required',
            'password.required' => 'Password required',
        ];
    }
}
