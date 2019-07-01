<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model {

    protected $table = 'provinces';
    # Disable fungsi timestamps
    public $timestamps = false;

    public function usermeta()
    {
    	return $this->hasMany(UserMeta::class, 'province_id', 'id');
    }

    public static function provinces()
    {
        return self::orderBy('name')->pluck('name', 'id');
    }
       
}
