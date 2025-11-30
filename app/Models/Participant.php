<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registered;

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
}
