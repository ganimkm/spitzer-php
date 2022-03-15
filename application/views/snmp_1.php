<?php

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

//========================================================================================================================================================

	function is_valid_ip($ip) 
	{ 
		return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" . 
	        "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip); 
	}


    function chop_last_char($string) {
       return  substr(trim($string), 0, -1);
    }


    $ip_ranges = array("172.20.9.50 172.20.9.100") ;

/*
$first_ip = ip2long($range[0]);
$last_ip = ip2long($range[1]);
 
$first_ip++;
*/

/*
foreach ($ip_ranges as $ip_range) {

    $range = explode(" ", $ip_range);

    $first_ip = ip2long($range[0]);
    $last_ip = ip2long($range[1]);

    while($first_ip < $last_ip){
    
        $ip = long2ip($first_ip);
     
        if(!preg_match('/\.0$/',$ip)){ // Don't include IPs that end in .0
            
         
*/          




//$ips = array("172.20.4.70", "10.225.213.132", "172.20.9.50", "172.20.1.244", "172.21.1.29", "172.23.1.11", "172.25.1.130", "172.25.1.26", "172.25.1.18", "172.20.0.226", "172.17.18.19","172.20.2.165","172.28.1.12","172.20.0.5"); 
//$ips = array("172.20.9.251");
$ips = array("172.20.10.215"); 

    foreach ($ips as $ip) {
   
        echo $ip;
         
        try {

            $ping_ip = "ping -n 3 -w 1 " . $ip;
            $str_result = exec($ping_ip, $input, $ping_result);
        
            if ($ping_result == 0) {

                $insertdata = '';

            //========================================================================================================================================================

                $switch_data = Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File .\ps\get_switch_data.ps1 -IPAddress $ip");
                //echo '<pre>' . $switch_data;

                $switch_name = '';
                $switch_model = '';
                $switch_manufacturer = '';
                $switch_serial_number = '';

                if(!empty($switch_data)) {

                    //print_r($switch_data);
                    $switch = json_decode($switch_data, TRUE);

                    echo '<pre>' ;    
                    //print_r($switch);                
                    //print_r($switch[0]['Switch']['Summary']['Description']);
                    //exit(0);

                    if (!empty($switch[0])){

                        if (isset($switch[0])){

                            for ($x = 0; $x < sizeof($switch[0]); $x++) {

                                $switch_name = $switch[0]['Switch']['Summary']['Name'];
                                $switch_model = $switch[0]['Switch']['Summary']['Model'];
                                $switch_manufacturer = $switch[0]['Switch']['Summary']['Manufacturer'];
                                $switch_serial_number = $switch[0]['Switch']['Summary']['SerialNumber'];
                                $switch_description = $switch[0]['Switch']['Summary']['Description'];

                                // echo $switch_name;
                                // echo $switch_model;
                                // echo $switch_manufacturer;
                                // echo $switch_name;
                                // echo $switch_serial_number;
                                 echo $switch_description;

                                //exit(0);

                                $insertdata = new MongoDB\Driver\BulkWrite(['ordered' => true]);

                                $filter      = ['name' => $switch_name,'type' => 'Switch'];
                                $options = [];
                
                                $query = new \MongoDB\Driver\Query($filter, $options);
                                $rows   = $mongocon->executeQuery('spitzer.assets', $query); 

                                if (count($rows->toArray()) == 0){

                                    $doc = ['_id' => new MongoDB\BSON\ObjectID, 'type' => 'Switch', 'scan_server' => gethostname(), 'first_seen' => new MongoDB\BSON\UTCDateTime(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $switch_model, 'manufacturer' => $switch_manufacturer, 'ip_address' => $ip, 'serial' => $switch_serial_number, 'name' => $switch_name, 'description' => $switch_description, 'data' => json_decode($switch_data)];
                                    $insertdata->insert($doc);
                
                                }else{
                
                                    $doc = ['type' => 'Switch', 'scan_server' => gethostname(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $switch_model, 'manufacturer' => $switch_manufacturer, 'ip_address' => $ip, 'serial' => $switch_serial_number, 'name' => $switch_name, 'description' => $switch_description, 'data' => json_decode($switch_data)];
                                    $insertdata->update($filter, ['$set' => $doc]);
                
                                }

                            }

                        }else{

                            $switch_name = $switch[0]['Switch']['Summary']['Name'];
                            $switch_model = $switch[0]['Switch']['Summary']['Model'];
                            $switch_manufacturer = $switch[0]['Switch']['Summary']['Manufacturer'];
                            $switch_serial_number = $switch[0]['Switch']['Summary']['SerialNumber'];
                            $switch_description = $switch[0]['Switch']['Summary']['Description'];
                            
                            $filter      = ['name' => $switch_name,'type' => 'Switch'];
                            $options = [];
            
                            $query = new \MongoDB\Driver\Query($filter, $options);
                            $rows   = $mongocon->executeQuery('spitzer.assets', $query); 

                            if (count($rows->toArray()) == 0){

                                $doc = ['_id' => new MongoDB\BSON\ObjectID, 'type' => 'Switch', 'scan_server' => gethostname(), 'first_seen' => new MongoDB\BSON\UTCDateTime(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $switch_model, 'manufacturer' => $switch_manufacturer, 'serial' => $switch_serial_number, 'name' => $switch_name, 'description' => $switch_description, 'data' => json_decode($switch_data)];
                                $insertdata->insert($doc);
            
                            }else{
            
                                $doc = ['type' => 'Switch', 'scan_server' => gethostname(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $switch_model, 'manufacturer' => $switch_manufacturer, 'serial' => $switch_serial_number, 'name' => $switch_name, 'description' => $switch_description, 'data' => json_decode($switch_data)];
                                $insertdata->update($filter, ['$set' => $doc]);
            
                            }

                        }
                    }
                }

   //=====================================================================================================================================================================================

                if (!empty($insertdata)){
                    $mongocon->executeBulkWrite('spitzer.assets', $insertdata);
                }
                
            } else {

                echo "Ping Failed" ;

            } // IP Ping Failed

        } catch (Exception $e) {

		    echo str_replace("'","\'",$e->getMessage()) ;

        } //Exception

    }
/*
}
        
$first_ip++;

}

}
 */   
?>
