<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'motto', 'description', 'background_color', 'icon', 'logo', 'banner'
    ];

    public function works()
    {
        return $this->hasMany('App\Work')->withTrashed();
    }

    public function people()
    {
        return $this->hasMany('App\People')->withTrashed();
    }
}
