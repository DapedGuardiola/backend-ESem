<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
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
