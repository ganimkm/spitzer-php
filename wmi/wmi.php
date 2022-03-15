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

        $spitzer_ip = "172.20.0.226";
         
        try {

            $ping_ip = "ping -n 1 -w 1 " . $spitzer_ip;
            $str_result = exec($ping_ip, $input, $ping_result);
        
            if ($ping_result == 0) {

                $obj = new COM ( 'winmgmts://'. $spitzer_ip .'/root/CIMV2');
               
//============================================== Get Hardware Details ======================================

                
                $serial_number = '';
                $device_name = '';
                $var_obj = '';
                
                echo'<pre>';

                $hardware_data = '{';

//============================================== Get Processor ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-processor
                *************************************************************************************/

                $wmi_processors  =	$obj->ExecQuery("Select * from Win32_Processor");

                $count = 0;

                foreach ( $wmi_processors as $wmi_processor )
                {

                    $count+=1;

                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Name": "'. $wmi_processor->Name .'",
                        "DeviceID": "'. $wmi_processor->DeviceID .'",
                        "CurrentClockSpeed": "'. $wmi_processor->CurrentClockSpeed .'",
                        "MaxClockSpeed": "'. $wmi_processor->MaxClockSpeed .'",
                        "ExtClock": "'. $wmi_processor->ExtClock .'",
                        "Description": "'. $wmi_processor->Description .'",
                        "Manufacturer": "'. $wmi_processor->Manufacturer .'",
                        "CpuStatus": "'. $wmi_processor->CpuStatus .'",
                        "SocketDesignation": "'. $wmi_processor->SocketDesignation .'",
                        "L2CacheSize": "'. $wmi_processor->L2CacheSize .'",
                        "L2CacheSpeed": "'. $wmi_processor->L2CacheSpeed .'",
                        "L3CacheSize": "'. $wmi_processor->L3CacheSize .'",
                        "L3CacheSpeed": "'. $wmi_processor->L3CacheSpeed .'",
                        "CurrentVoltage": "'. $wmi_processor->CurrentVoltage .'",
                        "VoltageCaps": "'. $wmi_processor->VoltageCaps .'",
                        "UpgradeMethod": "'. $wmi_processor->UpgradeMethod .'",
                        "NumberOfCores": "'. $wmi_processor->NumberOfCores .'",
                        "NumberOfLogicalProcessors": "'. $wmi_processor->NumberOfLogicalProcessors .'",
                        "HyperThreadingEnabled": "'. ($wmi_processor->NumberOfLogicalProcessors > $wmi_processor->NumberOfCores ? "True" : "False").'"
                    },';  
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"Processor": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }

//============================================== Get Computer System ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-computersystem
                *************************************************************************************/
            
                $wmi_computer_systems	=	$obj->ExecQuery("Select * from Win32_ComputerSystem");

                $count = 0;

                foreach ( $wmi_computer_systems as $wmi_computer_system )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Model": "'. $wmi_computer_system->Model .'",
                        "DNSHostName": "'. $wmi_computer_system->DNSHostName .'",
                        "Domain": "'. $wmi_computer_system->Domain .'",
                        "Name": "'. $wmi_computer_system->Name .'",
                        "UserName": "'. str_replace('\\', '//', $wmi_computer_system->UserName) .'",
                        "Manufacturer": "'. $wmi_computer_system->Manufacturer .'"
                    },';

                    $device_name = $wmi_computer_system->Name;

                }

                if(!empty($var_obj)){
                    $hardware_data .= '"ComputerSystem": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }
              
//============================================== Get Base Board ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-baseboard
                *************************************************************************************/
            
                $wmi_base_boards	=	$obj->ExecQuery("Select * from Win32_BaseBoard");

                $count = 0;
               
                foreach ( $wmi_base_boards as $wmi_base_board )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Product": "'. $wmi_base_board->Product .'",
                        "Manufacturer": "'. $wmi_base_board->Manufacturer .'",
                        "SerialNumber": "'. $wmi_base_board->SerialNumber .'",
                        "Version": "'. $wmi_base_board->Version .'"				
                    },';

                }

                if(!empty($var_obj)){
                    $hardware_data .= '"BaseBoard": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }
                
//============================================== Get BIOS Information ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-bios
                *************************************************************************************/

                $wmi_bios_informations	=	$obj->ExecQuery("Select * from Win32_BIOS");

                $count = 0;
                
                foreach ( $wmi_bios_informations as $wmi_bios_information )
                {

                    $count+=1;
    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Name": "'. $wmi_bios_information->Name .'",
                        "Manufacturer": "'. $wmi_bios_information->Manufacturer .'",
                        "ReleaseDate": "'. $wmi_bios_information->ReleaseDate .'",
                        "SMBIOSBIOSVersion": "'. $wmi_bios_information->SMBIOSBIOSVersion .'",
                        "SerialNumber": "'. $wmi_bios_information->SerialNumber .'",
                        "Version": "'. $wmi_bios_information->Version .'"					
                    },';

                    $serial_number = $wmi_bios_information->SerialNumber;

                }

                if(!empty($var_obj)){
                    $hardware_data .= '"BIOS": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }

//============================================== Get System Slot ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-systemslot
                *************************************************************************************/
                
                $wmi_system_slots	=	$obj->ExecQuery("Select * from Win32_SystemSlot");

                $count = 0;
               
                foreach ( $wmi_system_slots as $wmi_system_slot )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Name": "'. $wmi_system_slot->Name .'",
                        "SlotDesignation": "'. $wmi_system_slot->SlotDesignation .'"
                    },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"SystemSlot": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }

