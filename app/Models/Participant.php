<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registered;
use App\Models\Event;

class Participant extends Model
{
    use HasFactory;
    
    protected $table = "participant_table";
    protected $primaryKey = "participant_id";
    protected $fillable = [
        "event_id",
        "session_id",
        "registered_id",
    ];


    public function registered(){
        return $this->belongsTo(Registered::class,'registered_id','registered_id');
    }
    public function event(){
        return $this->belongsTo(Event::class,'event_id','event_id');
    }
}