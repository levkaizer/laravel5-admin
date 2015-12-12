<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UrlAlias extends Model
{
    //
    use SoftDeletes;
    protected $table = 'url_aliases';
    protected $dates = ['deleted_at'];
    
    public function content()
    {
        return $this->belongsTo('App\Content');
    }
}
