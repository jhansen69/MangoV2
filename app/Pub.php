<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pub extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name','color', 'site_id'];

    public function runs()
    {
        return $this->hasMany(PressRun::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
