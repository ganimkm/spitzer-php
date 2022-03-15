workflow getwmi {

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
    12 = [PSCustomObject]@{Class="Win32_Product";Filter="";JSON="Product";}  
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

#$objects.Keys | ForEach { "key = $_ , value = " + $objects.Item($_).Class + $objects.Item($_).Filter }


Foreach ($keys in $objects.Keys) {

    $objects.Item($keys).Class


}

}

getwmi