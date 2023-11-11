<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title','image','status','publish_date','content','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
