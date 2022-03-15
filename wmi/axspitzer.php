<?php


//============================================== Connect MY SQL ==============================================

	$con = mysqli_connect("localhost", "root", "", "assetx");

	if (!$con) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
	echo "Host information: " . mysqli_get_host_info($con) . PHP_EOL;


//============================================== Helper Functions =============================================

	function is_valid_ip($ip) 
	{ 
		return preg_match("/^([1-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])" . 
	        "(\.([0-9]|[1-9][0-9]|1[0-9][0-9]|2[0-4][0-9]|25[0-5])){3}$/", $ip); 
	}


    function chop_last_char($string) {
       return  substr($string, 0, -1);
    }

//=============================================== Spitzer ===============================================


	$sql 	= "select * from spitzer_feed where ip_scan_flag=0 and spitzer_log is null";
	//$sql 	= "select * from spitzer_feed where ip_address in ('172.20.9.50')";
	$spitzer_seed_query 	= mysqli_query($con, $sql);

	while ($row = mysqli_fetch_array($spitzer_seed_query))
	{
		
		$spitzer_ip = $row['ip_address'];
		//$spitzer_ip = '172.20.9.50';

		try {

	        $ping_ip = "ping -n 1 -w 1 " . $spitzer_ip;
	        $str_result = exec($ping_ip, $input, $ping_result);


	        if ($ping_result == 0){

				$obj = new COM ( 'winmgmts://'. $spitzer_ip .'/root/CIMV2' );
				$objm = new COM ( 'winmgmts://'. $spitzer_ip .'/root/WMI' );

				$fso = new COM ( "Scripting.FileSystemObject" ); 


//============================================== Get Hardware Details ======================================

				$hardware_data = '{';

//============================================== Get Processor ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-processor
				*************************************************************************************/

				$wmi_processors  =	$obj->ExecQuery("Select * from Win32_Processor");

				$count = 0;

				$hardware_data .= '"Processor": [';

				foreach ( $wmi_processors as $wmi_processor )
			    {
                    
                    $count+=1;

					$hardware_data .= '{
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

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get Computer System ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-computersystem
				*************************************************************************************/
			
                $wmi_computer_systems	=	$obj->ExecQuery("Select * from Win32_ComputerSystem");

                $count = 0;

                $hardware_data .= '"ComputerSystem": [';

				foreach ( $wmi_computer_systems as $wmi_computer_system )
				{

					$count+=1;
					
					$hardware_data .= '{
						"ID": "'. $count .'",
						"Model": "'. $wmi_computer_system->Model .'",
						"Manufacturer": "'. $wmi_computer_system->Manufacturer .'"	
					},';

				}

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get Base Board ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-baseboard
				*************************************************************************************/
			
                $wmi_base_boards	=	$obj->ExecQuery("Select * from Win32_BaseBoard");

				$count = 0;
				
				$hardware_data .= '"BaseBoard": [';
				
				foreach ( $wmi_base_boards as $wmi_base_board )
				{

					$count+=1;
					
					$hardware_data .= '{
						"ID": "'. $count .'",
						"Product": "'. $wmi_base_board->Product .'",
						"Manufacturer": "'. $wmi_base_board->Manufacturer .'",
						"SerialNumber": "'. $wmi_base_board->SerialNumber .'",
						"Version": "'. $wmi_base_board->Version .'"				
					},';

				}

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get BIOS Information ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-bios
				*************************************************************************************/

                $wmi_bios_informations	=	$obj->ExecQuery("Select * from Win32_BIOS");

				$count = 0;
				
				$hardware_data .= '"BIOS": [';

				foreach ( $wmi_bios_informations as $wmi_bios_information )
				{

					$count+=1;
	
					$hardware_data .= '{
						"ID": "'. $count .'",
						"Name": "'. $wmi_bios_information->Name .'",
						"Manufacturer": "'. $wmi_bios_information->Manufacturer .'",
						"ReleaseDate": "'. $wmi_bios_information->ReleaseDate .'",
						"SMBIOSBIOSVersion": "'. $wmi_bios_information->SMBIOSBIOSVersion .'",
						"SerialNumber": "'. $wmi_bios_information->SerialNumber .'",
						"Version": "'. $wmi_bios_information->Version .'"					
					},';

				}

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get System Slot ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-systemslot
				*************************************************************************************/
				
                $wmi_system_slots	=	$obj->ExecQuery("Select * from Win32_SystemSlot");

				$count = 0;
				
				$hardware_data .= '"SystemSlot": [';
               
				foreach ( $wmi_system_slots as $wmi_system_slot )
				{

					$count+=1;
					
					$hardware_data .= '{
						"ID": "'. $count .'",
						"Name": "'. $wmi_system_slot->Name .'",
						"SlotDesignation": "'. $wmi_system_slot->SlotDesignation .'"
					},';
				}

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get Physical Memory ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-physicalmemory
				*************************************************************************************/
				
                $wmi_physical_memories	=	$obj->ExecQuery("Select * from Win32_PhysicalMemory");

				$count = 0;
				
				$hardware_data .= '"PhysicalMemory": [';

				foreach ( $wmi_physical_memories as $wmi_physical_memory )
				{

					$count+=1;
					
					$hardware_data .= '{
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

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get Disk Drive ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-diskdrive
				*************************************************************************************/

				$wmi_disk_drives	=	$obj->ExecQuery("Select * from Win32_DiskDrive");

				$count = 0;
				
				$hardware_data .= '"DiskDrive": [';
              
				foreach ( $wmi_disk_drives as $wmi_disk_drive )
				{

					$count+=1;
					
					$hardware_data .= '{
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

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get Logical Disk ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-logicaldisk
				*************************************************************************************/

				$wmi_logical_disks	=	$obj->ExecQuery("Select * from Win32_LogicalDisk");

				$count = 0;
				
				$hardware_data .= '"LogicalDisk": [';

				foreach ( $wmi_logical_disks as $wmi_logical_disk )
				{

					$count+=1;
					
					$hardware_data .= '{
						"ID": "'. $count .'",
						"Description": "'. $wmi_logical_disk->Description .'",
						"DriveType": "'. $wmi_logical_disk->DriveType .'",
						"FileSystem": "'. $wmi_logical_disk->FileSystem .'",
						"Size": "'. $wmi_logical_disk->Size .'",
						"FreeSpace": "'. $wmi_logical_disk->FreeSpace .'",
						"VolumeName": "'. $wmi_logical_disk->VolumeName .'",
						"VolumeSerialNumber": "'. $wmi_logical_disk->VolumeSerialNumber .'"					
					},';
				}

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get Network Adapter ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-networkadapter
				*************************************************************************************/

				$wmi_network_adapters	=	$obj->ExecQuery("Select * from Win32_NetworkAdapter Where NetConnectionStatus = 2");

				$count = 0;
				
				$hardware_data .= '"NetworkAdapter": [';
               
				foreach ( $wmi_network_adapters as $wmi_network_adapter )
				{

					$count+=1;
					
					$hardware_data .= '{
						"ID": "'. $count .'",
						"Manufacturer": "'. $wmi_network_adapter->Manufacturer .'",
						"MACAddress": "'. $wmi_network_adapter->MACAddress .'",
						"Name": "'. $wmi_network_adapter->Name .'",
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

				$hardware_data = chop_last_char($hardware_data) . '],';

//============================================== Get Network Adapter Configuration ======================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-networkadapterconfiguration
				*************************************************************************************/

				$wmi_network_adapter_configurations	= $obj->ExecQuery("Select * from Win32_NetworkAdapterConfiguration WHERE IPENabled = 'True'");

				$count = 0;
				
				$hardware_data .= '"NetworkAdapterConfiguration": [';

				foreach ( $wmi_network_adapter_configurations as $wmi_network_adapter_configuration )
				{

					$count+=1;

					$hardware_data .= '{';
					$hardware_data .= '"ID": "'. $count .'",';
					
				 	$key_data = $wmi_network_adapter_configuration->IPAddress;
					$key_value = '';

					if(is_array($key_data) || is_object($key_data)){

					    foreach ($key_data as $key => $value) {
					    	$key_value .=  $value . ',' ;
					    }

						$hardware_data .= '"IPAddress": "'. chop_last_char($key_value) .'",';
					}

					$key_data = $wmi_network_adapter_configuration->IPSubnet;
					$key_value = '';

					if(is_array($key_data) || is_object($key_data)){

					    foreach ($key_data as $key => $value) {
					    	$key_value .=  $value . ',' ;
					    }

						$hardware_data .= '"IPSubnet": "'. chop_last_char($key_value) .'",';
					}

				  
					$key_data = $wmi_network_adapter_configuration->DefaultIPGateway;
 					$key_value = '';

 					if(is_array($key_data) || is_object($key_data)){

					    foreach ($key_data as $key => $value) {
					    	$key_value .=  $value . ',' ;
					    }

						$hardware_data .= '"DefaultIPGateway": "'. chop_last_char($key_value) .'",';
					}


					$key_data = $wmi_network_adapter_configuration->DNSServerSearchOrder;
					$key_value = '';

					if(is_array($key_data) || is_object($key_data)){
                         
					    foreach ($key_data as $key => $value) {
					    	$key_value .=  $value . ',' ;
					    }

					    $hardware_data .= '"DNSServerSearchOrder": "'. chop_last_char($key_value) .'",';
                	}

                	$hardware_data .= '"DHCPEnabled": "'. $wmi_network_adapter_configuration->DHCPEnabled .'",
                	         "DHCPServer": "'. $wmi_network_adapter_configuration->DHCPServer .'",
                			 "DNSDomain": "'. $wmi_network_adapter_configuration->DNSDomain .'",
                			 "DNSHostName": "'. $wmi_network_adapter_configuration->DNSHostName .'",
                			 "WINSPrimaryServer": "'. $wmi_network_adapter_configuration->WINSPrimaryServer .'",
                			 "IPFilterSecurityEnabled": "'. $wmi_network_adapter_configuration->IPFilterSecurityEnabled .'"
						},';
				}

				$hardware_data = chop_last_char($hardware_data) . ']';
				$hardware_data .= '}';

//============================================== Get Software Details ==============================================

				$software_data = '{';

//============================================== Get Operating System  ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/CIMWin32Prov/win32-operatingsystem
				*************************************************************************************/

				$wmi_operating_systems   =	$obj->ExecQuery("Select * from Win32_OperatingSystem");

				$count = 0;

				$software_data .= '"OperatingSystem": [';

				foreach ( $wmi_operating_systems as $wmi_operating_system )
			    {
                    
                    $count+=1;
					
					$software_data .= '{
						"ID": "'. $count .'",
						"Caption": "'. $wmi_operating_system->Caption .'",
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
						"SystemDrive": "'. $wmi_operating_system->SystemDrive .'",
						"WindowsDirectory": "'. $wmi_operating_system->WindowsDirectory .'",
						"SystemDirectory": "'. $wmi_operating_system->SystemDirectory .'"					
					},';
				}
				
				$software_data = chop_last_char($software_data) . '],';

