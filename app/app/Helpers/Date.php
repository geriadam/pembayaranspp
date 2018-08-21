<?php 
namespace App\Helpers;
use Request;

class Date
{
	public static function rangeWeek ($datestr) {
		date_default_timezone_set (date_default_timezone_get());
		$dt = strtotime ($datestr);

		$result = [
			"start" => date ('N', $dt) == 1 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('last monday', $dt)),
			"end" 	=> date('N', $dt) == 7 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('next sunday', $dt))
		];

		return $result;
	}

	public static function getDatesFromRange($start, $end, $format = 'Y-m-d') {
		$array = [];

		$current = strtotime($start);
		$last    = strtotime($end);

		while ($current <= $last) {
			$array[] = date($format, $current);
			$current = strtotime("+1 day", $current);
		}

    	return $array;
	}
}	