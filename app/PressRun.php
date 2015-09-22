<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PressRun extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name', 'pub_id'];

    public function pub()
    {
        return $this->belongsTo('App\Pub');
    }

    public function job()
    {
        return $this->belongsToMany('App\Job');
    }
}
