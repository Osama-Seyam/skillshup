<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [
        'id' ,
        'created_at',
        'updated_at'
    ];

    public function skills(){
        return $this->hasMany(Skill::class);
    }

    public function nameLang($lang = null){
        $lang = $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }

    public function scopeActive($query){
        return $query->where('active',1);
    }
}
