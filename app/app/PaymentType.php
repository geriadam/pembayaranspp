<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table       = "payment_type";
    protected $primaryKey  = "payment_type_id";
    public $timestamps     = false;

    const active     = 0;
    const deactive   = 1;
    protected $fillable    = ["payment_type_name","payment_type_price","payment_type_unit"];

    public static function rules()
    {
    	return [
            'payment_type_name'     => 'required',
            'payment_type_price'    => 'required',
            'payment_type_unit'     => 'required',
        ];
    }
    public static function message()
    {
        return [
        	'payment_type_name.required'   => 'Nama pembayaran harus di isi',
            'payment_type_price.required'  => 'Nominal pembayaran harus di isi',
            'payment_type_unit.required'   => 'Tipe pembayaran harus di isi',
        ];
    }


    public static function dropdownUnit()
    {
        return [
            "day" => "Harian",
            "month" => "Bulanan",
            "year" => "Tahunan",
        ];
    }
}
