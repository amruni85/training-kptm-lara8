<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'trainer'];

    //buat relationship
    //training belongs to user, so guna relationship user() -- ada FK
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