//============================================== Get Physical Memory ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-physicalmemory
                *************************************************************************************/
                
                $wmi_physical_memories	=	$obj->ExecQuery("Select * from Win32_PhysicalMemory");

                $count = 0;
              
                foreach ( $wmi_physical_memories as $wmi_physical_memory )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Capacity": "'. $wmi_physical_memory->Capacity .'",
                        "Manufacturer": "'. $wmi_physical_memory->Manufacturer .'",
                        "FormFactor": "'. $wmi_physical_memory->FormFactor .'",
                        "MemoryType": "'. $wmi_physical_memory->MemoryType .'",
                        "Speed": "'. $wmi_physical_memory->Speed .'",
                        "BankLabel": "'. $wmi_physical_memory->BankLabel .'",
                        "DeviceLocator": "'. $wmi_physical_memory->DeviceLocator .'",
                        "InterleaveDataDepth": "'. $wmi_physical_memory->InterleaveDataDepth .'"
                    },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"PhysicalMemory": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }

//============================================== Get Disk Drive ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-diskdrive
                *************************************************************************************/

                $wmi_disk_drives	=	$obj->ExecQuery("Select * from Win32_DiskDrive");

                $count = 0;
             
                foreach ( $wmi_disk_drives as $wmi_disk_drive )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Model": "'. $wmi_disk_drive->Model .'",
                        "InterfaceType": "'. $wmi_disk_drive->InterfaceType .'",
                        "Manufacturer": "'. $wmi_disk_drive->Manufacturer .'",
                        "MediaType": "'. $wmi_disk_drive->MediaType .'",
                        "Partitions": "'. $wmi_disk_drive->Partitions .'",
                        "Size": "'. $wmi_disk_drive->Size .'",
                        "SerialNumber": "'. $wmi_disk_drive->SerialNumber .'"					
                    },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"DiskDrive": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }

//============================================== Get Logical Disk ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-logicaldisk
                *************************************************************************************/

                $wmi_logical_disks	=	$obj->ExecQuery("Select * from Win32_LogicalDisk Where DriveType=3");

                $count = 0;
               
                foreach ( $wmi_logical_disks as $wmi_logical_disk )
                {

                    if ($wmi_logical_disk->Size > 0) {
                        $FreePercent = round(($wmi_logical_disk->FreeSpace/$wmi_logical_disk->Size) * 100);
                    }
                    else {
                        $FreePercent = 0;
                    }

                    $SizeFullPercent = 100 - $FreePercent;

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Name": "'. $wmi_logical_disk->Name .'",
                        "Description": "'. $wmi_logical_disk->Description .'",
                        "DriveType": "'. $wmi_logical_disk->DriveType .'",
                        "FileSystem": "'. $wmi_logical_disk->FileSystem .'",
                        "Size": "'. $wmi_logical_disk->Size .'",
                        "FreeSpace": "'. $wmi_logical_disk->FreeSpace .'",
                        "FreePercent": "'. $FreePercent .'",
                        "FilledPercent": "'. $SizeFullPercent .'",
                        "VolumeName": "'. $wmi_logical_disk->VolumeName .'",
                        "VolumeSerialNumber": "'. $wmi_logical_disk->VolumeSerialNumber .'"					
                    },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"LogicalDisk": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }

//============================================== Get Video Controller ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-videocontroller
                *************************************************************************************/

                $wmi_video_controllers	=	$obj->ExecQuery("Select * from Win32_VideoController");

                $count = 0;
                
                foreach ( $wmi_video_controllers as $wmi_video_controller )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Caption": "'. $wmi_video_controller->Caption .'",
                        "AdapterRAM": "'. $wmi_video_controller->AdapterRAM .'"   				
                    },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"VideoController": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }      
                
