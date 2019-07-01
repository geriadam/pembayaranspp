<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districts extends Model {

    protected $table = 'districts';
    # Disable fungsi timestamps
    public $timestamps = false;

    public function usermeta()
    {
    	return $this->hasMany(UserMeta::class, 'district_id', 'id');
    }

    public static function districts()
    {
        return self::orderBy('name')->pluck('name', 'id');
    }
       
}
