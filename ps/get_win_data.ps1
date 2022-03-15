Param(
   [string]$ComputerName = '.'
)

Try  {

    $Domain = '<domain>'
    $adminaccount = $Domain + "\<user_name>"
    $PASSWORD = ConvertTo-SecureString '<password>' -AsPlainText -Force
    $UNPASSWORD = New-Object System.Management.Automation.PsCredential $adminaccount, $PASSWORD

    $wmi_class = [ordered]@{
        1 = [PSCustomObject]@{Class="Win32_Processor";Filter="";JSON="Processor";}
        2 = [PSCustomObject]@{Class="win32_PhysicalMemoryArray";Filter="";JSON="PhysicalMemoryArray";}
        3 = [PSCustomObject]@{Class="Win32_PhysicalMemory";Filter="";JSON="PhysicalMemory";}
        4 = [PSCustomObject]@{Class="Win32_ComputerSystem";Filter="";JSON="ComputerSystem";}
        5 = [PSCustomObject]@{Class="Win32_BaseBoard";Filter="";JSON="BaseBoard";}
        6 = [PSCustomObject]@{Class="Win32_BIOS";Filter="";JSON="BIOS";}
        7 = [PSCustomObject]@{Class="Win32_SystemSlot";Filter="";JSON="SystemSlot";}
        8 = [PSCustomObject]@{Class="Win32_DiskDrive";Filter="";JSON="DiskDrive";}
        9 = [PSCustomObject]@{Class="Win32_LogicalDisk";Filter="DriveType=3";JSON="LocalDisk";}
        10 = [PSCustomObject]@{Class="Win32_VideoController";Filter="AdapterDACType<>null";JSON="VideoController";}
        11 = [PSCustomObject]@{Class="Win32_SoundDevice";Filter="";JSON="SoundDevice";}
        12 = [PSCustomObject]@{Class="Win32_OperatingSystem";Filter="";JSON="OperatingSystem";}
        13 = [PSCustomObject]@{Class="Win32_Printer";Filter="";JSON="Printer";}
        14 = [PSCustomObject]@{Class="Win32_SystemEnclosure";Filter="";JSON="SystemEnclosure";}
        15 = [PSCustomObject]@{Class="Win32_DesktopMonitor";Filter="";JSON="DesktopMonitor";}
        16 = [PSCustomObject]@{Class="Win32_PortConnector";Filter="";JSON="PortConnector";}
        17 = [PSCustomObject]@{Class="Win32_CDROMDrive";Filter="";JSON="CDROMDrive";}
        18 = [PSCustomObject]@{Class="Win32_MappedLogicalDisk";Filter="";JSON="MappedLogicalDisk";} 
        19 = [PSCustomObject]@{Class="Win32_Volume";Filter="";JSON="Volume";}  
        20 = [PSCustomObject]@{Class="Win32_DiskPartition";Filter="";JSON="DiskPartition";}   
        21 = [PSCustomObject]@{Class="Win32_PointingDevice";Filter="";JSON="PointingDevice";}  
        22 = [PSCustomObject]@{Class="Win32_LogicalDisk";Filter="DriveType=4";JSON="NetworkDrive";} 
        23 = [PSCustomObject]@{Class="Win32_SCSIController";Filter="";JSON="SCSIController";} 
        24 = [PSCustomObject]@{Class="Win32_USBController";Filter="";JSON="USBController";} 
        25 = [PSCustomObject]@{Class="Win32_Keyboard";Filter="";JSON="Keyboard";}                 
    } 

    $wmi_data_class = ''
    $wmi_data = ''

    for($i = 0; $i -lt $wmi_class.count; $i++){

        $wmi_data = get-wmiobject -class $wmi_class[$i].Class -Filter $wmi_class[$i].Filter @psboundparameters -Credential $UNPASSWORD | Select-Object -Property * -ExcludeProperty path,qualifiers,site,container,systemproperties,properties,scope,options,classpath,__* | ConvertTo-Json
 
         if (($wmi_data).length -ne 0){
           $wmi_data_class += '"' + $wmi_class[$i].JSON + '":' + $wmi_data + ',' 
         }
     }

    $wmi_data_class = $wmi_data_class.trimend(",") 

    #return $wmi_data_class

    $wmiQuery = "SELECT * FROM AntiVirusProduct" 

      [system.Version]$OSVersion = (Get-WmiObject win32_operatingsystem @psboundparameters -Credential $UNPASSWORD).version

      IF ($OSVersion -ge [system.version]'6.0.0.0') 
      {
          #Write-host "OS Windows Vista/Server 2008 or newer detected."
          $AntiVirusProducts = Get-WmiObject -Namespace root\SecurityCenter2 -Query $wmiQuery  @psboundparameters -Credential $UNPASSWORD # -ErrorVariable myError -ErrorAction 'SilentlyContinue'             
      } 
      Else 
      {
          #Write-host "Windows 2000, 2003, XP detected" 
          $AntiVirusProducts = Get-WmiObject -Namespace "root\SecurityCenter" -Query $wmiQuery  @psboundparameters -Credential $UNPASSWORD # -ErrorVariable myError -ErrorAction 'SilentlyContinue'             
      } # end IF ($OSVersion -ge 6.0)


      $count = 0
      $av_data = ''

      Foreach ($AntiVirusProduct in $AntiVirusProducts)

      {

          $productState = $AntiVirusProduct.productState

          # convert to hex, add an additional '0' left if necesarry
          $hex = [Convert]::ToString($productState, 16).PadLeft(6,'0')

          # Substring(int startIndex, int length)  
          $WSC_SECURITY_PROVIDER = $hex.Substring(0,2)
          $WSC_SECURITY_PRODUCT_STATE = $hex.Substring(2,2)
          $WSC_SECURITY_SIGNATURE_STATUS = $hex.Substring(4,2)

          $SECURITY_PROVIDER = switch ($WSC_SECURITY_PROVIDER)
          {
              0  {"NONE"}
              1  {"FIREWALL"}
              2  {"AUTOUPDATE_SETTINGS"}
              4  {"ANTIVIRUS"}
              8  {"ANTISPYWARE"}
              16 {"INTERNET_SETTINGS"}
              32 {"USER_ACCOUNT_CONTROL"}
              64 {"SERVICE"}
              default {"Unknown"}
          }


          $RealTimeProtectionStatus = switch ($WSC_SECURITY_PRODUCT_STATE)
          {
              "00" {"Off"} 
              "01" {"Expired"}
              "10" {"On"}
              "11" {"Snoozed"}
              default {"Unknown"}
          }

          $DefinitionStatus = switch ($WSC_SECURITY_SIGNATURE_STATUS)
          {
              "00" {"Up to Date"}
              "10" {"Outdated"}
              default {"Unknown"}
          }
            

          $count++;

          $av_data += '{ 
                        "Name": "' +  $AntiVirusProduct.__Server + '",
                        "DisplayName": "' + $AntiVirusProduct.displayName + '",
                        "Path": "' + $AntiVirusProduct.pathToSignedProductExe + '",
                        "DefinitionStatus": "' + $DefinitionStatus + '",
                        "securityprovider": "' + $SECURITY_PROVIDER + '",
                        "RealTimeProductionStatus": "' + $RealTimeProtectionStatus + '"
                        },'
      
      }

    if ($av_data -ne ''){

        $av_data = $av_data.trimend(",") 

        if ($count -gt 1) {
            $av_data = '[' + $av_data + ']'
        }

        $av_data = ',"Antivirus":' + $av_data.Replace('\', '\\')

    }

$NetworkAdapters = Get-WmiObject @psboundparameters -Credential $UNPASSWORD -query "SELECT * FROM Win32_NetworkAdapter" 

 $count = 0
 $networkAdapter_data = ''

 ForEach($NetworkAdapter in $NetworkAdapters){

    $count++;

    $networkAdapter_data += '{
        "PSComputerName": "' + $NetworkAdapter.PSComputerName + '",
        "Availability": "' + $NetworkAdapter.Availability + '",
        "Name": "' + $NetworkAdapter.Name + '",
        "Status": "' + $NetworkAdapter.Status + '",
        "StatusInfo": "' + $NetworkAdapter.StatusInfo + '",
        "DeviceID": "' + $NetworkAdapter.DeviceID + '",
        "AdapterType": "' + $NetworkAdapter.AdapterType + '",
        "AdapterTypeId": "' + $NetworkAdapter.AdapterTypeId + '",
        "AutoSense": "' + $NetworkAdapter.AutoSense + '",
        "Caption": "' + $NetworkAdapter.Caption + '",
        "ConfigManagerErrorCode": "' + $NetworkAdapter.ConfigManagerErrorCode + '",
        "ConfigManagerUserConfig": "' + $NetworkAdapter.ConfigManagerUserConfig + '",
        "CreationClassName": "' + $NetworkAdapter.CreationClassName + '",
        "Description": "' + $NetworkAdapter.Description + '",
        "ErrorCleared": "' + $NetworkAdapter.ErrorCleared + '",
        "ErrorDescription": "' + $NetworkAdapter.ErrorDescription + '",
        "GUID": "' + $NetworkAdapter.GUID + '",
        "Index": "' + $NetworkAdapter.Index + '",
        "InstallDate": "' + $NetworkAdapter.InstallDate + '",
        "Installed": "' + $NetworkAdapter.Installed + '",
        "InterfaceIndex": "' + $NetworkAdapter.InterfaceIndex + '",
        "LastErrorCode": "' + $NetworkAdapter.LastErrorCode + '",
        "MACAddress": "' + $NetworkAdapter.MACAddress + '",
        "Manufacturer": "' + $NetworkAdapter.Manufacturer + '",
        "MaxNumberControlled": "' + $NetworkAdapter.MaxNumberControlled + '",
        "MaxSpeed": "' + $NetworkAdapter.MaxSpeed + '",
        "NetConnectionID": "' + $NetworkAdapter.NetConnectionID + '",
        "NetConnectionStatus": "' + $NetworkAdapter.NetConnectionStatus + '",
        "NetEnabled": "' + $NetworkAdapter.NetEnabled + '",
        "NetworkAddresses": "' + $NetworkAdapter.NetworkAddresses + '",
        "PermanentAddress": "' + $NetworkAdapter.PermanentAddress + '",
        "PhysicalAdapter": "' + $NetworkAdapter.PhysicalAdapter + '",
        "PNPDeviceID": "' + $NetworkAdapter.PNPDeviceID + '",
        "PowerManagementCapabilities": "' + $NetworkAdapter.PowerManagementCapabilities + '",
        "PowerManagementSupported": "' + $NetworkAdapter.PowerManagementSupported + '",
        "ProductName": "' + $NetworkAdapter.ProductName + '",
        "ServiceName": "' + $NetworkAdapter.ServiceName + '",
        "Speed": "' + $NetworkAdapter.Speed + '",
        "SystemCreationClassName": "' + $NetworkAdapter.SystemCreationClassName + '",
        "SystemName": "' + $NetworkAdapter.SystemName + '",
        "TimeOfLastReset": "' + $NetworkAdapter.TimeOfLastReset + '",'

        $NetworkAdapterConfigurations  = Get-WmiObject @psboundparameters -Credential $UNPASSWORD -query "ASSOCIATORS OF {Win32_NetworkAdapter.DeviceID='$($NetworkAdapter.DeviceID)'} WHERE AssocClass = Win32_NetworkAdapterSetting"

        ForEach($NetworkAdapterConfiguration in $NetworkAdapterConfigurations){

        $networkAdapter_data += '
        "DNSDomainSuffixSearchOrder": "' + $NetworkAdapterConfiguration.DNSDomainSuffixSearchOrder + '",
        "DHCPEnabled": "' + $NetworkAdapterConfiguration.DHCPEnabled + '",
        "DNSHostName": "' + $NetworkAdapterConfiguration.DNSHostName + '",
        "DNSServerSearchOrder": "' + $NetworkAdapterConfiguration.DNSServerSearchOrder + '",
        "DomainDNSRegistrationEnabled": "' + $NetworkAdapterConfiguration.DomainDNSRegistrationEnabled + '",
        "IPAddress": "' + $NetworkAdapterConfiguration.IPAddress + '",
        "IPConnectionMetric": "' + $NetworkAdapterConfiguration.IPConnectionMetric + '",
        "IPEnabled": "' + $NetworkAdapterConfiguration.IPEnabled + '",
        "IPFilterSecurityEnabled": "' + $NetworkAdapterConfiguration.IPFilterSecurityEnabled + '",
        "WINSEnableLMHostsLookup": "' + $NetworkAdapterConfiguration.WINSEnableLMHostsLookup + '",
        "DefaultIPGateway": "' + $NetworkAdapterConfiguration.DefaultIPGateway + '",
        "GatewayCostMetric": "' + $NetworkAdapterConfiguration.GatewayCostMetric + '",
        "IPSubnet": "' + $NetworkAdapterConfiguration.IPSubnet + '",
        "SettingID": "' + $NetworkAdapterConfiguration.SettingID + '",
        "TcpipNetbiosOptions": "' + $NetworkAdapterConfiguration.TcpipNetbiosOptions + '"
        },'

         }

    }

    if ($networkAdapter_data -ne ''){

        $networkAdapter_data = $networkAdapter_data.trimend(",") 

        if ($count -gt 1) {
            $networkAdapter_data = '[' + $networkAdapter_data + ']'
        }

        $networkAdapter_data = ',"NetworkAdapter":' + $networkAdapter_data.Replace('\', '\\')

    }

    return "{" + $wmi_data_class  + $av_data + $networkAdapter_data + "}"

}

Catch  {
  Return "Oops: Something went wrong.<br />$($_.Exception.Message)<br />"
}

