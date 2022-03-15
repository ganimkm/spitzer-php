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

//============================================== Helper Functions =============================================

	function is_valid_ip($ip) 
	{ 
		return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" . 
	        "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip); 
	}


    function chop_last_char($string) {
       return  substr(trim($string), 0, -1);
    }


//=============================================== Spitzer ===============================================

    /*$sql = "select * from spitzer_feed where ip_scan_flag=0 and spitzer_log is null";
    $spitzer_query 	= mysqli_query($mysqlcon, $sql);

    while ($row = mysqli_fetch_array($spitzer_query))
	{*/

        $spitzer_ip = "172.20.9.50";
         
        try {

            $ping_ip = "ping -n 1 -w 1 " . $spitzer_ip;
            $str_result = exec($ping_ip, $input, $ping_result);
        
            if ($ping_result == 0) {

                $obj = new COM ( 'winmgmts://'. $spitzer_ip .'/root/CIMV2');
               


                $wmi_processors  =	$obj->ExecQuery("Select * from Win32_Processor");

                $count = 0;

                print_r($wmi_processors);

                foreach ( $wmi_processors as $wmi_processor ){
                    print_r($wmi_processor);

                    print_r(array_keys($wmi_processor));

                }


                // foreach ( $wmi_processors as $wmi_processor )
                // {

                //     $count+=1;

                //     $var_obj .= '{
                //         "ID": "'. $count .'",
                //         "Name": "'. $wmi_processor->Name .'",
                //         "DeviceID": "'. $wmi_processor->DeviceID .'",
                //         "CurrentClockSpeed": "'. $wmi_processor->CurrentClockSpeed .'",
                //         "MaxClockSpeed": "'. $wmi_processor->MaxClockSpeed .'",
                //         "ExtClock": "'. $wmi_processor->ExtClock .'",
                //         "Description": "'. $wmi_processor->Description .'",
                //         "Manufacturer": "'. $wmi_processor->Manufacturer .'",
                //         "CpuStatus": "'. $wmi_processor->CpuStatus .'",
                //         "SocketDesignation": "'. $wmi_processor->SocketDesignation .'",
                //         "L2CacheSize": "'. $wmi_processor->L2CacheSize .'",
                //         "L2CacheSpeed": "'. $wmi_processor->L2CacheSpeed .'",
                //         "L3CacheSize": "'. $wmi_processor->L3CacheSize .'",
                //         "L3CacheSpeed": "'. $wmi_processor->L3CacheSpeed .'",
                //         "CurrentVoltage": "'. $wmi_processor->CurrentVoltage .'",
                //         "VoltageCaps": "'. $wmi_processor->VoltageCaps .'",
                //         "UpgradeMethod": "'. $wmi_processor->UpgradeMethod .'",
                //         "NumberOfCores": "'. $wmi_processor->NumberOfCores .'",
                //         "NumberOfLogicalProcessors": "'. $wmi_processor->NumberOfLogicalProcessors .'",
                //         "HyperThreadingEnabled": "'. ($wmi_processor->NumberOfLogicalProcessors > $wmi_processor->NumberOfCores ? "True" : "False").'"
                //     },';  
                // }



            } else {

                echo "Ping Failed" ;

            } // IP Ping Failed

        } catch (Exception $e) {

		    echo str_replace("'","\'",$e->getMessage()) ;

        } //Exception
        


   // }
    

?>



