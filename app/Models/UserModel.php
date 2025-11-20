<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasFactory,HasApiTokens;
    protected  $table = "user_table";
    protected $primaryKey = "user_id";
    protected $fillable = [
        "role_id",
        "email",
        "password"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function detail(){
        return $this->hasOne(UserDetail::class,'user_id','user_id');
    }
}
