<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailMemo extends Model
{
    protected $fillable = [
        'memo_id',
        'odependency_id',
        'ddependency_id',
        'date_entry',
        'date_exit',
        'obs',
        'state_id',
        'admin_user_id',

    ];


    protected $dates = [
        'date_entry',
        'date_exit',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];
    protected $with = ['post_odependencia_detalle', 'post_ddependencia_detalle', 'estado_detalle', 'user_admin_detalle'];

    public function post_odependencia_detalle()
    {
        return $this->belongsTo('App\Models\Dependency', 'odependency_id', 'id');

    }

    public function post_ddependencia_detalle()
    {
        return $this->belongsTo('App\Models\Dependency', 'ddependency_id', 'id');

    }

    public function estado_detalle()
    {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');

    }

    public function user_admin_detalle()
    {
        return $this->hasOne(AdminUser::class, 'id', 'admin_user_id');
    }


    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/detail-memos/'.$this->getKey());
    }
}
