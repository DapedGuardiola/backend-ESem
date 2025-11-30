<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Event extends Authenticatable
{
    use HasFactory,HasApiTokens,Notifiable;
    protected  $table = "event_table";
    protected $primaryKey = "event_id";
    protected $fillable = [
        "event_name",
        "event_status",
    ];

    public function eventDetail(){
        return $this->hasOne(EventDetail::class,'event_id','event_id');
    }
}
