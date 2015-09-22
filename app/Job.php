<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    //
    use SoftDeletes;

    protected $table='jobs';

    protected $dates = ['deleted_at', 'product_date', 'request_date', 'start', 'end'];

    protected $fillable = ['type', 'user_id', 'site_id', 'product_date', 'request_date', 'settings', 'source',
    'recurrence_id', 'start', 'end', 'pub_id', 'run_id', 'equipment_id', 'tied_to_id'];

    protected $casts = [ 'settings' => 'json'];

    /**
     * Get the user settings.
     *
     * @return Settings
     */
    public function settings()
    {
        return new Settings($this->settings, $this);
    }


    public function scopeOfType($query,$type)
    {
       return $query->where('type',$type);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function pub()
    {
        return $this->belongsTo(Pub::class);
    }

    public function pressRun()
    {
        return $this->belongsTo(PressRun::class);
    }

}
