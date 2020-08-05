<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Program extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id', 'category_id', 'photo', 'description', 'title', 'hastag', 'subhastag'
    ];

    protected $hidden = [
        
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
