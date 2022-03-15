select row_number() over sno as s_no,device_ip,device_name,prod.*
from scan_device,JSON_TABLE(software_detail, '$.Product[*]' COLUMNS 
(id int PATH '$.ID',
name varchar(1000) PATH '$.Name',
vendor varchar(250) PATH '$.Vendor',
installdate varchar(250) PATH '$.InstallDate')) prod
where device_ip='172.20.9.50' window sno AS (order by name)


select row_number() over sno as s_no,device_ip,device_name,hdd.*,format_byte(hdd.size)
from scan_device,JSON_TABLE(hardware_detail, '$.DiskDrive[*]' COLUMNS
(id int PATH '$.ID',
model varchar(1000) PATH '$.Model',
interface_type varchar(250) PATH '$.InterfaceType',
manufacturer varchar(250) PATH '$.Manufacturer',
media_type varchar(250) PATH '$.MediaType',
partitions varchar(250) PATH '$.Partitions',
size varchar(250) PATH '$.Size',
serial_number varchar(250) PATH '$.SerialNumber')) hdd 
where device_ip='172.20.9.50' window sno AS (order by device_ip)


select row_number() over sno as s_no,device_ip,device_name,ldd.*,format_byte(ldd.size)
from scan_device,JSON_TABLE(hardware_detail, '$.LogicalDisk[*]' COLUMNS 
(id int PATH '$.ID',
description varchar(1000) PATH '$.Description',
drive_type varchar(250) PATH '$.DriveType',
file_system varchar(250) PATH '$.FileSystem',
volume_name varchar(250) PATH '$.VolumeName',
volume_serial_number varchar(250) PATH '$.VolumeSerialNumber',
size varchar(250) PATH '$.Size',
free_space varchar(250) PATH '$.FreeSpace')) ldd 
where device_ip='172.20.9.50' window sno AS (order by device_ip)

select row_number() over sno as s_no,device_ip,device_name,nad.*,format_data_tran_rate(nad.speed) as interface_speed
from scan_device,JSON_TABLE(hardware_detail, '$.NetworkAdapter[*]' COLUMNS 
(id int PATH '$.ID',
system_name varchar(1000) PATH '$.SystemName',
name varchar(250) PATH '$.Name',
manufacturer varchar(250) PATH '$.Manufacturer',
mac_address varchar(250) PATH '$.MACAddress',
adapter_type varchar(250) PATH '$.AdapterType',
net_connection_id varchar(250) PATH '$.NetConnectionID',
net_connection_status varchar(250) PATH '$.NetConnectionStatus',
speed varchar(250) PATH '$.Speed',
physical_adapter varchar(250) PATH '$.PhysicalAdapter')) nad 
where device_ip='172.20.9.50' window sno AS (order by device_ip)

select row_number() over sno as s_no,device_ip,device_name,nac.*
from scan_device,JSON_TABLE(hardware_detail, '$.NetworkAdapterConfiguration[*]' COLUMNS 
(id int PATH '$.ID',
ip_address varchar(16) PATH '$.IPAddress',
ip_subnet varchar(250) PATH '$.IPSubnet',
defaultipgateway varchar(250) PATH '$.DefaultIPGateway',
dns_server_search_order varchar(250) PATH '$.DNSServerSearchOrder',
dhcp_enabled varchar(250) PATH '$.DHCPEnabled',
dhcp_server varchar(250) PATH '$.DHCPServer',
dns_domain varchar(250) PATH '$.DNSDomain',
dns_hostName varchar(250) PATH '$.DNSHostName',
wins_primary_server varchar(250) PATH '$.WINSPrimaryServer',
ip_filter_security_enabled varchar(250) PATH '$.IPFilterSecurityEnabled')) nac 
where device_ip='172.20.9.50' window sno AS (order by device_ip)


select row_number() over sno as s_no, v.name as product_name,count(1) as installations from (
select device_ip,device_name,products.id,products.name
from scan_device,JSON_TABLE(software_detail, '$.Product[*]' COLUMNS 
(id int PATH '$.ID',name varchar(1000) PATH '$.Name')) products
) v group by name window sno AS (order by name)

select row_number() over sno as s_no,device_ip,device_name,os.id,os.caption,count(1) as installations
from scan_device,JSON_TABLE(software_detail, '$.OperatingSystem[*]' COLUMNS
(id int PATH '$.ID',
caption varchar(1000) PATH '$.Caption')) os 
group by caption window sno AS (order by caption)
