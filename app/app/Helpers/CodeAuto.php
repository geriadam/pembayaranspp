<?php
namespace App\Helpers;
use Request;
use DB;

class CodeAuto
{
    public static function getMaxId($yearMonth, $field, $table) 
	{
        $row = DB::select('SELECT MAX('.$field.') as mid FROM '.$table.' WHERE '.$field.' LIKE "%'.$yearMonth.'%"');
        if ($row[0]->mid) {
            return $row[0]->mid;
        } else {
            return 'false';
        }
    }
	
	public static function getLatestNumber($code, $field, $table)
	{
		$parts = explode('-', date("d-m-Y"));
		$yearMonth = $parts[2] . $parts[1];
		$latestNumber = "";
        if (CodeAuto::getMaxId($yearMonth, $field, $table) == 'false') {
            $latestNumber = $code. $yearMonth . '0001';
		}
		else {
			$lenght = strlen($code);
			$result = CodeAuto::getMaxId($yearMonth, $field, $table);
			$id = (int) substr($result, $lenght) + 1;
			$latestNumber = $code . str_pad($id, 9, 0, STR_PAD_LEFT);
		}
		
		return $latestNumber;
	}

	public static function createAcronym($string) {
	    $output = null;
	    $token  = strtok($string, ' ');
	    while ($token !== false) {
	        $output .= $token[0];
	        $token = strtok(' ');
	    }
	    return $output;
	}
}
