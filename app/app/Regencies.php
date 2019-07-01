<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regencies extends Model {

    protected $table = 'regencies';
    # Disable fungsi timestamps
    public $timestamps = false;

    public function usermeta()
    {
    	return $this->hasMany(UserMeta::class, 'regencie_id', 'id');
    }

    public static function regencies()
    {
        return self::orderBy('name')->pluck('name', 'id');
    }
       
}
