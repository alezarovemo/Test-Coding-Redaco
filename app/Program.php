<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Program extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id', 'photo', 'audio', 'description', 'title', 'start', 'end', 'name',
    ];

    protected $hidden = [
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
