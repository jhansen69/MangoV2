<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kodeine\Acl\Traits\HasRole;
use Illuminate\Auth\Guard;
use App\Site;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, HasRole;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password', 'first_name', 'last_name', 'avatar', 'online'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'kjk34Token'];

    public function toggleStatus($userid,$status)
    {
        $user=User::findOrFail($userid);
        $user->online = $status;
        $user->save();
    }

    public function recent()
    {
        /*
         * This will generate a short list (~5 items) of the recent items that relate to this user's role
         * so account person might be PO, or newsprint received. Press person would be upcoming jobs
         */
        $recent['test/job/1']="Test Job 1";
        $recent['test/job/2']="Test Job 2";
        return $recent;
    }

    public function messageCount()
    {
        /*
         * will return an integer representing the number of new or marked as unread messages
         *
         */

        return 3;
    }

    public function isAdmin()
    {
        return $this->kjk34Token;
    }
/*
    public function getSitesAttribute()
    {
        if (!$this->relationLoaded('sites')) {
            $this->load('sites');
        }

        if ($this->sites->contains(1)) {
            return $this->sites()->getRelated()->newQuery()->orderBy('name', 'asc')->get();
            // the same as:
            // Site::orderBy('name', 'asc')->get();
        }

        return $this->getRelation('sites');
    }
*/
    public function sites()
    {
        return $this->belongsToMany(Site::class)->withTimestamps();

    }

    public function pubs()
    {
        return $this->belongsToMany(Pub::class)->withTimestamps();
    }

    public function pubIDs()
    {
        $ids=[];
        foreach($this->pubs as $pub)
        {
            $ids[]=$pub->id;
        }
        return $ids;
    }

    public function allSites()
    {
        $sites=Site::orderBy('name','ASC')->get();
        return $sites;
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
