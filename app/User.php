<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\FuncCall;

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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function articles()
    {
        return $this->hasMany(Article::class); 
        
        //select * from articles where user_id = 1(current users instance)
    }
    /*
    public function projects()
    {
        return $this->hasMany(Project::class);
        //select * from projects where user_id = 1(current users instance)
    }*/

     

}

//$user->articles
//$user->projects

//$user= user::find(1); // select * from user where the id = 1;
//$user->projects; // select * from projects where user_id = $user->id;



