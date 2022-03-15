<?php

$ip_ranges = array("172.20.1.1 172.20.5.255",
"172.16.3.1 172.16.6.255",
"172.21.1.1 172.21.1.255",
"172.21.2.1 172.21.2.255",
"172.21.3.1 172.21.3.255",
"172.22.1.1 172.22.1.255",
"172.23.1.1 172.23.1.255",
"172.24.1.1 172.24.1.255",
"172.25.1.1 172.25.1.255",
"172.26.1.1 172.26.1.255",
"172.28.1.1 172.28.1.255",
"172.29.1.1 172.29.1.255",
"172.30.1.1 172.30.1.255") ;

/*
$first_ip = ip2long($range[0]);
$last_ip = ip2long($range[1]);
 
$first_ip++;
*/
foreach ($ip_ranges as $ip_range) {

    $range = explode(" ", $ip_range);

    $first_ip = ip2long($range[0]);
    $last_ip = ip2long($range[1]);

    while($first_ip < $last_ip){
    
        $real_ip = long2ip($first_ip);
     
        if(!preg_match('/\.0$/',$real_ip)){ // Don't include IPs that end in .0
            
            echo $real_ip . '<br>';
            
        }
        
         $first_ip++;
        
    }

}

?>