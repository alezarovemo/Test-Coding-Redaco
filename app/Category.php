<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;

    protected $fillable = [
        'category',
    ];

    protected $hidden = [
        
    ];
    

    public function program()
    {   
        return $this->hasMany(Program::class, 'category_id');   
    }
}
