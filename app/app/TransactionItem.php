<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentType;

class TransactionItem extends Model
{
    public $timestamps 	  = false;
    protected $table 	  = 'transaction_item';
    protected $primaryKey = 'transaction_item_id';
    protected $fillable   = ['transaction_id','payment_type_id','transaction_price'];

    public static function rules()
    {
    	return [
    		'payment_type_id'   => 'required',
            'transaction_price' => 'required',
    	];	
    }

    public static function message()
    {
    	return [
    		'santri_id' => 'Nama santri harus di isi',
    	];
    }

    public static function dropdownPaymentType()
    {
        return PaymentType::where('is_deleted', PaymentType::active)
                            ->orderBy('payment_type_name')->pluck('payment_type_name', 'payment_type_id');
    }

}
