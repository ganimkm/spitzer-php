Param(
   [string]$IPAddress = '.',
   [string]$Community = 'public'
)

Try  {

   
    $ping = New-Object System.Net.NetworkInformation.Ping
    $snmp = New-Object -ComObject olePrn.OleSNMP

        if ($ping.Send($IPAddress).Status -eq 'Success') {
           
            $snmp.Open($IPAddress, $Community, 2, 3000)

            #write-host $IPAddress

            $sysDescr = $snmp.Get('.1.3.6.1.2.1.1.1.0')
            $sysObjectID = $snmp.Get('.1.3.6.1.2.1.1.2.0')
            $sysUpTime = $snmp.Get('.1.3.6.1.2.1.1.3.0')
            $sysContact = $snmp.Get('.1.3.6.1.2.1.1.4.0')
            $sysName = $snmp.Get('.1.3.6.1.2.1.1.5.0')
            $sysLocation = $snmp.Get('.1.3.6.1.2.1.1.6.0')
            $sysServices = $snmp.Get('.1.3.6.1.2.1.1.7.0')

            # write-host $sysDescr
            # write-host $sysObjectID
            # write-host $sysUpTime
            # write-host $sysContact
            # write-host $sysName
            # write-host $sysLocation
            # write-host $sysServices

            #$sysobject = $snmp.Get('.iso.org.dod.internet.private.enterprises.9.1.325') 

            $arr_sysobj = $sysObjectID.Split(".")

            $arr_sysobj | ForEach-Object {
                if($_ -match "^\d+$") { 
                    $str_sysobj_search = if($str_sysobj_search){$str_sysobj_search + '.' + $_} else {$_}
                }
            }

            #write-host $str_sysobj_search

            $obj_arr=(Select-String -Path ".\ps\sysobject_1.ids" -Pattern $str_sysobj_search)

            if(!$obj_arr){                
                $obj_arr=(Select-String -Path ".\ps\sysobject_2.ids" -Pattern $str_sysobj_search)
            } 
          
            if($obj_arr){

                $obj_arr=$obj_arr.Line.split("|")

                $Manufacturer=$obj_arr[1]
                $Classification=$obj_arr[2]
                $Type=$obj_arr[3]
                #$obj_model=(($obj_arr | Select-Object -Skip 4) -join " ")
                $Model=$obj_arr[4]

                #Write-Host $obj_oid  $obj_manufac $obj_type $obj_kind $obj_model

                $str_data = @{sysDescr="$sysDescr";sysObjectID="$sysObjectID";sysUpTime="$sysUpTime";sysContact="$sysContact";sysName="$sysName";sysLocation="$sysLocation";sysServices="$sysServices";Manufacturer="$Manufacturer";Classification="$Classification";Type="$Type";Model="$Model";} | ConvertTo-Json

            } else {

                $str_data = @{Error="No details for sysObjectID($sysObjectID)";} | ConvertTo-Json

            }

        } else {

            $str_data = @{Error="IP Address Not Pinging ($IPAddress)";} | ConvertTo-Json

        }

        return $str_data 
    }

Catch {

    Return "Oops: Something went wrong.<br />$($_.Exception.Message)<br />"

}