//============================================== Get Sound Devices ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-sounddevice
                *************************************************************************************/

                $wmi_sound_devices	=	$obj->ExecQuery("Select * from Win32_SoundDevice");

                $count = 0;
                
                foreach ( $wmi_sound_devices as $wmi_sound_device )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Caption": "'. $wmi_sound_device->Caption .'"				
                    },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"SoundDevice": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }            

//============================================== Get Anti Virus ===================================================


                $var_obj = Shell_Exec ("powershell.exe -executionpolicy bypass -NoProfile -File .\ps\getav.ps1 -ComputerName $spitzer_ip ");

                if(!empty($var_obj)){
                    $hardware_data .= '"AntiVirus": [' . str_replace('\\', '//', chop_last_char($var_obj)) . '],';   
                    $var_obj = '';
                } 
                                          
//============================================== Get Network Adapter ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-networkadapter
                *************************************************************************************/

                $wmi_network_adapters	=	$obj->ExecQuery("Select * from Win32_NetworkAdapter Where NetConnectionStatus = 2");

                $count = 0;
               
                foreach ( $wmi_network_adapters as $wmi_network_adapter )
                {

                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Manufacturer": "'. $wmi_network_adapter->Manufacturer .'",
                        "MACAddress": "'. $wmi_network_adapter->MACAddress .'",';

                        $wmi_network_adapter_configurations	= $obj->ExecQuery("Select * from Win32_NetworkAdapterConfiguration WHERE IPENabled = 'True' and MACAddress='" . $wmi_network_adapter->MACAddress . "'");

                        foreach ( $wmi_network_adapter_configurations as $wmi_network_adapter_configuration )
                        {
                            $key_data = $wmi_network_adapter_configuration->IPAddress;
                            $key_value = '';

                            if(is_array($key_data) || is_object($key_data)){

                                foreach ($key_data as $key => $value) {
                                    $key_value .=  $value . ',' ;
                                }

                                $var_obj .= '"IPAddress": "'. chop_last_char($key_value) .'",';
                            }
                        }

                    $var_obj .= '"Name": "'. $wmi_network_adapter->Name .'",
                        "AdapterType": "'. $wmi_network_adapter->AdapterType .'",
                        "NetConnectionID": "'. $wmi_network_adapter->NetConnectionID .'",
                        "NetConnectionStatus": "'. $wmi_network_adapter->NetConnectionStatus .'",
                        "Speed": "'. $wmi_network_adapter->Speed .'",
                        "SystemName": "'. $wmi_network_adapter->SystemName .'",
                        "ErrorDescription": "'. $wmi_network_adapter->ErrorDescription .'",
                        "Availability": "'. $wmi_network_adapter->Availability .'",
                        "PhysicalAdapter": "'. $wmi_network_adapter->PhysicalAdapter .'"					
                    },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"NetworkAdapter": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }  

//============================================== Get Network Adapter Configuration ======================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-networkadapterconfiguration
                *************************************************************************************/

                $wmi_network_adapter_configurations	= $obj->ExecQuery("Select * from Win32_NetworkAdapterConfiguration WHERE IPENabled = 'True'");

                $count = 0;
            
                foreach ( $wmi_network_adapter_configurations as $wmi_network_adapter_configuration )
                {

                    $count+=1;

                    $var_obj .= '{
                        "ID": "'. $count .'",';
                    
                        $key_data = $wmi_network_adapter_configuration->IPAddress;
                    $key_value = '';

                    if(is_array($key_data) || is_object($key_data)){

                        foreach ($key_data as $key => $value) {
                            $key_value .=  $value . ',' ;
                        }

                        $var_obj .= '"IPAddress": "'. chop_last_char($key_value) .'",';
                    }

                    $key_data = $wmi_network_adapter_configuration->IPSubnet;
                    $key_value = '';

                    if(is_array($key_data) || is_object($key_data)){

                        foreach ($key_data as $key => $value) {
                            $key_value .=  $value . ',' ;
                        }

                        $var_obj .= '"IPSubnet": "'. chop_last_char($key_value) .'",';
                    }

                    
                    $key_data = $wmi_network_adapter_configuration->DefaultIPGateway;
                        $key_value = '';

                        if(is_array($key_data) || is_object($key_data)){

                        foreach ($key_data as $key => $value) {
                            $key_value .=  $value . ',' ;
                        }

                        $var_obj .= '"DefaultIPGateway": "'. chop_last_char($key_value) .'",';
                    }


                    $key_data = $wmi_network_adapter_configuration->DNSServerSearchOrder;
                    $key_value = '';

                    if(is_array($key_data) || is_object($key_data)){
                            
                        foreach ($key_data as $key => $value) {
                            $key_value .=  $value . ',' ;
                        }

                        $var_obj .= '"DNSServerSearchOrder": "'. chop_last_char($key_value) .'",';
                    }

                    $var_obj .= '"DHCPEnabled": "'. $wmi_network_adapter_configuration->DHCPEnabled .'",
                                "DHCPServer": "'. $wmi_network_adapter_configuration->DHCPServer .'",
                                "DNSDomain": "'. $wmi_network_adapter_configuration->DNSDomain .'",
                                "DNSHostName": "'. $wmi_network_adapter_configuration->DNSHostName .'",
                                "WINSPrimaryServer": "'. $wmi_network_adapter_configuration->WINSPrimaryServer .'",
                                "MACAddress": "'. $wmi_network_adapter_configuration->MACAddress .'", 
                                "IPFilterSecurityEnabled": "'. $wmi_network_adapter_configuration->IPFilterSecurityEnabled .'"
                        },';
                }

                if(!empty($var_obj)){
                    $hardware_data .= '"NetworkAdapterConfiguration": [' . chop_last_char($var_obj) . ']';
                    $var_obj = '';
                }  

                $hardware_data .= '}';

