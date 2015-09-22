<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Site extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'domain', 'street', 'city', 'state', 'zip', 'phone'];

    protected $dates=['deleted_at'];




    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function jobs()
    {
        return $this->hasMany(SiteJob::class);
    }
}
