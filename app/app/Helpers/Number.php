<?php 
namespace App\Helpers;
use Request;

class Number
{
	public static function format_uang($number, $prefix = 'Rp')
	{
		return $prefix.".".number_format($number, 0, ',' , '.');
	}
}	