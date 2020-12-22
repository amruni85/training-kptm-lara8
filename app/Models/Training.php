<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'trainer', 'attachment']; //penting utk mass assignment

    //buat relationship
    //training belongs to user, so guna relationship user() -- ada FK
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

        //getter $training->attachment_url
    public function getAttachmentUrlAttribute()
    {
        return asset('storage/'.$this->attachment);
    }
}
