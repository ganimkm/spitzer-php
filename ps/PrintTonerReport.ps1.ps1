$printerlist = import-csv D:\xampp\htdocs\spitzer\ps\printerlist.txt -header Value,Name,Description
$outfile = ".\PrinterReport.html"
$SNMP = new-object -ComObject olePrn.OleSNMP
$ErrorActionPreference = "Continue"
$total = ($printerlist.value|? {$_ -notlike "-*"}).length

Write "`
<html>`
<head>`
<title>Printer Report</title>`
<style>* {font-family:'Trebuchet MS';}</style>`
</head>`
<body>"|out-file $outfile

write "Reporting on $total printers"
$x = 0

foreach ($p in $printerlist){

if ($p.value -like "-*"){write "<h3>",$p.value.replace('-',''),"</h3>"|add-content $outfile}

if ($p.value -notlike "-*"){

$x = $x + 1
$printertype = $nul
$status = $nul
$percentremaining = $nul
$blackpercentremaining = $nul
$cyanpercentremaining = $nul
$magentapercentremaining = $nul
$yellowpercentremaining = $nul
$wastepercentremaining = $nul

if (!(test-connection $p.Value -Quiet -count 1)){write ($p.value + " is offline<br>")|add-content $outfile}
if (test-connection $p.value -quiet -count 1){
$snmp.open($p.value,"public",2,3000)
$printertype = $snmp.Get(".1.3.6.1.2.1.25.3.2.1.3.1")
write ([string]$x + ": " + [string]$p.Value + " " + $printertype)
}

if ($printertype -like "*WorkCentre 5655*"){

$tonervolume = $snmp.get("43.11.1.1.8.1.1")
$currentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$percentremaining = 100 - (($currentvolume / $tonervolume) * 100) 

$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($percentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 24) -and ($percentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 10) -and ($percentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -ge 0) -and ($percentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}


if ($printertype -like "*WorkCentre 5675*"){

$tonervolume = $snmp.get("43.11.1.1.8.1.1")
$currentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$percentremaining = ($currentvolume / $tonervolume) * 100 
$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($percentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 24) -and ($percentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 10) -and ($percentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -ge 0) -and ($percentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}

if ($printertype -like "*WorkCentre 3325*"){

$tonervolume = $snmp.get("43.11.1.1.8.1.1")
$currentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$percentremaining = ($currentvolume / $tonervolume) * 100 
$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($percentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 24) -and ($percentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 10) -and ($percentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -ge 0) -and ($percentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}

if ($printertype -like "*Phaser 3635*"){

$tonervolume = $snmp.get("43.11.1.1.8.1.1")
$currentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$percentremaining = ($currentvolume / $tonervolume) * 100 
$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($percentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 24) -and ($percentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 10) -and ($percentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -ge 0) -and ($percentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}

if ($printertype -like "*Phaser 3610*"){

$tonervolume = $snmp.get("43.11.1.1.8.1.1")
$currentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$percentremaining = ($currentvolume / $tonervolume) * 100 
$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($percentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 24) -and ($percentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -gt 10) -and ($percentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($percentremaining -ge 0) -and ($percentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$percentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}

if ($printertype -like "*Ricoh Aficio*"){

$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}


if ($printertype -like "*WorkCentre 7835*"){

$blacktonervolume = $snmp.get("43.11.1.1.8.1.1")
$blackcurrentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$blackpercentremaining = ($blackcurrentvolume / $blacktonervolume) * 100 
$cyantonervolume = $snmp.get("43.11.1.1.8.1.2")
$cyancurrentvolume = $snmp.get("43.11.1.1.9.1.2")
[int]$cyanpercentremaining = ($cyancurrentvolume / $cyantonervolume) * 100
$magentatonervolume = $snmp.get("43.11.1.1.8.1.3")
$magentacurrentvolume = $snmp.get("43.11.1.1.9.1.3")
[int]$magentapercentremaining = ($magentacurrentvolume / $magentatonervolume) * 100
$yellowtonervolume = $snmp.get("43.11.1.1.8.1.4")
$yellowcurrentvolume = $snmp.get("43.11.1.1.9.1.4")
[int]$yellowpercentremaining = ($yellowcurrentvolume / $yellowtonervolume) * 100
$wastetonervolume = $snmp.get("43.11.1.1.8.1.10")
$wastecurrentvolume = [math]::round([math]::abs($snmp.get("43.11.1.1.9.1.10")))
[int]$wastepercentremaining = (($wastecurrentvolume / $wastetonervolume) * 100)

$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($blackpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -gt 24) -and ($blackpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -gt 10) -and ($blackpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -ge 0) -and ($blackpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($cyanpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 24) -and ($cyanpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 10) -and ($cyanpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -ge 0) -and ($cyanpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if ($magentapercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 24) -and ($magentapercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 10) -and ($magentapercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -ge 0) -and ($magentapercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if ($yellowpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 24) -and ($yellowpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 10) -and ($yellowpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -ge 0) -and ($yellowpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if ($wastepercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -gt 24) -and ($wastepercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -gt 10) -and ($wastepercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -ge 0) -and ($wastepercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}

if ($printertype -like "*Phaser 7100*"){

$blacktonervolume = $snmp.get("43.11.1.1.8.1.1")
$blackcurrentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$blackpercentremaining = ($blackcurrentvolume / $blacktonervolume) * 100 
$cyantonervolume = $snmp.get("43.11.1.1.8.1.4")
$cyancurrentvolume = $snmp.get("43.11.1.1.9.1.4")
[int]$cyanpercentremaining = ($cyancurrentvolume / $cyantonervolume) * 100
$magentatonervolume = $snmp.get("43.11.1.1.8.1.3")
$magentacurrentvolume = $snmp.get("43.11.1.1.9.1.3")
[int]$magentapercentremaining = ($magentacurrentvolume / $magentatonervolume) * 100
$yellowtonervolume = $snmp.get("43.11.1.1.8.1.2")
$yellowcurrentvolume = $snmp.get("43.11.1.1.9.1.2")
[int]$yellowpercentremaining = ($yellowcurrentvolume / $yellowtonervolume) * 100
$wastetonervolume = $snmp.get("43.11.1.1.8.1.5")
$wastecurrentvolume = [math]::round([math]::abs($snmp.get("43.11.1.1.9.1.5")))
[int]$wastepercentremaining = 100 - (($wastecurrentvolume / $wastetonervolume) * 100)

$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($blackpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -gt 24) -and ($blackpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -gt 10) -and ($blackpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -ge 0) -and ($blackpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($cyanpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 24) -and ($cyanpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 10) -and ($cyanpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -ge 0) -and ($cyanpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if ($magentapercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 24) -and ($magentapercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 10) -and ($magentapercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -ge 0) -and ($magentapercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if ($yellowpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 24) -and ($yellowpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 10) -and ($yellowpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -ge 0) -and ($yellowpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if ($wastepercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -gt 24) -and ($wastepercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -gt 10) -and ($wastepercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -ge 0) -and ($wastepercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}

if (($printertype -like "*660*") -and ($printertype -like "*Xerox*") -and ($printertype -like "*DN*")){

$blacktonervolume = $snmp.get("43.11.1.1.8.1.4")
$blackcurrentvolume = $snmp.get("43.11.1.1.9.1.4")
[int]$blackpercentremaining = ($blackcurrentvolume / $blacktonervolume) * 100 
$cyantonervolume = $snmp.get("43.11.1.1.8.1.1")
$cyancurrentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$cyanpercentremaining = ($cyancurrentvolume / $cyantonervolume) * 100
$magentatonervolume = $snmp.get("43.11.1.1.8.1.2")
$magentacurrentvolume = $snmp.get("43.11.1.1.9.1.2")
[int]$magentapercentremaining = ($magentacurrentvolume / $magentatonervolume) * 100
$yellowtonervolume = $snmp.get("43.11.1.1.8.1.3")
$yellowcurrentvolume = $snmp.get("43.11.1.1.9.1.3")
[int]$yellowpercentremaining = ($yellowcurrentvolume / $yellowtonervolume) * 100
$wastetonervolume = $snmp.get("43.11.1.1.8.1.6")
$wastecurrentvolume = [math]::round([math]::abs($snmp.get("43.11.1.1.9.1.6")))
[int]$wastepercentremaining = (($wastecurrentvolume / $wastetonervolume) * 100)

$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PX*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($blackpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -gt 24) -and ($blackpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -gt 10) -and ($blackpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($blackpercentremaining -ge 0) -and ($blackpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$blackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if ($cyanpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 24) -and ($cyanpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 10) -and ($cyanpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -ge 0) -and ($cyanpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if ($magentapercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 24) -and ($magentapercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 10) -and ($magentapercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -ge 0) -and ($magentapercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if ($yellowpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 24) -and ($yellowpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 10) -and ($yellowpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -ge 0) -and ($yellowpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if ($wastepercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -gt 24) -and ($wastepercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -gt 10) -and ($wastepercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if (($wastepercentremaining -ge 0) -and ($wastepercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$wastepercentremaining,"</b>% waste toner<br>"|add-content $outfile}
if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}


if ($printertype -like "*HP Designjet T1500*"){

$pblacktonervolume = $snmp.get("43.11.1.1.8.1.1")
$pblackcurrentvolume = $snmp.get("43.11.1.1.9.1.1")
[int]$pblackpercentremaining = ($pblackcurrentvolume / $pblacktonervolume) * 100 
$graytonervolume = $snmp.get("43.11.1.1.8.1.2")
$graycurrentvolume = $snmp.get("43.11.1.1.9.1.2")
[int]$graypercentremaining = ($graycurrentvolume / $graytonervolume) * 100
$mblacktonervolume = $snmp.get("43.11.1.1.8.1.3")
$mblackcurrentvolume = $snmp.get("43.11.1.1.9.1.3")
[int]$mblackpercentremaining = ($mblackcurrentvolume / $mblacktonervolume) * 100
$cyantonervolume = $snmp.get("43.11.1.1.8.1.4")
$cyancurrentvolume = $snmp.get("43.11.1.1.9.1.4")
[int]$cyanpercentremaining = ($cyancurrentvolume / $cyantonervolume) * 100
$magentatonervolume = $snmp.get("43.11.1.1.8.1.5")
$magentacurrentvolume = $snmp.get("43.11.1.1.9.1.5")
[int]$magentapercentremaining = ($magentacurrentvolume / $magentatonervolume) * 100
$yellowtonervolume = $snmp.get("43.11.1.1.8.1.6")
$yellowcurrentvolume = $snmp.get("43.11.1.1.9.1.6")
[int]$yellowpercentremaining = ($yellowcurrentvolume / $yellowtonervolume) * 100

$statustree = $snmp.gettree("43.18.1.1.8")
$status = $statustree|? {$_ -notlike "print*"} #status, including low ink warnings
$status = $status|? {$_ -notlike "*bypass*"}
$name = $snmp.get(".1.3.6.1.2.1.1.5.0")
if ($name -notlike "PH*"){$name = $p.name}

write ("<b>" + $p.description + "</b><a style='text-decoration:none;font-weight:bold;' href=http://" + $p.value + " target='_new'> " + $name + "</a> <br>" + $printertype + "<br>")|add-content $outfile
if ($pblackpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$pblackpercentremaining,"</b>% black toner<br>"|add-content $outfile}
if (($pblackpercentremaining -gt 24) -and ($pblackpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$pblackpercentremaining,"</b>% photo black toner<br>"|add-content $outfile}
if (($pblackpercentremaining -gt 10) -and ($pblackpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$pblackpercentremaining,"</b>% photo black toner<br>"|add-content $outfile}
if (($pblackpercentremaining -ge 0) -and ($pblackpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$pblackpercentremaining,"</b>% photo black toner<br>"|add-content $outfile}
if ($graypercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$graypercentremaining,"</b>% gray toner<br>"|add-content $outfile}
if (($graypercentremaining -gt 24) -and ($graypercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$graypercentremaining,"</b>% gray toner<br>"|add-content $outfile}
if (($graypercentremaining -gt 10) -and ($graypercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$graypercentremaining,"</b>% gray toner<br>"|add-content $outfile}
if (($graypercentremaining -ge 0) -and ($graypercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$graypercentremaining,"</b>% gray toner<br>"|add-content $outfile}
if ($mblackpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$mblackpercentremaining,"</b>% matte black toner<br>"|add-content $outfile}
if (($mblackpercentremaining -gt 24) -and ($mblackpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$mblackpercentremaining,"</b>% matte black toner<br>"|add-content $outfile}
if (($mblackpercentremaining -gt 10) -and ($mblackpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$mblackpercentremaining,"</b>% matte black toner<br>"|add-content $outfile}
if (($mblackpercentremaining -ge 0) -and ($mblackpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$mblackpercentremaining,"</b>% matte black toner<br>"|add-content $outfile}
if ($cyanpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 24) -and ($cyanpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -gt 10) -and ($cyanpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if (($cyanpercentremaining -ge 0) -and ($cyanpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$cyanpercentremaining,"</b>% cyan toner<br>"|add-content $outfile}
if ($magentapercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 24) -and ($magentapercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -gt 10) -and ($magentapercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if (($magentapercentremaining -ge 0) -and ($magentapercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$magentapercentremaining,"</b>% magenta toner<br>"|add-content $outfile}
if ($yellowpercentremaining -gt 49){write "<b style='font-size:110%;color:green;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 24) -and ($yellowpercentremaining -le 49)){write "<b style='font-size:110%;color:#40BB30;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -gt 10) -and ($yellowpercentremaining -le 24)){write "<b style='font-size:110%;color:orange;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}
if (($yellowpercentremaining -ge 0) -and ($yellowpercentremaining -le 10)){write "<b style='font-size:110%;color:red;'>",$yellowpercentremaining,"</b>% yellow toner<br>"|add-content $outfile}

if ($status.length -gt 0){write ($status + "<br><br>")|add-content $outfile}else{write "Operational<br><br>"|add-content $outfile}
}



}
}
&$outfile