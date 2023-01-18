<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependency extends Model
{
    protected $fillable = [
        'code',
        'name',
        'ncl',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];
    protected $with = ['post_sqldependencia'];

    public function post_sqldependencia()
    {
        return $this->belongsTo('App\Models\SIG008', 'code', 'DepenCod');

    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/dependencies/'.$this->getKey());
    }
}
