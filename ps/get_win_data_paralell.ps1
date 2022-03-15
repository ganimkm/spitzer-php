workflow getwmi {

    param($hostname)

    $objects = [ordered]@{
        0 = [PSCustomObject]@{Class="Win32_Processor";Filter="";JSON="Processor";}
        1 = [PSCustomObject]@{Class="win32_PhysicalMemoryArray";Filter="";JSON="PhysicalMemoryArray";}
        2 = [PSCustomObject]@{Class="Win32_PhysicalMemory";Filter="";JSON="PhysicalMemory";}
        3 = [PSCustomObject]@{Class="Win32_ComputerSystem";Filter="";JSON="ComputerSystem";}
        4 = [PSCustomObject]@{Class="Win32_BaseBoard";Filter="";JSON="BaseBoard";}
        5 = [PSCustomObject]@{Class="Win32_BIOS";Filter="";JSON="BIOS";}
        6 = [PSCustomObject]@{Class="Win32_SystemSlot";Filter="";JSON="SystemSlot";}
        7 = [PSCustomObject]@{Class="Win32_DiskDrive";Filter="";JSON="DiskDrive";}
        8 = [PSCustomObject]@{Class="Win32_LogicalDisk";Filter="DriveType=3";JSON="LocalDisk";}
        9 = [PSCustomObject]@{Class="Win32_VideoController";Filter="AdapterDACType<>null";JSON="VideoController";}
        10 = [PSCustomObject]@{Class="Win32_SoundDevice";Filter="";JSON="SoundDevice";}
        11 = [PSCustomObject]@{Class="Win32_OperatingSystem";Filter="";JSON="OperatingSystem";}
        12 = [PSCustomObject]@{Class="Win32_Printer";Filter="";JSON="Printer";}
        13 = [PSCustomObject]@{Class="Win32_SystemEnclosure";Filter="";JSON="SystemEnclosure";}
        14 = [PSCustomObject]@{Class="Win32_DesktopMonitor";Filter="";JSON="DesktopMonitor";}
        15 = [PSCustomObject]@{Class="Win32_PortConnector";Filter="";JSON="PortConnector";}
        16 = [PSCustomObject]@{Class="Win32_CDROMDrive";Filter="";JSON="CDROMDrive";}
        17 = [PSCustomObject]@{Class="Win32_MappedLogicalDisk";Filter="";JSON="MappedLogicalDisk";} 
        18 = [PSCustomObject]@{Class="Win32_Volume";Filter="";JSON="Volume";}  
        19 = [PSCustomObject]@{Class="Win32_DiskPartition";Filter="";JSON="DiskPartition";}   
        20 = [PSCustomObject]@{Class="Win32_PointingDevice";Filter="";JSON="PointingDevice";}  
        21 = [PSCustomObject]@{Class="Win32_LogicalDisk";Filter="DriveType=4";JSON="NetworkDrive";} 
        22 = [PSCustomObject]@{Class="Win32_SCSIController";Filter="";JSON="SCSIController";} 
        23 = [PSCustomObject]@{Class="Win32_USBController";Filter="";JSON="USBController";} 
        24 = [PSCustomObject]@{Class="Win32_Keyboard";Filter="";JSON="Keyboard";}  
        #25 = [PSCustomObject]@{Class="Win32_Product";Filter="";JSON="Product";}               
    } 
    
    #$objects.Keys | ForEach { "key = $_ , value = " + $objects.Item($_).Class + $objects.Item($_).Filter }

    #Foreach -parallel ($keys in $objects.Keys) {

    Foreach ($keys in $objects.Keys) {

        #$keys
        #$objects.item($keys).filter
        #$objects.item($keys).class
        get-wmiobject -PSComputerName $hostname -class $objects.item($keys).class -filter $objects.item($keys).filter  |Select-Object -Property * -ExcludeProperty path,qualifiers,site,container,systemproperties,properties,scope,options,classpath,__* | ConvertTo-Json -Compress
       # Get-WmiObject -class $objects.Item($keys).Class -computerName "172.20.1.244" | Select-Object -Property *
        #Start-Sleep 1

    }
    
}

workflow paralleltest {

    param([string[]]$computers)

    Foreach -Parallel ($computer in $computers) {

        sequence  {

            getwmi -hostname $computer

            #get-wmiobject -class Win32_ComputerSystem -PSComputerName $computer
            #get-wmiobject -class Win32_OperatingSystem -PSComputerName $computer
    
        }
   
    }
   
}



#getwmi "172.20.9.50"

$StartTime = $(get-date)
paralleltest -computers("172.20.1.244")
$elapsedTime = $(get-date) - $StartTime

$totalTime = "{0:HH:mm:ss}" -f ([datetime]$elapsedTime.Ticks)

Write-Host $totalTime
