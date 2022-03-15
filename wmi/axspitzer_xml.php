<?php


//============================================== Connect MY SQL ==============================================

	$con = mysqli_connect("172.20.10.56", "root", "$3rver@2016", "assetx");

	if (!$con) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}

	//echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
	//echo "Host information: " . mysqli_get_host_info($con) . PHP_EOL;


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
	//$sql 	= "select * from spitzer_feed where ip_address in ('172.20.9.59')";
	$spitzer_seed_query 	= mysqli_query($con, $sql);


	$hwxml=new DomDocument('1.0');
	//$hwxml->formatOutput=true;

	$Hardware=$hwxml->createElement("Hardware");
	$hwxml->appendChild($Hardware);

	$swxml=new DomDocument('1.0');
	//$swxml->formatOutput=true;

	$Software=$swxml->createElement("Software");
	$swxml->appendChild($Software);

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

//============================================== Get Processor ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-processor
				*************************************************************************************/

				$wmi_processors  =	$obj->ExecQuery("Select * from Win32_Processor");

				$count = 0;

				$Processors=$hwxml->createElement("Processors");
				$Hardware->appendChild($Processors);

				foreach ( $wmi_processors as $wmi_processor )
			    {
                    
                    $count+=1;



$data = '{
	"ID": "'. $wmi_processor->Name .'",
	"Name": "'. $wmi_processor->Name .'",
	"DeviceID": "'. $wmi_processor->DeviceID .'",
	"CurrentClockSpeed": "'. $wmi_processor->CurrentClockSpeed .'",
	"ID": "'. $wmi_processor->Name .'",
	"ID": "'. $wmi_processor->Name .'",
	"ID": "'. $wmi_processor->Name .'",
	"ID": "'. $wmi_processor->Name .'",
}';

	                $Processor=$hwxml->createElement("Processor");
	                $Processor->setAttribute("id",$count);
					$Processors->appendChild($Processor);

					$Processor->appendChild($hwxml->createElement("Name",$wmi_processor->Name));
					$Processor->appendChild($hwxml->createElement("DeviceID",$wmi_processor->DeviceID));
					$Processor->appendChild($hwxml->createElement("CurrentClockSpeed",$wmi_processor->CurrentClockSpeed));
					$Processor->appendChild($hwxml->createElement("MaxClockSpeed",$wmi_processor->MaxClockSpeed));
					$Processor->appendChild($hwxml->createElement("ExtClock",$wmi_processor->ExtClock));
					$Processor->appendChild($hwxml->createElement("Description",$wmi_processor->Description));
					$Processor->appendChild($hwxml->createElement("Manufacturer",$wmi_processor->Manufacturer));
					$Processor->appendChild($hwxml->createElement("CpuStatus",$wmi_processor->CpuStatus));
					$Processor->appendChild($hwxml->createElement("SocketDesignation",$wmi_processor->SocketDesignation));
					$Processor->appendChild($hwxml->createElement("L2CacheSize",$wmi_processor->L2CacheSize));
					$Processor->appendChild($hwxml->createElement("L2CacheSpeed",$wmi_processor->L2CacheSpeed));
					$Processor->appendChild($hwxml->createElement("L3CacheSize",$wmi_processor->L3CacheSize));
					$Processor->appendChild($hwxml->createElement("L3CacheSpeed",$wmi_processor->L3CacheSpeed));
					$Processor->appendChild($hwxml->createElement("CurrentVoltage",$wmi_processor->CurrentVoltage));
					$Processor->appendChild($hwxml->createElement("VoltageCaps",$wmi_processor->VoltageCaps));
					$Processor->appendChild($hwxml->createElement("UpgradeMethod",$wmi_processor->UpgradeMethod));
					$Processor->appendChild($hwxml->createElement("NumberOfCores",$wmi_processor->NumberOfCores));
					$Processor->appendChild($hwxml->createElement("NumberOfLogicalProcessors",$wmi_processor->NumberOfLogicalProcessors));
					$Processor->appendChild($hwxml->createElement("HyperThreadingEnabled",($wmi_processor->NumberOfLogicalProcessors > $wmi_processor->NumberOfCores ? "True" : "False")));

			    }
               
