<?php 

class utility
{

    function format_bytes($size){
        $base = log($size) / log(1024);
        $suffix = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1) .' '. $suffix[$f_base];
    }

    function format_kilo_bytes($size){
        $base = log($size) / log(1024);
        $suffix = array("KB", "MB", "GB", "TB");
        $f_base = floor($base);
        return round(pow(1024, $base - floor($base)), 1) .' '. $suffix[$f_base];
    }

    function format_Mbit($size){        
        $base = log($size) / log(1000);
        $suffix = array("Mbit", "Gbit");
        $f_base = floor($base);
        return round(pow(1000, $base - floor($base)), 1) .' '. $suffix[$f_base];
    }

    function format_bits_Mbits($size){        
        if ($size < 0) {
            return $size ;
        }

        return round($size / 1000000) . ' Mbit';
    }

    function chop_last_char($string) {
        return  substr(trim($string), 0, -1);
     }

    function is_valid_ip($ip) 
	{ 
		return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" . 
	        "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip); 
    }
    
}