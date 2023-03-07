<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;

class Memo extends Model implements HasMedia
{
    use ProcessMediaTrait;
    use AutoProcessMediaTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    protected $fillable = [
        'odependency_id',
        'number_memo',
        'ref',
        'obs',
        'date_doc',
        'date_entry',
        'date_exit',
        'ddependency_id',
        'admin_user_id',
        'state_id',
        'type_id',

    ];


    protected $dates = [
        'date_doc',
        'date_entry',
        'date_exit',
        'created_at',
        'updated_at',

    ];

    protected $appends = ['resource_url'];

    protected $with = ['user_admin', 'imagen', 'post_odependencia', 'post_ddependencia', 'estado', 'tipo_doc', 'origen', 'destino'];

    public function user_admin()
    {
        return $this->hasOne(AdminUser::class, 'id', 'admin_user_id');
    }

    public function imagen()
    {
        return $this->belongsTo('App\Models\Medium', 'id', 'model_id');

    }

    public function origen()
    {
        return $this->belongsTo('App\Models\Dependency', 'odependency_id', 'id');

    }

    public function destino()
    {
        return $this->belongsTo('App\Models\Dependency', 'ddependency_id', 'id');

    }

    public function post_odependencia()
    {
        return $this->hasOne(DetailMemo::class)->latest();

    }


    public function post_ddependencia()
    {
        return $this->hasOne(DetailMemo::class)->latest();

    }

    // public function estado_name()
    // {
    //     return $this->belongsTo('App\Models\State', 'state_id', 'id');

    // }


    public function estado()
    {
        return $this->hasOne(DetailMemo::class)->latest();
    }



    public function tipo_doc()
    {
        return $this->belongsTo('App\Models\DocType', 'type_id', 'id');

    }


    function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            //->accepts('image/*')
            ->maxFilesize(10 * 1024 * 1024)
            ->maxNumberOfFiles(5);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        /*$this->addMediaConversion('detail_hd')
            ->width(1920)
            ->height(1080)
            ->performOnCollections('gallery');*/
        $this->autoRegisterThumb200();
    }




    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/memos/'.$this->getKey());
    }



}
