<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $fillable = ['user_id','provider_id', 'link_picture', 'name', 'name_oblio'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}