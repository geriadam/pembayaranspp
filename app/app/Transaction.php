<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Santri;

class Transaction extends Model
{    
    const active   = 0;
	const deactive = 1;

    public $timestamps 	  = true;
    protected $table 	  = 'transaction';
    protected $primaryKey = 'transaction_id';
    protected $fillable   = ['transaction_number','transaction_date','santri_id','transaction_total'];

    public static function rules()
    {
    	return [
    		'santri_id' => 'required',
    	];	
    }

    public static function message()
    {
    	return [
    		'santri_id.required' => 'Nama santri harus di isi',
    	];
    } 

    public function santri()
    {
    	return $this->belongsTo('App\Santri', 'santri_id', 'santri_id');
    }

    public static function dropdownSantri()
    {
        return Santri::where('is_deleted', Santri::active)->orderBy('santri_name')->pluck('santri_name', 'santri_id');
    }
}
