<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class People extends Model
{
    use SoftDeletes;
    protected $table = 'peoples';
    protected $fillable = [
        'agency_id', 'name', 'department', 'email', 'description', 'image'
    ];

    public function agency()
    {
        return $this->belongsTo('App\Agency')->withTrashed();
    }
}
