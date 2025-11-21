<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;
    
    protected $table = "user_detail_table";
    public $timestamps = false;
    protected $primaryKey = "user_detail_id";
    protected $fillable = [
        "user_id",
        "user_name",
        "address",
        "user_phone",
        "user_status"
    ];

    public function user(){
        return $this->belongsTo(UserModel::class,'user_id','user_id');
    }
}