//============================================== Get Computer System ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-computersystem
				*************************************************************************************/
			
                $wmi_computer_systems	=	$obj->ExecQuery("Select * from Win32_ComputerSystem");

                $count = 0;

                $ComputerSystems=$hwxml->createElement("ComputerSystems");
				$Hardware->appendChild($ComputerSystems);

				foreach ( $wmi_computer_systems as $wmi_computer_system )
				{

					$count+=1;

					$ComputerSystem=$hwxml->createElement("ComputerSystem");
	                $ComputerSystem->setAttribute("id",$count); 
					$ComputerSystems->appendChild($ComputerSystem);

					$ComputerSystem->appendChild($hwxml->createElement("Model",$wmi_computer_system->Model));
					$ComputerSystem->appendChild($hwxml->createElement("Manufacturer",$wmi_computer_system->Manufacturer));

				}

//============================================== Get Base Board ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-baseboard
				*************************************************************************************/
			
                $wmi_base_boards	=	$obj->ExecQuery("Select * from Win32_BaseBoard");

                $count = 0;
                
                $BaseBoards=$hwxml->createElement("BaseBoards");
				$Hardware->appendChild($BaseBoards);

				foreach ( $wmi_base_boards as $wmi_base_board )
				{

					$count+=1;

                    $BaseBoard=$hwxml->createElement("BaseBoard");
	                $BaseBoard->setAttribute("id",$count); 
					$BaseBoards->appendChild($BaseBoard);

					$BaseBoard->appendChild($hwxml->createElement("Product",$wmi_base_board->Product));
					$BaseBoard->appendChild($hwxml->createElement("Manufacturer",$wmi_base_board->Manufacturer));
					$BaseBoard->appendChild($hwxml->createElement("SerialNumber",$wmi_base_board->SerialNumber));
					$BaseBoard->appendChild($hwxml->createElement("Version",$wmi_base_board->Version));

				}

//============================================== Get BIOS Information ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-bios
				*************************************************************************************/

                $wmi_bios_informations	=	$obj->ExecQuery("Select * from Win32_BIOS");

                $count = 0;

                $BIOSES=$hwxml->createElement("BIOSES");
				$Hardware->appendChild($BIOSES);

				foreach ( $wmi_bios_informations as $wmi_bios_information )
				{

					$count+=1;

					$BIOS=$hwxml->createElement("BIOS");
	                $BIOS->setAttribute("id",$count); 
					$BIOSES->appendChild($BIOS);

					$BIOS->appendChild($hwxml->createElement("Name",$wmi_bios_information->Name));
					$BIOS->appendChild($hwxml->createElement("Manufacturer",$wmi_bios_information->Manufacturer));
					$BIOS->appendChild($hwxml->createElement("ReleaseDate",$wmi_bios_information->ReleaseDate));
					$BIOS->appendChild($hwxml->createElement("SMBIOSBIOSVersion",$wmi_bios_information->SMBIOSBIOSVersion));
					$BIOS->appendChild($hwxml->createElement("SerialNumber",$wmi_bios_information->SerialNumber));
					$BIOS->appendChild($hwxml->createElement("Version",$wmi_bios_information->Version));

				}

//============================================== Get System Slot ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-systemslot
				*************************************************************************************/
				
                $wmi_system_slots	=	$obj->ExecQuery("Select * from Win32_SystemSlot");

                $count = 0;
                
                $SystemSlots=$hwxml->createElement("SystemSlots");
				$Hardware->appendChild($SystemSlots);

				foreach ( $wmi_system_slots as $wmi_system_slot )
				{

					$count+=1;

					$SystemSlot=$hwxml->createElement("SystemSlot");
	                $SystemSlot->setAttribute("id",$count); 
					$SystemSlots->appendChild($SystemSlot);

					$SystemSlot->appendChild($hwxml->createElement("Name",$wmi_system_slot->Name));
					$SystemSlot->appendChild($hwxml->createElement("SlotDesignation",$wmi_system_slot->SlotDesignation));

				}

