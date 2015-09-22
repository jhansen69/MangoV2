<?php
namespace App;


class SiteJob extends Job
{
    protected static function boot()
    {
        static::addGlobalScope(new Scopes\SiteJobScope);
        parent::boot();
    }
}