//============================================== Get Product ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/CIMWin32Prov/win32-operatingsystem
				*************************************************************************************/

				$wmi_products   =	$obj->ExecQuery("Select * from Win32_Product");

				$count = 0;

				$software_data .= '"Product": [';

				foreach ( $wmi_products as $wmi_product )
			    {
                    
                    $count+=1;
					
					$software_data .= '{
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
				
				$software_data = chop_last_char($software_data) . ']';
				$software_data .= '}';

//=====================================================================================================================

				$software_data = iconv("UTF-8", "ISO-8859-1//IGNORE", $software_data);
				$hardware_data = iconv("UTF-8", "ISO-8859-1//IGNORE", $hardware_data);

//=====================================================================================================================

				$sql = "insert into scan_device (scan_id,scanned_on,device_ip,device_name,software_detail,hardware_detail) values (". $row['spitzer_id'] . ",now(),'" . $row['ip_address'] . "','" . gethostbyaddr($row['ip_address']) . "','" . mysqli_real_escape_string($con,$software_data) . "','" . mysqli_real_escape_string($con,$hardware_data) . "');~~~~";

				$sql = $sql . "update spitzer_feed set ip_scan_flag=0 where spitzer_id=". $row['spitzer_id'] . ";" ; 
            
            } else {

				//echo $row['ip_address'] . ' IP Address Not Pinging ' , "\n<br>";

			    $sql = "update spitzer_feed set ip_scan_flag=0,spitzer_log='" . "Ping Failed" . "' where spitzer_id=".$row['spitzer_id'] . ";" ;

            } // IP Ping Failed

		} catch (Exception $e) {

		    //echo $row['ip_address'] . ' Caught exception: ',  $e->getMessage(), "\n<br>";

		    $sql = "update spitzer_feed set ip_scan_flag=0,spitzer_log='" . str_replace("'","\'",$e->getMessage()) . "' where spitzer_id=".$row['spitzer_id'] . ";" ;

		} //Exception

	    $sql_arr = explode ("~~~~", chop_last_char($sql));  
		//print_r($sql_arr); 

	    foreach ($sql_arr as $key => $qry) {		    	
    		// Set autocommit to off
			mysqli_autocommit($con,FALSE);

            if (!mysqli_query($con, $qry)) {
              
               echo "Error: " . $qry . "" . mysqli_error($con);

               // Rollback transaction
			   mysqli_rollback($con);

	        }else{
				// Commit transaction
				mysqli_commit($con);
	        }
		}
	}

//======================================== Close MY SQL DB Connection================================

mysqli_close ($con);