//============================================== Get Physical Memory ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-physicalmemory
				*************************************************************************************/
				
                $wmi_physical_memories	=	$obj->ExecQuery("Select * from Win32_PhysicalMemory");

                $count = 0;

                $PhysicalMemories=$hwxml->createElement("PhysicalMemories");
				$Hardware->appendChild($PhysicalMemories);

				foreach ( $wmi_physical_memories as $wmi_physical_memory )
				{

					$count+=1;

					$PhysicalMemory=$hwxml->createElement("PhysicalMemory");
	                $PhysicalMemory->setAttribute("id",$count); 
					$PhysicalMemories->appendChild($PhysicalMemory);

					$PhysicalMemory->appendChild($hwxml->createElement("Capacity",$wmi_physical_memory->Capacity));
					$PhysicalMemory->appendChild($hwxml->createElement("Manufacturer",$wmi_physical_memory->Manufacturer));
					$PhysicalMemory->appendChild($hwxml->createElement("FormFactor",$wmi_physical_memory->FormFactor));
					$PhysicalMemory->appendChild($hwxml->createElement("MemoryType",$wmi_physical_memory->MemoryType));
					$PhysicalMemory->appendChild($hwxml->createElement("Speed",$wmi_physical_memory->Speed));
					$PhysicalMemory->appendChild($hwxml->createElement("BankLabel",$wmi_physical_memory->BankLabel));
					$PhysicalMemory->appendChild($hwxml->createElement("DeviceLocator",$wmi_physical_memory->DeviceLocator));
					$PhysicalMemory->appendChild($hwxml->createElement("InterleaveDataDepth",$wmi_physical_memory->InterleaveDataDepth));

				}

//============================================== Get Disk Drive ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-diskdrive
				*************************************************************************************/

				$wmi_disk_drives	=	$obj->ExecQuery("Select * from Win32_DiskDrive");

                $count = 0;
                
                $DiskDrives=$hwxml->createElement("DiskDrives");
				$Hardware->appendChild($DiskDrives);

				foreach ( $wmi_disk_drives as $wmi_disk_drive )
				{

					$count+=1;

                    $DiskDrive=$hwxml->createElement("DiskDrive");
	                $DiskDrive->setAttribute("id",$count); 
					$DiskDrives->appendChild($DiskDrive);

					$DiskDrive->appendChild($hwxml->createElement("Model",$wmi_disk_drive->Model));
					$DiskDrive->appendChild($hwxml->createElement("InterfaceType",$wmi_disk_drive->InterfaceType));
					$DiskDrive->appendChild($hwxml->createElement("Manufacturer",$wmi_disk_drive->Manufacturer));
					$DiskDrive->appendChild($hwxml->createElement("MediaType",$wmi_disk_drive->MediaType));
					$DiskDrive->appendChild($hwxml->createElement("Partitions",$wmi_disk_drive->Partitions));
					$DiskDrive->appendChild($hwxml->createElement("Size",$wmi_disk_drive->Size));
					$DiskDrive->appendChild($hwxml->createElement("SerialNumber",$wmi_disk_drive->SerialNumber));

				}

