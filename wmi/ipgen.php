<?php

function valid_ip($ip) { 
    return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" . 
            "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip); 
}

function cidrToRange($cidr) {
  $range = array();
  $cidr = explode('/', $cidr);
  $range[0] = long2ip((ip2long($cidr[0])) & ((-1 << (32 - (int)$cidr[1]))));
  $range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int)$cidr[1])) - 1);
  return $range;
}

$cidr="172.20.0.0/20";
 
$range = cidrToRange($cidr);

$first_ip = ip2long($range[0]);
$last_ip = ip2long($range[1]);
 
$first_ip++;

while($first_ip < $last_ip){
    
    $real_ip = long2ip($first_ip);
 
    if(!preg_match('/\.0$/',$real_ip)){ // Don't include IPs that end in .0
        
        echo $real_ip . '<br>';
        
    }
    
     $first_ip++;
    
}
?>


