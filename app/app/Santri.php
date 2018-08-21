<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateHelper;
use Carbon\Carbon;

class Santri extends Model
{
    protected $table       = "santri";
    protected $primaryKey  = "santri_id";
    public $timestamps     = true;

    const active     = 0;
    const deactive   = 1;
    protected $fillable    = [
                                "santri_number",
                                "santri_name",
                                "santri_nick_name",
                                "santri_birth_place",
                                "santri_birth_date",
                                "santri_gender",
                                "santri_order_child",
                                "santri_address",
                                "santri_school",
                                "santri_school_address",
                                "santri_parent_name",
                                "santri_parent_address",
                                "santri_parent_job",
                                "santri_parent_telephone",
                            ];

    public static function rules()
    {
    	return [
            'santri_number'               => 'required',
            'santri_name'               => 'required',
            'santri_nick_name'          => 'required',
            'santri_birth_place'        => 'required',
            'santri_birth_date'         => 'required',
            'santri_gender'             => 'required',
            'santri_order_child'        => 'required',
            'santri_address'            => 'required',
            'santri_school'             => 'required',
            'santri_school_address'     => 'required',
            'santri_parent_name'        => 'required',
            'santri_parent_address'     => 'required',
            'santri_parent_job'         => 'required',
            'santri_parent_telephone'   => 'required',
        ];
    }
    public static function message()
    {
        return [
            'santri_number.required'            => 'Nomor santri harus di isi',
        	'santri_name.required'               => 'Nama santri harus di isi',
            'santri_nick_name.required'          => 'Nama panggilan harus di isi',
            'santri_birth_place.required'        => 'Tempat lahir harus di isi',
            'santri_birth_date.required'         => 'Tanggal lahir harus di isi',
            'santri_gender.required'             => 'Jenis kelamin harus di isi',
            'santri_order_child.required'        => '"Anak ke - " harus di isis',
            'santri_address.required'            => 'Alamat harus di isis',
            'santri_school.required'             => 'Asal sekolah harus di isi',
            'santri_school_address.required'     => 'Alamat sekolah harus di isi',
            'santri_parent_name.required'        => 'Nama orang tua harus di isi',
            'santri_parent_address.required'     => 'Alamat orang tua harus di isi',
            'santri_parent_job.required'         => 'Pekerjaan orang tua harus di isis',
            'santri_parent_telephone.required'   => 'Telepon orang tua harus di isis',
        ];
    }


    public static function dropdownGender()
    {
        return [
            "man" => "Laki - Laki",
            "woman" => "Perempuan",
        ];
    }

    public static function getDataThisWeek()
    {
        $fromDate  = DateHelper::rangeWeek(Carbon::today()->toDateString())['start'];
        $toDate    = DateHelper::rangeWeek(Carbon::today()->toDateString())['end'];
        $weekrange = DateHelper::getDatesFromRange($fromDate,$toDate);

        $categories = ["Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu"];
        $series     = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];

        for($i = 0; $i <= 6; $i++){
            $santri    = Self::whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate)->get();

            if(!empty($santri)){
                foreach ($santri as $val) {
                    $createdAt = date('Y-m-d', strtotime($val->created_at)); 

                    if($createdAt == $weekrange[$i]){
                        $series[$i] += 1;
                    }
                }
            }
        }

        return ["categories" => $categories, "series" => $series];
    }
}