//============================================== Get Logical Disk ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-logicaldisk
				*************************************************************************************/

				$wmi_logical_disks	=	$obj->ExecQuery("Select * from Win32_LogicalDisk");

                $count = 0;

                $LogicalDisks=$hwxml->createElement("LogicalDisks");
				$Hardware->appendChild($LogicalDisks);

				foreach ( $wmi_logical_disks as $wmi_logical_disk )
				{

					$count+=1;

                    $LogicalDisk=$hwxml->createElement("LogicalDisk");
	                $LogicalDisk->setAttribute("id",$count); 
					$LogicalDisks->appendChild($LogicalDisk);

					$LogicalDisk->appendChild($hwxml->createElement("Description",$wmi_logical_disk->Description));
					$LogicalDisk->appendChild($hwxml->createElement("DriveType",$wmi_logical_disk->DriveType));
					$LogicalDisk->appendChild($hwxml->createElement("FileSystem",$wmi_logical_disk->FileSystem));
					$LogicalDisk->appendChild($hwxml->createElement("Size",$wmi_logical_disk->Size));
					$LogicalDisk->appendChild($hwxml->createElement("FreeSpace",$wmi_logical_disk->FreeSpace));
					$LogicalDisk->appendChild($hwxml->createElement("VolumeName",$wmi_logical_disk->VolumeName));
					$LogicalDisk->appendChild($hwxml->createElement("VolumeSerialNumber",$wmi_logical_disk->VolumeSerialNumber));

				}

//============================================== Get Network Adapter ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-networkadapter
				*************************************************************************************/

				$wmi_network_adapters	=	$obj->ExecQuery("Select * from Win32_NetworkAdapter Where NetConnectionStatus = 2");

                $count = 0;
                
                $NetworkAdapters=$hwxml->createElement("NetworkAdapters");
				$Hardware->appendChild($NetworkAdapters); 

				foreach ( $wmi_network_adapters as $wmi_network_adapter )
				{

					$count+=1;

					$NetworkAdapter=$hwxml->createElement("NetworkAdapter");
	                $NetworkAdapter->setAttribute("id",$count); 
					$NetworkAdapters->appendChild($NetworkAdapter);

					$NetworkAdapter->appendChild($hwxml->createElement("Manufacturer",$wmi_network_adapter->Manufacturer));
					$NetworkAdapter->appendChild($hwxml->createElement("MACAddress",$wmi_network_adapter->MACAddress));
					$NetworkAdapter->appendChild($hwxml->createElement("Name",$wmi_network_adapter->Name));
					$NetworkAdapter->appendChild($hwxml->createElement("AdapterType",$wmi_network_adapter->AdapterType));
					$NetworkAdapter->appendChild($hwxml->createElement("NetConnectionID",$wmi_network_adapter->NetConnectionID));
					$NetworkAdapter->appendChild($hwxml->createElement("NetConnectionStatus",$wmi_network_adapter->NetConnectionStatus));
					$NetworkAdapter->appendChild($hwxml->createElement("Speed",$wmi_network_adapter->Speed));
					$NetworkAdapter->appendChild($hwxml->createElement("SystemName",$wmi_network_adapter->SystemName));
					$NetworkAdapter->appendChild($hwxml->createElement("ErrorDescription",$wmi_network_adapter->ErrorDescription));
					$NetworkAdapter->appendChild($hwxml->createElement("Availability",$wmi_network_adapter->Availability));
					$NetworkAdapter->appendChild($hwxml->createElement("PhysicalAdapter",$wmi_network_adapter->PhysicalAdapter));

				}

