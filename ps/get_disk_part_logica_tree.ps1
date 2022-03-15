$disks = Get-WmiObject Win32_DiskDrive

Foreach ($disk in $disks) {

    write-host $disk

    $partitions=gwmi -query "ASSOCIATORS OF {Win32_DiskDrive.DeviceID='$($disk.DeviceID)'} WHERE AssocClass = Win32_DiskDriveToDiskPartition"

        Foreach ($partition in $partitions) {

         write-host $partition

             $logicaldisks=gwmi -query "ASSOCIATORS OF {Win32_DiskPartition.DeviceID='$($partition.DeviceID)'} WHERE AssocClass = Win32_LogicalDiskToPartition"

                ForEach($logicaldisk in $logicaldisks){
        
                     write-host $logicaldisk
                                         
        
                }

        }


}

$result=@()
$disks=gwmi -query "SELECT * FROM Win32_DiskDrive"
ForEach($disk in $disks){
    $result+=New-Object PSObject -Property @{
        'Health'=$disk.Status;
        'Drive'=$disk.DeviceID;
        'Partition'=''
        'Size'=[math]::Truncate($disk.Size / 1GB);
        'FreeSpace'='';
        }
    $partitions=gwmi -query "ASSOCIATORS OF {Win32_DiskDrive.DeviceID='$($disk.DeviceID)'} WHERE AssocClass = Win32_DiskDriveToDiskPartition"
    ForEach($partition in $partitions){
        $logicaldisks=gwmi -query "ASSOCIATORS OF {Win32_DiskPartition.DeviceID='$($partition.DeviceID)'} WHERE AssocClass = Win32_LogicalDiskToPartition"
        ForEach($logicaldisk in $logicaldisks){
            #if($logicaldisk){
                $result+=New-Object PSObject -Property @{
                'Health'='';
                'Drive'=$disk.DeviceID;
                'Partition'=$logicaldisk.DeviceID;
                'Size'=[math]::Truncate($logicaldisk.Size / 1GB);
                'FreeSpace'=[math]::Truncate($logicaldisk.FreeSpace / 1Gb);
                }
            #}
        }
    }
}
$result | Select Drive,Partition,Health,FreeSpace,Size | FT -a

	
