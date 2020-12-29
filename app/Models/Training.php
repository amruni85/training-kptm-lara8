<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Training extends Model implements Auditable
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = ['title', 'description', 'trainer', 'attachment']; //penting utk mass assignment

    //buat relationship
    //training belongs to user, so guna relationship user() -- ada FK
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

        //getter $training->attachment_url
    public function getAttachmentUrlAttribute()
    {
        if($this->attachment){     
        return asset('storage/'.$this->attachment);
        }
        else{
            return 'https://www.google.com/search?q=no+image+available&tbm=isch&chips=q:no+image+available,online_chips:icon&hl=en&sa=X&ved=2ahUKEwi5nO6I3eDtAhX4nEsFHbhVC4kQ4lYoA3oECAEQHQ&biw=1349&bih=625#imgrc=KDNppyUHocvEWM';
        }
    }
}