//============================================== Get Network Adapter Configuration ==============================================

				/*************************************************************************************
				https://docs.microsoft.com/en-us/windows/desktop/cimwin32prov/win32-networkadapterconfiguration
				*************************************************************************************/

				$wmi_network_adapter_configurations	= $obj->ExecQuery("Select * from Win32_NetworkAdapterConfiguration WHERE IPENabled = 'True'");

                $count = 0;

                $NetworkAdapterConfigurations=$hwxml->createElement("NetworkAdapterConfigurations");
				$Hardware->appendChild($NetworkAdapterConfigurations); 

				foreach ( $wmi_network_adapter_configurations as $wmi_network_adapter_configuration )
				{

					$count+=1;

					$NetworkAdapterConfiguration=$hwxml->createElement("NetworkAdapterConfiguration");
	                $NetworkAdapterConfiguration->setAttribute("id",$count); 
					$NetworkAdapterConfigurations->appendChild($NetworkAdapterConfiguration);

				 	$data = $wmi_network_adapter_configuration->IPAddress;
					$key_value = '';

					if(is_array($data) || is_object($data)){

					    foreach ($data as $key => $value) {
					    	$key_value = $key_value . $value . "," ;
					    }

						$NetworkAdapterConfiguration->appendChild($hwxml->createElement("DHCPEnabled",chop_last_char($key_value)));
					}


					$data = $wmi_network_adapter_configuration->IPSubnet;
					$key_value = '';

					if(is_array($data) || is_object($data)){

					    foreach ($data as $key => $value) {
					    	$key_value = $key_value . $value . "," ;
					    }

						$NetworkAdapterConfiguration->appendChild($hwxml->createElement("IPSubnet",chop_last_char($key_value)));
					}

				  
					$data = $wmi_network_adapter_configuration->DefaultIPGateway;
 					$key_value = '';

 					if(is_array($data) || is_object($data)){

					    foreach ($data as $key => $value) {
					    	$key_value = $key_value . $value . "," ;
					    }

						$NetworkAdapterConfiguration->appendChild($hwxml->createElement("DefaultIPGateway",chop_last_char($key_value)));
					}


					$data = $wmi_network_adapter_configuration->DNSServerSearchOrder;
					$key_value = '';

					if(is_array($data) || is_object($data)){

					    foreach ($data as $key => $value) {
					    	$key_value = $key_value . $value . "," ;
					    }

                    	$NetworkAdapterConfiguration->appendChild($hwxml->createElement("DNSServerSearchOrder",chop_last_char($key_value)));
                	}

                	$NetworkAdapterConfiguration->appendChild($hwxml->createElement("DHCPEnabled",$wmi_network_adapter_configuration->DHCPEnabled));
                	$NetworkAdapterConfiguration->appendChild($hwxml->createElement("DHCPServer",$wmi_network_adapter_configuration->DHCPServer));
					$NetworkAdapterConfiguration->appendChild($hwxml->createElement("DNSDomain",$wmi_network_adapter_configuration->DNSDomain));
					$NetworkAdapterConfiguration->appendChild($hwxml->createElement("DNSHostName",$wmi_network_adapter_configuration->DNSHostName));
					$NetworkAdapterConfiguration->appendChild($hwxml->createElement("WINSPrimaryServer",$wmi_network_adapter_configuration->WINSPrimaryServer));  
					$NetworkAdapterConfiguration->appendChild($hwxml->createElement("IPFilterSecurityEnabled",$wmi_network_adapter_configuration->IPFilterSecurityEnabled));              		
				}

