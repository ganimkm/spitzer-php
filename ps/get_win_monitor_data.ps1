Param(
   [string]$ComputerName = '.'
)

Try  {

gwmi WmiMonitorID -Namespace root\wmi | ForEach-Object {($_.UserFriendlyName -ne 0 | foreach {[char]$_}) -join ""; ($_.ManufacturerName -ne 0 | foreach {[char]$_}) -join ""; ($_.SerialNumberID -ne 0 | foreach {[char]$_}) -join ""}

    $Domain = 'snmain'
    $adminaccount = $Domain + "\radmin"
    $PASSWORD = ConvertTo-SecureString "Sankaranethralay@" -AsPlainText -Force
    $UNPASSWORD = New-Object System.Management.Automation.PsCredential $adminaccount, $PASSWORD

    [system.Version]$OSVersion = (Get-WmiObject win32_operatingsystem @psboundparameters -Credential $UNPASSWORD).version

    IF ($OSVersion -ge [system.version]'6.0.0.0') 
    {
        #Write-host "OS Windows Vista/Server 2008 or newer detected."
       
        $Monitors = Get-WmiObject WmiMonitorID -Namespace root\wmi @psboundparameters -Credential $UNPASSWORD | Select-Object -Property * -ExcludeProperty path,qualifiers,site,container,systemproperties,properties,scope,options,classpath,__* 
        $MonitorInfo = @()

        $ManufacturerList = @{
            "AAC" = "AcerView";
            "ACR" = "Acer";
            "AOC" = "AOC";
            "AIC" = "AG Neovo";
            "APP" = "Apple Computer";
            "AST" = "AST Research";
            "AUO" = "Asus";
            "ACI" = "Asus";
            "BNQ" = "BenQ";
            "CMO" = "Acer";
            "CPL" = "Compal";
            "CPQ" = "Compaq";
            "CPT" = "Chunghwa Pciture Tubes, Ltd.";
            "CTX" = "CTX";
            "DEC" = "DEC";
            "DEL" = "Dell Inc.";
            "DPC" = "Delta";
            "DWE" = "Daewoo";
            "EIZ" = "EIZO";
            "ELS" = "ELSA";
            "ENC" = "EIZO";
            "EPI" = "Envision";
            "FCM" = "Funai";
            "FUJ" = "Fujitsu";
            "FUS" = "Fujitsu-Siemens";
            "GSM" = "LG Electronics";
            "GWY" = "Gateway 2000";
            "HEI" = "Hyundai";
            "HIT" = "Hyundai";
            "HSL" = "Hansol";
            "HTC" = "Hitachi/Nissei";
            "HWP" = "Hewlett-Packard";
            "HCM" = "HCL Infosystems Limited";
            "IBM" = "IBM";
            "ICL" = "Fujitsu ICL";
            "IVM" = "Iiyama";
            "KDS" = "Korea Data Systems";
            "LEN" = "Lenovo";
            "LGD" = "Asus";
            "LPL" = "Fujitsu";
            "MAX" = "Belinea";
            "MEI" = "Panasonic";
            "MEL" = "Mitsubishi Electronics";
            "MS_" = "Panasonic";
            "NAN" = "Nanao";
            "NEC" = "NEC";
            "NOK" = "Nokia Data";
            "NVD" = "Fujitsu";
            "OPT" = "Optoma";
            "PHL" = "Philips";
            "REL" = "Relisys";
            "SAN" = "Samsung";
            "SAM" = "Samsung";
            "SBI" = "Smarttech";
            "SGI" = "SGI";
            "SNY" = "Sony";
            "SRC" = "Shamrock";
            "SUN" = "Sun Microsystems";
            "SEC" = "Hewlett-Packard";
            "TAT" = "Tatung";
            "TOS" = "Toshiba";
            "TSB" = "Toshiba";
            "VSC" = "ViewSonic";
            "ZCM" = "Zenith";
            "UNK" = "Unknown";
            "_YV" = "Fujitsu";
        }

        $count = 0
        $monitor_data = ''

        ForEach ($Monitor in $Monitors)
        {

            $IN = $Monitor.InstanceName
            $IN = $IN.Substring(0,$IN.Length -2)

            $MI = @{}
            $MI.MonitorID = (($Monitor.InstanceName).Split("\"))[1]

            $MI.PnpID = (((Get-WMIObject Win32_PnPEntity @psboundparameters -Credential $UNPASSWORD -Filter "Service='monitor'" | Where-Object {$_.PNPDeviceID -like "*$($MI.MonitorID)*"}).PNPDeviceID).Split("\"))[2]

            $MI.Name = (Get-WMIObject Win32_PnPEntity @psboundparameters -Credential $UNPASSWORD -Filter "Service='monitor'" | Where-Object {$_.PNPDeviceID -eq $IN}).Name

            $DesktopMonitors = (Get-WMIObject Win32_DesktopMonitor @psboundparameters -Credential $UNPASSWORD | Where-Object {$_.PNPDeviceID -eq $IN})

                ForEach ($DM in $DesktopMonitors)
                {
                    $MI.AttachedComputer = $DM.PSComputerName
                    $MI.DeviceID = $DM.DeviceID
                    $MI.PixelsPerXLogicalInch = $DM.PixelsPerXLogicalInch
                    $MI.PixelsPerYLogicalInch = $DM.PixelsPerYLogicalInch
                    $MI.ScreenHeight = $DM.ScreenHeight
                    $MI.ScreenWidth = $DM.ScreenWidth
                    $MI.IsLocked = $DM.IsLocked
                    $MI.LastErrorCode = $DM.LastErrorCode
                    $MI.Status = $DM.Status
                    $MI.StatusInfo = $DM.StatusInfo
                    $MI.Availability = $DM.Availability
                    $MI.Bandwidth = $DM.Bandwidth
                    $MI.ConfigManagerErrorCode = $DM.ConfigManagerErrorCode
                    $MI.ConfigManagerUserConfig = $DM.ConfigManagerUserConfig
                    $MI.CreationClassName = $DM.CreationClassName
                    $MI.Description = $DM.Description
                    $MI.DisplayType = $DM.DisplayType
                    $MI.ErrorCleared = $DM.ErrorCleared
                    $MI.ErrorDescription = $DM.ErrorDescription
                    $MI.InstallDate = $DM.InstallDate
                    $MI.MonitorManufacturer = $DM.MonitorManufacturer
                    $MI.MonitorType = $DM.MonitorType
                    $MI.PNPDeviceID = $DM.PNPDeviceID
                    $MI.PowerManagementCapabilities = $DM.PowerManagementCapabilities
                    $MI.PowerManagementSupported = $DM.PowerManagementSupported
                    $MI.SystemCreationClassName = $DM.SystemCreationClassName
                    $MI.SystemName = $DM.SystemName

                }

            $MI.Manufacturer = ($Monitor.ManufacturerName -gt 0 | ForEach-Object{[char]$_}) -join ""

            If ( $ManufacturerList[$MI.Manufacturer] ) {
                $MI.Manufacturer = $ManufacturerList[$MI.Manufacturer]
            }

            $MI.Model = ($Monitor.UserFriendlyName -gt 0 | ForEach-Object{[char]$_}) -join ""
            $MI.SerialNumber = ($Monitor.SerialNumberID -gt 0 | ForEach-Object{[char]$_}) -join ""
            $MI.ManufacturingYear = $Monitor.YearOfManufacture
            $MI.ManufacturingWeek = $Monitor.WeekOfManufacture

            $MonitorInfo += $MI
        }

        ForEach ($MInfo in $MonitorInfo) {

            $count++;

            $monitor_data += '{ 
                        "MonitorID": "' +  $MInfo.MonitorID + '",
                        "AttachedComputer": "' + $MInfo.AttachedComputer + '",
                        "DeviceID": "' + $MInfo.DeviceID + '",
                        "PixelsPerXLogicalInch": "' + $MInfo.PixelsPerXLogicalInch + '",
                        "PixelsPerYLogicalInch": "' + $MInfo.PixelsPerYLogicalInch + '",
                        "ScreenHeight": "' + $MInfo.ScreenHeight + '",
                        "ScreenWidth": "' + $MInfo.ScreenWidth + '",
                        "IsLocked": "' +  $MInfo.IsLocked + '",
                        "LastErrorCode": "' +  $MInfo.LastErrorCode + '",
                        "Status": "' +  $MInfo.Status + '",
                        "StatusInfo": "' +  $MInfo.StatusInfo + '",
                        "Availability": "' +  $MInfo.Availability + '",
                        "Bandwidth": "' +  $MInfo.Bandwidth + '",
                        "ConfigManagerErrorCode": "' +  $MInfo.ConfigManagerErrorCode + '",
                        "ConfigManagerUserConfig": "' +  $MInfo.ConfigManagerUserConfig + '",
                        "Description": "' +  $MInfo.Description + '",
                        "DisplayType": "' +  $MInfo.DisplayType + '",
                        "ErrorCleared": "' +  $MInfo.ErrorCleared + '",
                        "ErrorDescription": "' +  $MInfo.ErrorDescription + '",
                        "InstallDate": "' +  $MInfo.InstallDate + '",
                        "MonitorManufacturer": "' +  $MInfo.MonitorManufacturer + '",
                        "MonitorType": "' +  $MInfo.MonitorType + '",
                        "PNPDeviceID": "' +  $MInfo.PNPDeviceID + '",
                        "PowerManagementCapabilities": "' +  $MInfo.PowerManagementCapabilities + '",
                        "PowerManagementSupported": "' +  $MInfo.PowerManagementSupported + '",
                        "SystemCreationClassName": "' +  $MInfo.SystemCreationClassName + '",
                        "SystemName": "' +  $MInfo.SystemName + '",
                        "Manufacturer": "' +  $MInfo.Manufacturer + '",
                        "Model": "' +  $MInfo.Model + '",
                        "SerialNumber": "' +  $MInfo.SerialNumber + '",                
                        "ManufacturingYear": "' +  $MInfo.ManufacturingYear + '",
                        "ManufacturingWeek": "' +  $MInfo.ManufacturingWeek + '"
                        },'

        }

        if ($monitor_data -ne ''){

                $monitor_data = $monitor_data.trimend(",") 

                if ($count -gt 1) {
                    $monitor_data = '[' + $monitor_data + ']'
                }

                $monitor_data = '"Monitor":' + $monitor_data.Replace('\', '\\')

                $monitor_data = '[{' + $monitor_data + '}]'

            }

            return $monitor_data            
    } 
    Else 
    {
        #Write-host "Windows 2000, 2003, XP detected" 
           
    } # end IF ($OSVersion -ge 6.0)

}

Catch  {
  Return "Oops: Something went wrong.<br />$($_.Exception.Message)<br />"
}


