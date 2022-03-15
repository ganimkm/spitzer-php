<?php

//========================================================================================================================================================

	function is_valid_ip($ip) 
	{ 
		return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" . 
	        "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip); 
	}


    function chop_last_char($string) {
       return  substr(trim($string), 0, -1);
    }


$ip_ranges = array("172.20.0.1 172.20.15.255") ;

/*
foreach ($ip_ranges as $ip_range) {

    $range = explode(" ", $ip_range);

    $first_ip = ip2long($range[0]);
    $last_ip = ip2long($range[1]);

    while($first_ip <= $last_ip){
    
        $ip = long2ip($first_ip);
     
        if(!preg_match('/\.0$/',$ip)){ // Don't include IPs that end in .0
            
        }
           
        echo $ip;
        print_r(insert_snmp($ip,"snmain"));

        $first_ip++;

    }
}
*/
print_r(insert_snmp("172.20.10.215","snmain"));

//$ips = array("172.20.4.70", "10.225.213.132", "172.20.9.50", "172.20.1.244", "172.21.1.29", "172.23.1.11", "172.25.1.130", "172.25.1.26", "172.25.1.18", "172.20.0.226", "172.17.18.19","172.20.2.165","172.28.1.12","172.20.0.5"); 
//$ips = array("172.20.9.251");

function insert_snmp($ip,$comm) {

    try {

        $mongocon = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        
    } catch (MongoDB\Driver\Exception\Exception $e) {
    
        $filename = basename(__FILE__);
        
        echo "The $filename script has experienced an error.\n"; 
        echo "It failed with the following exception:\n";
        
        echo "Exception:", $e->getMessage(), "\n";
        echo "In file:", $e->getFile(), "\n";
        echo "On line:", $e->getLine(), "\n";       
    }
  
    try {

        $insertdata = '';
        $data = Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File .\ps\get_snmp_device.ps1 -IPAddress $ip -Community $comm");
    
        if(!empty($data)) {

            $insertdata = new MongoDB\Driver\BulkWrite(['ordered' => true]);

            $filter      = ['ip_address' => $ip];
            $options = [];

            $query = new \MongoDB\Driver\Query($filter, $options);
            $rows   = $mongocon->executeQuery('spitzer.snmp_assets', $query); 

            if (count($rows->toArray()) == 0){

                $doc = ['_id' => new MongoDB\BSON\ObjectID,'ip_address' => $ip,'data' => json_decode($data)];
                $insertdata->insert($doc);

            }else{

                $doc = ['ip_address' => $ip,'data' => json_decode($data)];
                $insertdata->update($filter, ['$set' => $doc]);

            }

        }

        if (!empty($insertdata)){
            $mongocon->executeBulkWrite('spitzer.snmp_assets', $insertdata);
        }

        #print_r(json_decode($data));
        return $data; 
        

    } catch (Exception $e) {

        echo str_replace("'","\'",$e->getMessage()) ;

    } //Exception

}
  
?>