//============================================== Get Operating System  ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/CIMWin32Prov/win32-operatingsystem
				*************************************************************************************/

				$wmi_operating_systems   =	$obj->ExecQuery("Select * from Win32_OperatingSystem");

				$count = 0;

				$OperatingSystems=$swxml->createElement("OperatingSystems");
				$Software->appendChild($OperatingSystems);
                 
				foreach ( $wmi_operating_systems as $wmi_operating_system )
			    {
                    
                    $count+=1;

	                $OperatingSystem=$swxml->createElement("OperatingSystem");
	                $OperatingSystem->setAttribute("id",$count);
					$OperatingSystems->appendChild($OperatingSystem);

					$OperatingSystem->appendChild($swxml->createElement("Caption",$wmi_operating_system->Caption));
					$OperatingSystem->appendChild($swxml->createElement("CSDVersion",$wmi_operating_system->CSDVersion));
					$OperatingSystem->appendChild($swxml->createElement("Manufacturer",$wmi_operating_system->Manufacturer));
					$OperatingSystem->appendChild($swxml->createElement("Version",$wmi_operating_system->Version));
					$OperatingSystem->appendChild($swxml->createElement("OSArchitecture",$wmi_operating_system->OSArchitecture));
					$OperatingSystem->appendChild($swxml->createElement("RegisteredUser",$wmi_operating_system->RegisteredUser));
					$OperatingSystem->appendChild($swxml->createElement("Organization",$wmi_operating_system->Organization));
					$OperatingSystem->appendChild($swxml->createElement("CurrentTimeZone",$wmi_operating_system->CurrentTimeZone));
					$OperatingSystem->appendChild($swxml->createElement("OSType",$wmi_operating_system->OSType));
					$OperatingSystem->appendChild($swxml->createElement("ProductType",$wmi_operating_system->ProductType));
					$OperatingSystem->appendChild($swxml->createElement("SerialNumber",$wmi_operating_system->SerialNumber));
					$OperatingSystem->appendChild($swxml->createElement("SystemDrive",$wmi_operating_system->SystemDrive));
					$OperatingSystem->appendChild($swxml->createElement("WindowsDirectory",$wmi_operating_system->WindowsDirectory));
					$OperatingSystem->appendChild($swxml->createElement("SystemDirectory",$wmi_operating_system->SystemDirectory));


			    }

//============================================== Get Product ==============================================

                /*************************************************************************************
                https://docs.microsoft.com/en-us/windows/desktop/CIMWin32Prov/win32-operatingsystem
				*************************************************************************************/

				$wmi_products   =	$obj->ExecQuery("Select * from Win32_Product");

				$count = 0;

				$Products=$swxml->createElement("Products");
				$Software->appendChild($Products);
                 
				foreach ( $wmi_products as $wmi_product )
			    {
                    
                    $count+=1;

	                $Product=$swxml->createElement("Product");
	                $Product->setAttribute("id",$count);
					$Products->appendChild($Product);

					$Product->appendChild($swxml->createElement("Name",$wmi_product->Name));
					$Product->appendChild($swxml->createElement("Vendor",$wmi_product->Vendor));
					$Product->appendChild($swxml->createElement("Version",$wmi_product->Version));
					$Product->appendChild($swxml->createElement("InstallDate",$wmi_product->InstallDate));
					$Product->appendChild($swxml->createElement("InstallSource",$wmi_product->InstallSource));

			    }
//=============================================================================================================================
//echo "<xmp>" . $swxml->saveXML($swxml->documentElement) . "<xmp>";

//domdoc->saveXML(domdoc->documentElement);
//$hwxml->saveXML($hwxml->documentElement)

/*
                echo '<textarea rows="10" cols="200" style="border:none;">';
				echo $strhardware;
				echo '</textarea>';*/

				$sql = "insert into scan_device (scan_id,scanned_on,device_ip,device_name,software_detail,hardware_detail) values (". $row['spitzer_id'] . ",now(),'" . $row['ip_address'] . "','" . gethostbyaddr($row['ip_address']) . "','" . $swxml->saveXML($swxml->documentElement) . "','" . $hwxml->saveXML($hwxml->documentElement) . "');~~~~";

				$sql = $sql . "update spitzer_feed set ip_scan_flag=1 where spitzer_id=". $row['spitzer_id'] . ";" ; 
            
            } else {

				//echo $row['ip_address'] . ' IP Address Not Pinging ' , "\n<br>";

			    $sql = "update spitzer_feed set ip_scan_flag=0,spitzer_log='" . "Ping Failed" . "' where spitzer_id=".$row['spitzer_id'] . ";" ;

            }

		} catch (Exception $e) {

		    //echo $row['ip_address'] . ' Caught exception: ',  $e->getMessage(), "\n<br>";

		    $sql = "update spitzer_feed set ip_scan_flag=0,spitzer_log='" . str_replace("'","\'",$e->getMessage()) . "' where spitzer_id=".$row['spitzer_id'] . ";" ;

		}


//echo '<xmp>' . $sql . '<xmp>' ;

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