<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use \App\User;
use Illuminate\Auth\Guard;

class SiteJobScope implements ScopeInterface
{
    public function apply(Builder $builder, Model $model)
    {
        if(session()->get('site')!=1) {
            $builder->where('site_id', session()->get('site'));
        }
        $user=auth()->user();
        if(!$user->isAdmin()) {
            $builder->whereIn('pub_id', $user->pubIDs());
        }
    }

    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();
        foreach((array)$query->wheres as $key => $where) {
            if($where['column'] == 'site_id') {
                unset($query->wheres[$key]);
                $query->wheres = array_values($query->wheres);
            }
            if($where['column'] == 'pub_id') {
                unset($query->wheres[$key]);
                $query->wheres = array_values($query->wheres);
            }
        }
    }

}