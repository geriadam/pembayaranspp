<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Regencies;
use App\Districts;
use App\Villages;

class DropdownAddressController extends Controller
{
    public function postDropdown(Request $request)
    {
  		$set = $request->id;

  		$kabupaten = Regencies::where('province_id', $set)->orderBy('name')->get();
  		$kecamatan = Districts::where('regency_id', $set)->orderBy('name')->get();
  		$kelurahan = Villages::where('district_id', $set)->orderBy('name')->get();

  		switch($request->type):
  			case 'kabupaten':
  				$return = '<option value="">Pilih Kabupaten...</option>';
  				foreach($kabupaten as $temp)
  					$return .= "<option value='$temp->id'>$temp->name</option>";
  				return $return;
  			break;
  			case 'kecamatan':
  				$return = '<option value="">Pilih Kecamatan...</option>';
  				foreach($kecamatan as $temp) 
  					$return .= "<option value='$temp->id'>$temp->name</option>";
  				return $return;
  			break;
  			case 'kelurahan':
  				$return = '<option value="">Pilih Kelurahan...</option>';
  				foreach($kelurahan as $temp) 
  					$return .= "<option value='$temp->id'>$temp->name</option>";
  				return $return;
  			break;
  		endswitch;    
    }
}
