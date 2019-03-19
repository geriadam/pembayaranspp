<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Santri;
use Carbon\Carbon;
use DateHelper;

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

    public function transactionitem()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id', 'transaction_id');
    }

    public function santri()
    {
    	return $this->belongsTo('App\Santri', 'santri_id', 'santri_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_deleted', self::active);
    }

    public static function dropdownSantri()
    {
        return Santri::where('is_deleted', Santri::active)->orderBy('santri_name')->pluck('santri_name', 'santri_id');
    }

    public static function getDataThisWeek()
    {
        $fromDate  = DateHelper::rangeWeek(Carbon::today()->toDateString())['start'];
        $toDate    = DateHelper::rangeWeek(Carbon::today()->toDateString())['end'];
        $weekrange = DateHelper::getDatesFromRange($fromDate,$toDate);

        $categories = ["Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu"];
        $series     = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];

        for($i = 0; $i <= 6; $i++){
            $transaction = Self::whereDate('transaction_date', '>=', $fromDate)->whereDate('transaction_date', '<=', $toDate)->get();

            if(!empty($transaction)){

                foreach ($transaction as $val) {
                    $transDate = date('Y-m-d', strtotime($val->transaction_date));
                    if($transDate == $weekrange[$i]){
                        $series[$i] += $val->transaction_total;
                    }
                }
            }
        }

        return ["categories" => $categories, "series" => $series];
    }
}
