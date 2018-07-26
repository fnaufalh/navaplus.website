<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'agency_id', 'category_id', 'name', 'client', 'quote', 'description', 'main_image', 'image_1', 'image_2'
    ];

    public function agency()
    {
        return $this->belongsTo('App\Agency')->withTrashed();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTrashed();
    }
    
}
