<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Villages extends Model {

    protected $table = 'villages';
    # Disable fungsi timestamps
    public $timestamps = false;    

    public function usermeta()
    {
    	return $this->hasMany(UserMeta::class, 'village_id', 'id');
    }

    public static function villages()
    {
        return self::orderBy('name')->pluck('name', 'id');
    }   
}
