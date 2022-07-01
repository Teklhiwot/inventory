<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catagory extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'catagory_name',
        
    ];

    public function user()
    {
           return $this->hasOne(User::class,'id','user_name');     
    }
}
