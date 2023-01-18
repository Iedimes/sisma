<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCedula extends Model
{
    protected $fillable = [
        'user_id',
        'cedula',

    ];


    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    protected $with = ['sql_user'];

    public function sql_user()
    {
        return $this->hasOne(RHM006::class, 'FuncNro', 'cedula');
    }

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/user-cedulas/'.$this->getKey());
    }
}
