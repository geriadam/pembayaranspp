<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;
use Route;

class PesantrenProfile extends Model
{
    protected $table 		= "pesantren_profile";
	protected $primaryKey 	= "pesantren_profile_id";
    protected $fillable 	= ["pesantren_profile_name","pesantren_profile_address","pesantren_profile_logo"];
    public $timestamps 		= false;

    const IMAGE_PATH = "upload/pesantrenprofile/";

    public static function rules()
    {
        $rules = [
            'pesantren_profile_name'       => 'required|max:255',
            'pesantren_profile_address'    => 'required',
        ];

        switch (Route::getCurrentRoute()->getActionMethod()) {
            case 'store':
                $rules["file"] = 'mimes:jpg,png,jpeg|required|max:10000';
                break;
            case 'update':
                $rules["file"] = 'max:10000';
                break;
            default:
                break;
        }

        return $rules;
    }
    public static function message()
    {
        return [
            'pesantren_profile_name.required'       => 'Profile name required',
            'pesantren_profile_address.required'    => 'Profile address value required',
            'file.mimes'                            => 'Logo must jpeg/png/jpeg',
        ];
    }

    public static function upload($request)
    {
        $file       = $request->file("file");
        $path       = self::IMAGE_PATH;
        $file_name  =  str_random(20).".".$file->getClientOriginalExtension();
        $file->move($path, $file_name);

        return $file_name;
    }
}
