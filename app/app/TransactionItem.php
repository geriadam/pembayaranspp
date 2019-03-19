<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaymentType;

class TransactionItem extends Model
{
    public $timestamps 	  = false;
    protected $table 	  = 'transaction_item';
    protected $primaryKey = 'transaction_item_id';
    protected $fillable   = ['transaction_id','payment_type_id','transaction_price','transaction_month','transaction_year'];

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

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }

    public function paymenttype()
    {
        return $this->belongsTo('App\PaymentType', 'payment_type_id', 'payment_type_id');
    }
}