//============================================== Get Software Details ==============================================

                $software_data = '{';

//============================================== Get Operating System  ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/CIMWin32Prov/win32-operatingsystem
                *************************************************************************************/

                $wmi_operating_systems   =	$obj->ExecQuery("Select * from Win32_OperatingSystem");

                $count = 0;

                foreach ( $wmi_operating_systems as $wmi_operating_system )
                {
                    
                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Caption": "'. $wmi_operating_system->Caption .'",
                        "BuildNumber": "'. $wmi_operating_system->BuildNumber .'",
                        "CSDVersion": "'. $wmi_operating_system->CSDVersion .'",
                        "Manufacturer": "'. $wmi_operating_system->Manufacturer .'",
                        "Version": "'. $wmi_operating_system->Version .'",
                        "OSArchitecture": "'. $wmi_operating_system->OSArchitecture .'",
                        "RegisteredUser": "'. $wmi_operating_system->RegisteredUser .'",
                        "Organization": "'. $wmi_operating_system->Organization .'",
                        "CurrentTimeZone": "'. $wmi_operating_system->CurrentTimeZone .'",
                        "OSType": "'. $wmi_operating_system->OSType .'",
                        "ProductType": "'. $wmi_operating_system->ProductType .'",
                        "SerialNumber": "'. $wmi_operating_system->SerialNumber .'",
                        "SystemDrive": "'. $wmi_operating_system->SystemDrive .'"					
                    },';
                }

                if(!empty($var_obj)){
                    $software_data .= '"OperatingSystem": [' . chop_last_char($var_obj) . '],';
                    $var_obj = '';
                }
                
//============================================== Get Product ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/CIMWin32Prov/win32-operatingsystem
                *************************************************************************************/

                $wmi_products   =	$obj->ExecQuery("Select * from Win32_Product");

                $count = 0;

                foreach ( $wmi_products as $wmi_product )
                {
                    
                    $count+=1;
                    
                    $var_obj .= '{
                        "ID": "'. $count .'",
                        "Name": "'. $wmi_product->Name .'",
                        "Caption": "'. $wmi_product->Caption .'",
                        "Description": "'. $wmi_product->Description .'",
                        "PackageName": "'. $wmi_product->PackageName .'",
                        "Vendor": "'. $wmi_product->Vendor .'",
                        "Version": "'. $wmi_product->Version .'",
                        "InstallDate": "'. $wmi_product->InstallDate .'"										
                    },';
                } 

                if(!empty($var_obj)){
                    $software_data .= '"Product": [' . chop_last_char($var_obj) . ']';
                    $var_obj = '';
                }
                
				$software_data .= '}';

//=====================================================================================================================

                $software_data = iconv("UTF-8", "ISO-8859-1//IGNORE", $software_data);
                $hardware_data = iconv("UTF-8", "ISO-8859-1//IGNORE", $hardware_data);

//=====================================================================================================================

                echo $hardware_data;

                $insertdata = new MongoDB\Driver\BulkWrite;
                
                $doc = ['_id' => new MongoDB\BSON\ObjectID, 'asset_type' => 'Windows', 'device_ip' => $spitzer_ip, 'scan_server' => gethostname(), 'first_seen' => new MongoDB\BSON\UTCDateTime(), 'last_seen' => new MongoDB\BSON\UTCDateTime(), 'serial' => $serial_number, 'device_name' => $device_name, 'software_detail' => json_decode($software_data), 'hardware_detail' => json_decode($hardware_data)];
                $insertdata->insert($doc);

                $mongocon->executeBulkWrite('spitzer.assets', $insertdata);


            } else {

                echo "Ping Failed" ;

            } // IP Ping Failed

        } catch (Exception $e) {

		    echo str_replace("'","\'",$e->getMessage()) ;

        } //Exception
        


   // }
    

?>



