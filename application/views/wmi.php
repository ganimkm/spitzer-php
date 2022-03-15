<?php


	function is_valid_ip($ip) 
	{ 
		return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" . 
	        "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip); 
	}


    function chop_last_char($string) {
       return  substr(trim($string), 0, -1);
    }


    $ip_ranges = array("172.20.0.91 172.20.0.92");
    //$ip_ranges = array("172.20.2.218 172.20.2.219") ;

    foreach ($ip_ranges as $ip_range) {

        $range = explode(" ", $ip_range);

        $first_ip = ip2long($range[0]);
        $last_ip = ip2long($range[1]);

        while($first_ip <= $last_ip){
        
            $ip = long2ip($first_ip);
            
            if(!preg_match('/\.0$/',$ip)){ // Don't include IPs that end in .0
                
            }
                
            print_r(insert_wmi($ip));

            $first_ip++;

        }
    }

    function insert_wmi($ip) {
   
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

            $ping_ip = "ping -n 3 -w 1 " . $ip;
            $str_result = exec($ping_ip, $input, $ping_result);
        
            if ($ping_result == 0) {

                $insertdata = '';

            //========================================================================================================================================================

                $data = Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File .\ps\get_win_data.ps1 -ComputerName $ip");
                $data = iconv("UTF-8", "ISO-8859-1//IGNORE", $data);

                echo '<pre>';
                print_r($data);

                $name = '';
                $user_name = '';
                $manufacturer = '';
                $model = '';
                $domain = '';
                $os_name = '';
                $serial_number = '';

                if(!empty($data)) {

                    $asset = json_decode($data, TRUE);

                    if (!empty($asset['ComputerSystem'])){

                        $name = (!empty($asset['ComputerSystem']['Name']) ? $asset['ComputerSystem']['Name'] : "");
                        $user_name =  (!empty($asset['ComputerSystem']['UserName']) ? $asset['ComputerSystem']['UserName'] : "");
                        $model =  (!empty($asset['ComputerSystem']['Model']) ? $asset['ComputerSystem']['Model'] : "");
                        $manufacturer =  (!empty($asset['ComputerSystem']['Manufacturer']) ? $asset['ComputerSystem']['Manufacturer'] : "");                        
                        $domain =  (!empty($asset['ComputerSystem']['Domain']) ? $asset['ComputerSystem']['Domain'] : "");

                    }

                    if (!empty($asset['OperatingSystem'])){

                        $os_name = (!empty($asset['OperatingSystem']['Caption']) ? $asset['OperatingSystem']['Caption'] : "");

                    }

                    if (!empty($asset['BIOS'])){

                        $serial_number = (!empty($asset['BIOS']['SerialNumber']) ? $asset['BIOS']['SerialNumber'] : "");

                    }

                }

                

                if (!empty($name)) {

                    if(!is_valid_ip($ip)) {
                        $ip = gethostbyname($name);
                    }

                    $insertdata = new MongoDB\Driver\BulkWrite(['ordered' => true]);

                    $filter      = ['name' => $name,'type' => 'Windows'];
                    $options = [];

                    $query = new \MongoDB\Driver\Query($filter, $options);
                    $rows   = $mongocon->executeQuery('spitzer.assets', $query); 
                
                    if (count($rows->toArray()) == 0){

                        $doc = ['_id' => new MongoDB\BSON\ObjectID, 'type' => 'Windows', 'domain' => $domain, 'user_name' => $user_name, 'os_name' => $os_name, 'model' => $model, 'manufacturer' => $manufacturer, 'ip_address' => $ip,  'scan_server' => gethostname(), 'first_seen' => new MongoDB\BSON\UTCDateTime(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'serial' => $serial_number, 'name' => $name, 'data' => json_decode($data)];                        
                        $insertdata->insert($doc);

                    }else{

                        $doc = ['type' => 'Windows', 'domain' => $domain, 'user_name' => $user_name, 'os_name' => $os_name, 'model' => $model, 'manufacturer' => $manufacturer, 'ip_address' => $ip, 'scan_server' => gethostname(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'serial' => $serial_number,'data' => json_decode($data)];
                        $insertdata->update($filter, ['$set' => $doc]);

                    }

                    print_r($insertdata);

                }

    //=====================================================================================================================================================================================

                $monitor_data = Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File .\ps\get_win_monitor_data.ps1 -ComputerName $ip");
                //echo '<pre>' . $monitor_data;
                
                $monitor_name = '';
                $monitor_model = '';
                $monitor_manufacturer = '';
                $monitor_serial_number = '';
                $monitor_attached_to = '';

                if(!empty($monitor_data)) {

                    $monitor = json_decode($monitor_data, TRUE);

                    if (!empty($monitor[0]['Monitor'])){

                        if (isset($monitor[0]['Monitor'][0])){

                            for ($x = 0; $x < sizeof($monitor[0]['Monitor']); $x++) {

                                $monitor_name = $monitor[0]['Monitor']['Manufacturer'] . ' ' . $monitor[0]['Monitor']['SerialNumber'] ;
                                $monitor_model = $monitor[0]['Monitor'][$x]['Model'] ;
                                $monitor_manufacturer = $monitor[0]['Monitor'][$x]['Manufacturer'] ;
                                $monitor_serial_number = $monitor[0]['Monitor'][$x]['SerialNumber'];
                                $monitor_attached_to = $monitor[0]['Monitor'][$x]['AttachedComputer'];

                                $filter      = ['name' => $monitor_name,'type' => 'Monitor'];
                                $options = [];
                
                                $query = new \MongoDB\Driver\Query($filter, $options);
                                $rows   = $mongocon->executeQuery('spitzer.assets', $query); 

                                if (count($rows->toArray()) == 0){

                                    $doc = ['_id' => new MongoDB\BSON\ObjectID, 'type' => 'Monitor', 'scan_server' => gethostname(), 'first_seen' => new MongoDB\BSON\UTCDateTime(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $monitor_model, 'manufacturer' => $monitor_manufacturer, 'serial' => $monitor_serial_number, 'name' => $monitor_name, 'data' => json_decode($monitor_data)];
                                    $insertdata->insert($doc);
                
                                }else{
                
                                    $doc = ['type' => 'Monitor', 'scan_server' => gethostname(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $monitor_model, 'manufacturer' => $monitor_manufacturer, 'serial' => $monitor_serial_number, 'name' => $monitor_name, 'data' => json_decode($monitor_data)];
                                    $insertdata->update($filter, ['$set' => $doc]);
                
                                }

                            }

                        }else{

                            $monitor_name = $monitor[0]['Monitor']['Manufacturer'] . ' ' . $monitor[0]['Monitor']['SerialNumber'] ;
                            $monitor_model = $monitor[0]['Monitor']['Model'] ;
                            $monitor_manufacturer = $monitor[0]['Monitor']['Manufacturer'] ;
                            $monitor_serial_number = $monitor[0]['Monitor']['SerialNumber'];
                            $monitor_attached_to = $monitor[0]['Monitor']['AttachedComputer'];
                            
                            $filter      = ['name' => $monitor_name,'type' => 'Monitor'];
                            $options = [];
            
                            $query = new \MongoDB\Driver\Query($filter, $options);
                            $rows   = $mongocon->executeQuery('spitzer.assets', $query); 

                            if (count($rows->toArray()) == 0){

                                $doc = ['_id' => new MongoDB\BSON\ObjectID, 'type' => 'Monitor', 'scan_server' => gethostname(), 'first_seen' => new MongoDB\BSON\UTCDateTime(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $monitor_model, 'manufacturer' => $monitor_manufacturer, 'serial' => $monitor_serial_number, 'name' => $monitor_name, 'description' => $monitor_attached_to, 'data' => json_decode($monitor_data)];
                                $insertdata->insert($doc);
            
                            }else{
            
                                $doc = ['type' => 'Monitor', 'scan_server' => gethostname(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'model' => $monitor_model, 'manufacturer' => $monitor_manufacturer, 'serial' => $monitor_serial_number, 'name' => $monitor_name, 'description' => $monitor_attached_to, 'data' => json_decode($monitor_data)];
                                $insertdata->update($filter, ['$set' => $doc]);
            
                            }

                        }
                    }
                }

   //=====================================================================================================================================================================================

                if (!empty($insertdata)){
                    $mongocon->executeBulkWrite('spitzer.assets', $insertdata);
                }

                return $ip;
                
            } else {

                echo "Ping Failed" ;

            } // IP Ping Failed

        } catch (Exception $e) {

		    echo str_replace("'","\'",$e->getMessage()) ;

        } //Exception

    }

?>
