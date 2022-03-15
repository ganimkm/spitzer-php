Param(
   [string]$IPAddress = '.'
)

Try  {

   
    $ping = New-Object System.Net.NetworkInformation.Ping
    $snmp = New-Object -ComObject olePrn.OleSNMP

        if ($ping.Send($IPAddress).Status -eq 'Success') {
           
            $snmp.Open($IPAddress, 'snmain', 2, 3000)

            #$Uptime =  [TimeSpan]::FromSeconds(($snmp.Get(".1.3.6.1.2.1.1.3.0"))/100) 
            # try {
            #     $Name = $snmp.Get('.1.3.6.1.2.1.1.5.0')     
            #     $Description = $snmp.Get('.1.3.6.1.2.1.1.1.0') 
            #     $Uptime = $snmp.Get(".1.3.6.1.2.1.1.3.0")           
            #     $Location = $snmp.Get('.1.3.6.1.2.1.1.6.0') 
            #     $Contact = $snmp.Get('.1.3.6.1.2.1.1.4.0')   
            #     $SerialNumber = $snmp.GetTree('.1.3.6.1.2.1.47.1.1.1.1.11.1')s
            #     $Manufacturer = $snmp.Get('.1.3.6.1.2.1.47.1.1.1.1.12.1')
            #     $Model = $snmp.Get('.1.3.6.1.2.1.47.1.1.1.1.13.1')                  
            # } catch {}
        }


        $sysobject = $snmp.Get('.1.3.6.1.2.1.1.2.0') 
        #$sysobject = $snmp.Get('.iso.org.dod.internet.private.enterprises.9.1.325') 
        
        #$sysobject = $snmp.Get('.1.3.6.1.4.1.9.6.1.95.52.1')
        #1.3.6.1.4.1.9.6.1.95.52.1
        
        Write-Host  $sysobject

        $str_data = @{Name="$Name";Description="$Description";Uptime="$Uptime";Location="$Location";Contact="$Contact";SerialNumber="$SerialNumber";Manufacturer="$Manufacturer";Model="$Model"} | ConvertTo-Json

        $ifindex = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.1') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifIndex*'}
        $ifName = $snmp.GetTree('.1.3.6.1.2.1.31.1.1.1.1') | Where-Object {$_ -notlike '.31.1.1.1.1*'}
        $iftype = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.3') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifType*'}
        $ifalias = $snmp.GetTree('.1.3.6.1.2.1.31.1.1.1.18') | Where-Object {$_ -notlike '.31.1.1.1.18*'}
        $ifspeed = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.5') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifSpeed*'}
        $ifHighSpeed = $snmp.GetTree('.1.3.6.1.2.1.31.1.1.1.15') | Where-Object {$_ -notlike '.31.1.1.1.15*'}        
        $ifDescr = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.2') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifDescr*'}
        $ifMtu = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.4') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifMtu*'}
        $ifPhysAddress = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.6') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifPhysAddress*'}
        $ifAdminStatus = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.7') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifAdminStatus*'}
        $ifOperateStatus = $snmp.GetTree('.1.3.6.1.2.1.2.2.1.8') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifOperStatus*'}

        $ifIpaddress = $snmp.GetTree('.1.3.6.1.2.1.4.20.1.1') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifOperStatus*'}
        $ifNetmask = $snmp.GetTree('.1.3.6.1.2.1.4.20.1.3') | Where-Object {$_ -notlike 'interfaces.ifTable.ifEntry.ifOperStatus*'}
    

#         ifIpaddress_oid='.1.3.6.1.2.1.4.20.1.1';
# ifNetmask_oid='.1.3.6.1.2.1.4.20.1.3';

        $port_data=''
        
        For ($i=0; $i -le $ifindex.Length-1; $i++) {
            $port_data += '{ 
                "Index": "' +  $ifindex[$i] + '",
                "Name": "' +  $ifName[$i] + '",
                "Type": "' + $iftype[$i] + '",
                "Alias": "' + $ifalias[$i] + '",
                "Speed": "' + $ifspeed[$i] + '",
                "HighSpeed": "' + $ifHighSpeed[$i] + '",
                "Description": "' + $ifDescr[$i] + '",
                "MTU": "' + $ifMtu[$i] + '",
                "PhysicalAddress": "' + $ifPhysAddress[$i] + '",
                "AdminStatus": "' + $ifAdminStatus[$i] + '",
                "OperateStatus": "' + $ifOperateStatus[$i] + '"
                },'
        }

        $port_data = '[' + $port_data.trimend(",") + ']'
        $port_data = ',"Port":' + $port_data.Replace('\', '\\')

        $str_data = $str_data.Replace('\', '\\')

        #return '[{"Switch":{"Summary":' + $str_data  + $port_data  + '}}]'

    }
Catch  {

    Return "Oops: Something went wrong.<br />$($_.Exception.Message)<br />"

}


