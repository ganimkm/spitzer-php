<div class="d-flex" id="wrapper">

    <div id="sidebar-wrapper">

        <div class="page-header borbot-solid">Asset Actions</div>

        <nav class="navbar page-side-nav">

            <ul class="navbar-nav">
                
                <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/add.png' ?>" class="device-img" alt="">New asset</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/addloc.png' ?>" class="device-img" alt="">New location</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/edit.png' ?>" class="device-img" alt="">Edit asset</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/rescan.png' ?>" class="device-img" alt="">Rescan asset</a></li>
            </ul>

        </nav>

        <div class="page-header bortop-solid borbot-solid">Basic Actions</div>

        <nav class="navbar page-side-nav">

            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/ping.png' ?>" class="device-img" alt="">Ping</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/ping.png' ?>" class="device-img" alt="">Pathping</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/ping.png' ?>" class="device-img" alt="">Traceroute</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/http.png' ?>" class="device-img" alt="">HTTP</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/https.png' ?>" class="device-img" alt="">HTTPS</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/ssh.png' ?>" class="device-img" alt="">SSH Putty</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/restart.png' ?>" class="device-img" alt="">Restart</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/shutdown.png' ?>" class="device-img" alt="">Shutdown</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/abort.png' ?>" class="device-img" alt="">Abort shutdown</a></li>
            </ul>

        </nav>

    </div>

    <div id="page-content-wrapper">

    <?php
           
           $asset = json_decode(json_encode($assets), TRUE);                
           $monitor = json_decode(json_encode($monitor), TRUE);

       ?>

        <div class="asset-header">

            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td width="52" style="padding-right:12px;">
                            <img width="42" height="42" style="margin-top: 5px; margin-bottom: 5px;" src="<?php echo base_url() . '/assets/img/desktop.png' ?>" alt="" hspace="14" vspace="2">
                        </td>
                        <td>
                            <table border="0" cellspacing="2" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td class="headbot"><span class="ptitle">
                                            <?php echo $asset[0]['data']['ComputerSystem']['Name']?><font color="#999999" size="1"><?php echo '.' . $asset[0]['data']['ComputerSystem']['Domain']?></font>
                                            <?php echo $asset[0]['data']['OperatingSystem']['Caption']?><?php echo (array_key_exists('OSArchitecture', $asset[0]['data']['OperatingSystem']) ? ' (' . $asset[0]['data']['OperatingSystem']['OSArchitecture'] . ')' : "") ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="middle"><img src="<?php echo base_url() . '/assets/img/ok.png' ?>" alt="" width="10" height="10" id="pingimg" title="Ping status"><span class="ptitle"><?php echo ' ' . $asset[0]['ip_address'] ?></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <?php if (array_key_exists('manufacturer',$asset[0])){
                            if(isset($asset[0]['manufacturer'])){ ?>
                                <td align="right" style="padding-right:5px;">
                                    <img src="<?php echo(isset($asset[0]['manufacturer']) ? (isset($vendor_logo[strtolower($asset[0]['manufacturer'])]) ? base_url() . '/assets/img/vendors/'. $vendor_logo[strtolower($asset[0]['manufacturer'])] : strtolower($asset[0]['manufacturer'])) : $no_data_message) ?>" alt="" hspace="4" border="0" align="middle">
                                </td>
                        <?php }} ?>
                    </tr>
                </tbody>
            </table>
            
        </div>

       
       <div class="row">

           <div class="col-md-12">

               <!-- Main Tab -->
               <div class="main-tab">
               
                   <ul class="nav nav-pills" role="tablist">
       
                       <li class="nav-item">
                           <a class="nav-link active" href="#summary" id="summary-tab" role="tab" data-toggle="tab" aria-controls="summary" aria-expanded="true"><img class="main-tab-img" src="<?php echo base_url() . '/assets/img/windows.png' ?>">Summary</a>
                       </li>
                       
                       <li class="nav-item">
                           <a class="nav-link" href="#hardware" role="tab" id="hardware-tab" data-toggle="tab" aria-controls="hardware"><img class="main-tab-img" src="<?php echo base_url() . '/assets/img/settings.png' ?>">Hardware</a>
                       </li>

                       <li class="nav-item">
                           <a class="nav-link" href="#software" role="tab" id="software-tab" data-toggle="tab" aria-controls="software"><img class="main-tab-img" src="<?php echo base_url() . '/assets/img/software.png' ?>">Software</a>
                       </li>

                       <li class="nav-item">
                            <a class="nav-link" href="#location" role="tab" id="location-tab" data-toggle="tab" aria-controls="location"><img class="main-tab-img" src="<?php echo base_url() . '/assets/img/map.png' ?>">Location</a>
                        </li>
                           
                   </ul>

               </div>
   
               <!-- Content Panel -->
               <div class="tab-content">
                
                    <div role="tabpanel" class="tab-pane fade show active" id="summary" aria-labelledby="summary-tab">
                        
                        <div class="summary-tab">

                                <table border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
                                    <tbody>
                                        <tr>

                                            <td align="left" valign="top" bgcolor="#FFFFFF" style="padding:0">
                                                <div class="asset-summary">
                                                    <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">

                                                        <tbody>
                                                                                                                
                                                            <tr>
                                                                <td>Asset type:</td>
                                                                <td><img class="device-img" src="<?php echo base_url() . '/assets/img/windows.png' ?>"></td>
                                                                <td><?php echo $asset[0]['type'] ?></td>
                                                            </tr>
                                                            
                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['OperatingSystem'])){ ?>

                                                                <tr>
                                                                    <td>OS:</td>
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/windows.png' ?>"></td>
                                                                    <td><?php echo $asset[0]['data']['OperatingSystem']['Caption'] ?><?php echo (array_key_exists('OSArchitecture', $asset[0]['data']['OperatingSystem']) ? ' (' . $asset[0]['data']['OperatingSystem']['OSArchitecture'] . ')' : "") ?></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Version:</td>
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/windows.png' ?>"></td>
                                                                    <td><?php echo $asset[0]['data']['OperatingSystem']['Version'] . ' Build '. $asset[0]['data']['OperatingSystem']['BuildNumber'] ?></td>
                                                                </tr>

                                                            <?php } ?>
                                                            
                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (array_key_exists('user_name',$asset[0])){

                                                                if(isset($asset[0]['user_name'])){ ?>

                                                                    <tr>
                                                                        <td>Last User:</td>                                                                        
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/users.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['user_name'] ?></td>
                                                                    </tr>

                                                            <?php }} ?>

                                                            <?php if (array_key_exists('manufacturer',$asset[0])){

                                                                if(isset($asset[0]['manufacturer'])){ ?>

                                                                    <tr>
                                                                        <td>Manufacturer:</td>                                                                        
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/manufactor.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['manufacturer'] ?></td>
                                                                    </tr>

                                                            <?php }} ?>

                                                            <?php if (array_key_exists('model',$asset[0])){

                                                                if(isset($asset[0]['model'])){ ?>

                                                                    <tr>
                                                                        <td>Model:</td>                                                                        
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/model.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['model'] ?></td>
                                                                    </tr>

                                                            <?php }} ?>

                                                            <?php if (array_key_exists('domain',$asset[0])){

                                                                if(isset($asset[0]['domain'])){ ?>

                                                                    <tr>
                                                                        <td>Domain:</td>                                                                        
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/domain.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['domain'] ?></td>
                                                                    </tr>

                                                            <?php }} ?>

                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['PhysicalMemory'])){

                                                                    $totalcapacity = 0;
                                                                    $memory_type = '';

                                                                    if (isset($asset[0]['data']['PhysicalMemory'][0])){

                                                                        for ($x = 0; $x < sizeof($asset[0]['data']['PhysicalMemory']); $x++) {
                                                                            $totalcapacity = $totalcapacity + $asset[0]['data']['PhysicalMemory'][$x]['Capacity'];
                                                                        }

                                                                        $memory_type = isset($physical_memory_memory_type[$asset[0]['data']['PhysicalMemory'][0]['MemoryType']]) ? $physical_memory_memory_type[$asset[0]['data']['PhysicalMemory'][0]['MemoryType']] : "";

                                                                    }else{

                                                                        $totalcapacity = $asset[0]['data']['PhysicalMemory']['Capacity'];
                                                                        $memory_type = isset($physical_memory_memory_type[$asset[0]['data']['PhysicalMemory']['MemoryType']]) ? $physical_memory_memory_type[$asset[0]['data']['PhysicalMemory']['MemoryType']] : "";

                                                                    }

                                                                ?>

                                                                    <tr>
                                                                        <td>Memory:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/ram.png' ?>"></td>                                                                       
                                                                        <td><?php echo $this->utility->format_bytes($totalcapacity) . ' ' . $memory_type ?></td>
                                                                    </tr>


                                                            <?php } ?>

                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['Processor'])){

                                                                    if (isset($asset[0]['data']['Processor'][0])){
                                                                ?>
                                                                    
                                                                    <tr>
                                                                        <td>Processor:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/cpu.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['Processor'][0]['Name'] . ' X ' . sizeof($asset[0]['data']['Processor']) ?></td>
                                                                    </tr>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td>Processor:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/cpu.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['Processor']['Name'] ?></td>
                                                                    </tr>

                                                            <?php }} ?>

                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['BaseBoard'])){

                                                                    if (isset($asset[0]['data']['BaseBoard'][0])){

                                                                        for ($x = 0; $x < sizeof($asset[0]['data']['BaseBoard']); $x++) {
                                                                ?>     

                                                                    <tr>
                                                                        <td>Motherboard:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/motherboard.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['BaseBoard'][$x]['Manufacturer'] . ' ' . $asset[0]['data']['BaseBoard'][$x]['Product'] ?></td>
                                                                    </tr>

                                                                <?php } ?>

                                                                <?php }else{ ?>

                                                                <tr>
                                                                    <td>Motherboard:</td>
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/motherboard.png' ?>"></td>
                                                                    <td><?php echo $asset[0]['data']['BaseBoard']['Manufacturer'] . ' ' . $asset[0]['data']['BaseBoard']['Product'] ?></td>
                                                                </tr>

                                                            <?php }} ?>

                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['VideoController'])){

                                                                    if (isset($asset[0]['data']['VideoController'][0])){

                                                                        for ($x = 0; $x < sizeof($asset[0]['data']['VideoController']); $x++) {

                                                                            if ($x == 0){
                                                                ?>

                                                                    <tr>
                                                                        <td>Graphics:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/videocard.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['VideoController'][$x]['Caption'] . ' - ' . (empty($asset[0]['data']['VideoController'][$x]['AdapterRAM']) ?: $this->utility->format_bytes($asset[0]['data']['VideoController'][$x]['AdapterRAM']))  ?></td>
                                                                    </tr>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td></td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/videocard.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['VideoController'][$x]['Caption'] . ' - ' . (empty($asset[0]['data']['VideoController'][$x]['AdapterRAM']) ?: $this->utility->format_bytes($asset[0]['data']['VideoController'][$x]['AdapterRAM']))  ?></td>
                                                                    </tr>

                                                                <?php }} ?>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td>Graphics:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/videocard.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['VideoController']['Caption'] . ' - ' . (empty($asset[0]['data']['VideoController']['AdapterRAM']) ?: $this->utility->format_bytes($asset[0]['data']['VideoController']['AdapterRAM']))  ?></td>
                                                                    </tr>

                                                            <?php }} ?>                                                            

                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['SoundDevice'])){

                                                                    if (isset($asset[0]['data']['SoundDevice'][0])){

                                                                        for ($x = 0; $x < sizeof($asset[0]['data']['SoundDevice']); $x++) {

                                                                            if ($x == 0){

                                                                ?>                
                                                                    <tr>
                                                                        <td>Audio:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/stereo.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['SoundDevice'][$x]['Caption'] ?></td>
                                                                    </tr>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td></td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/stereo.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['SoundDevice'][$x]['Caption'] ?></td>
                                                                    </tr>

                                                                <?php }} ?>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td>Audio:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/stereo.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['SoundDevice']['Caption'] ?></td>
                                                                    </tr>

                                                            <?php }} ?>
                                                                
                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['Antivirus'])){

                                                                        if (isset($asset[0]['data']['Antivirus'][0])){

                                                                            for ($x = 0; $x < sizeof($asset[0]['data']['Antivirus']); $x++) {

                                                                                if ($x == 0){

                                                                ?>
                                                                
                                                                    <tr>
                                                                        <td>Antivirus:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/antivirus.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['Antivirus'][$x]['DisplayName'] . ' - ' . $asset[0]['data']['Antivirus'][$x]['RealTimeProductionStatus'] . ' - ' . $asset[0]['data']['Antivirus'][$x]['DefinitionStatus'] ?></td>
                                                                    </tr>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td></td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/antivirus.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['Antivirus'][$x]['DisplayName'] . ' - ' . $asset[0]['data']['Antivirus'][$x]['RealTimeProductionStatus'] . ' - ' . $asset[0]['data']['Antivirus'][$x]['DefinitionStatus'] ?></td>
                                                                    </tr>

                                                                <?php }} ?>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td>Antivirus:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/antivirus.png' ?>"></td>
                                                                        <td><?php echo $asset[0]['data']['Antivirus']['DisplayName'] . ' - ' . $asset[0]['data']['Antivirus']['RealTimeProductionStatus'] . ' - ' . $asset[0]['data']['Antivirus']['DefinitionStatus'] ?></td>
                                                                    </tr>

                                                            <?php }} ?>

                                                            <!------------------------------------------------------------------------------------------------------------------------------->

                                                            <?php if (isset($asset[0]['data']['NetworkAdapter'])){

                                                                $cnt = 0;

                                                                if (isset($asset[0]['data']['NetworkAdapter'][0])){

                                                                    for ($x = 0; $x < sizeof($asset[0]['data']['NetworkAdapter']); $x++){
                                                                    
                                                                        if($asset[0]['data']['NetworkAdapter'][$x]['IPEnabled'] == 'True') {

                                                                            if ($cnt == 0) { $cnt++
                                                                ?>                                                                                                                                                                                           
                                                                        <tr>
                                                                            <td>Network:</td>
                                                                            <td><img class="device-img" src="<?php echo base_url() . '/assets/img/network.png' ?>"></td>
                                                                            <td><?php echo (!array_key_exists('Name',$asset[0]['data']['NetworkAdapter'][$x]) ?: $asset[0]['data']['NetworkAdapter'][$x]['Name']) . (!array_key_exists('MACAddress',$asset[0]['data']['NetworkAdapter'][$x]) ?: '<br>' . $asset[0]['data']['NetworkAdapter'][$x]['MACAddress']) ?>

                                                                                <?php
                                                                                
                                                                                $ips = '';

                                                                                foreach (explode(" ",$asset[0]['data']['NetworkAdapter'][$x]['IPAddress']) as $value){
                                                                                        $ips .= $value . ',';
                                                                                    }
                                                                                    
                                                                                    if (isset($ips)) {
                                                                                        echo ' - ' . $this->utility->chop_last_char($ips);
                                                                                    }
                                                                                ?>

                                                                            </td>
                                                                        </tr>

                                                                <?php }else{ ?>

                                                                    <tr>
                                                                        <td></td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/network.png' ?>"></td>
                                                                        <td><?php echo (!array_key_exists('Name',$asset[0]['data']['NetworkAdapter'][$x]) ?: $asset[0]['data']['NetworkAdapter'][$x]['Name']) . (!array_key_exists('MACAddress',$asset[0]['data']['NetworkAdapter'][$x]) ?: '<br>' . $asset[0]['data']['NetworkAdapter'][$x]['MACAddress']) ?>

                                                                            <?php

                                                                                $ips = '';

                                                                                foreach (explode(" ",$asset[0]['data']['NetworkAdapter'][$x]['IPAddress']) as $value){
                                                                                    $ips .= $value . ',';
                                                                                }

                                                                                if (isset($ips)) {
                                                                                    echo ' -' . $this->utility->chop_last_char($ips);
                                                                                }

                                                                            ?>

                                                                        </td>
                                                                    </tr>

                                                                <?php }}} ?>

                                                                <?php }else{ ?>

                                                                <tr>
                                                                    <td>Network:</td>
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/network.png' ?>"></td>
                                                                    <td><?php echo (!array_key_exists('Name',$asset[0]['data']['NetworkAdapter']) ?: $asset[0]['data']['NetworkAdapter']['Name']) . (!array_key_exists('MACAddress',$asset[0]['data']['NetworkAdapter']) ?: ' - ' . $asset[0]['data']['NetworkAdapter']['MACAddress']) ?>

                                                                        <?php

                                                                            $ips = '';

                                                                            foreach (explode(" ",$asset[0]['data']['NetworkAdapter']['IPAddress']) as $value){
                                                                                $ips .= $value . ',';
                                                                            }

                                                                            if (isset($ips)) {
                                                                                echo '<br>' . $this->utility->chop_last_char($ips);
                                                                            }

                                                                        ?>       

                                                                    </td>
                                                                </tr>  

                                                            <?php }} ?>

                                                            <!------------------------------------------------------------------------------------------------------------------------------->


                                                            <?php if (isset($asset[0]['data']['LocalDisk'])){
                                                                
                                                                if (isset($asset[0]['data']['LocalDisk'][0])){

                                                                    for ($x = 0; $x < sizeof($asset[0]['data']['LocalDisk']); $x++){                                                                            
                                                                        $FreePercent = round(($asset[0]['data']['LocalDisk'][$x]['FreeSpace'] / $asset[0]['data']['LocalDisk'][$x]['Size']) * 100);
                                                                        $FilledPercent = 100-$FreePercent;

                                                                        if ($x == 0){
                                                                ?>

                                                                    <tr>
                                                                        <td>Harddisk:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/localdisk.png' ?>"></td>
                                                                        <td>
                                                                            <div class="progress_bar fadeIn" style="width:250px;">
                                                                                <div class="progress_holder">
                                                                                    <div class="progress_bar_title"><?php echo $asset[0]['data']['LocalDisk'][$x]['Name']  . ' ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk'][$x]['FreeSpace']) . ' free of ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk'][$x]['Size']) ?></div>
                                                                                    <div class="progress_number"><?php echo $FilledPercent  . '%' ?></div>
                                                                                </div>
                                                                                <div class="progress_bar_holder">
                                                                                    <?php echo '<div class="progress_bar_content" style="width: ' . $FilledPercent  . '%; background:' . ($FreePercent <= 10 ? '#D20000' : '#26A0DA') .';" data-score="' . $FilledPercent  . '"></div>' ?>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                
                                                                <?php }else{ ?>
                                                                            
                                                                    <tr>
                                                                        <td></td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/localdisk.png' ?>"></td>
                                                                        <td>
                                                                            <div class="progress_bar fadeIn" style="width:250px;">
                                                                                <div class="progress_holder">
                                                                                    <div class="progress_bar_title"><?php echo $asset[0]['data']['LocalDisk'][$x]['Name']  . ' ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk'][$x]['FreeSpace']) . ' free of ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk'][$x]['Size']) ?></div>
                                                                                    <div class="progress_number"><?php echo $FilledPercent  . '%' ?></div>
                                                                                </div>
                                                                                <div class="progress_bar_holder">
                                                                                    <?php echo '<div class="progress_bar_content" style="width: ' . $FilledPercent  . '%; background:' . ($FreePercent <= 10 ? '#D20000' : '#26A0DA') .';" data-score="' . $FilledPercent  . '"></div>' ?>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                <?php }} ?>

                                                                <?php }else{ 
                                                                
                                                                    $FreePercent = round(($asset[0]['data']['LocalDisk']['FreeSpace'] / $asset[0]['data']['LocalDisk']['Size']) * 100);
                                                                    $FilledPercent = 100-$FreePercent;

                                                                ?>

                                                                    <tr>
                                                                        <td>Harddisk:</td>
                                                                        <td><img class="device-img" src="<?php echo base_url() . '/assets/img/localdisk.png' ?>"></td>
                                                                        <td>
                                                                            <div class="progress_bar fadeIn" style="width:250px;">
                                                                                <div class="progress_holder">
                                                                                    <div class="progress_bar_title"><?php echo $asset[0]['data']['LocalDisk']['Name']  . ' ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk']['FreeSpace']) . ' free of ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk']['Size']) ?></div>
                                                                                    <div class="progress_number"><?php echo $FilledPercent  . '%' ?></div>
                                                                                </div>
                                                                                <div class="progress_bar_holder">
                                                                                    <?php echo '<div class="progress_bar_content" style="width: ' . $FilledPercent  . '%; background:' . ($FreePercent <= 10 ? '#D20000' : '#26A0DA') .';" data-score="' . $FilledPercent  . '"></div>' ?>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>   

                                                            <?php }} ?>                                                           

                                                        </tbody>  

                                                    </table>
                                                </div>
                                            </td>

                                            <td align="center" valign="top" bgcolor="#FFFFFF" style="padding:0" class="borleft">
                                                <div class="asset-summary">
                                                    <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">

                                                        <tbody>

                                                            <tr>
                                                                <td>Scan status:</td>
                                                                <td><img class="device-img" src="<?php echo base_url() . '/assets/img/traffic-light.png' ?>"></td>
                                                                <!-- <td><img src="<?php echo base_url() . '/assets/img/loader.gif' ?>"></td> -->
                                                                <td></td>
                                                            </tr>


                                                            <?php if (isset($asset[0]['scan_server'])){ ?>

                                                                <tr>
                                                                    <td>Scan server:</td>                                                                    
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/scanserver.png' ?>"></td>
                                                                    <td><?php echo  $asset[0]['scan_server'] ?></td>
                                                                </tr>

                                                            <?php } ?>

                                                            <tr>
                                                                <td>Asset location:</td>
                                                                <td><img class="device-img" src="<?php echo base_url() . '/assets/img/map.png' ?>"></td>                                                                
                                                                <td></td>
                                                            </tr>

                                                            <?php if (isset($asset[0]['serial'])){ ?>
                                                                <tr>
                                                                    <td>Serial #:</td>               
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/steps.png' ?>"></td>
                                                                    <td><?php echo  $asset[0]['serial'] ?></td>
                                                                </tr>

                                                            <?php } ?>

                                                            <?php if (isset($asset[0]['first_seen'])){ ?>
                                                                <tr>
                                                                    <td>First seen:</td>
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/calendar.png' ?>"></td>
                                                                    <td><?php echo  date("Y-m-d H:i:s", $asset[0]['first_seen']['$date']['$numberLong'] / 1000) ?></td>
                                                                </tr>

                                                            <?php } ?>

                                                            <?php if (isset($asset[0]['last_seen'])){ ?>
                                                                <tr>
                                                                    <td>Last seen:</td>
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/calendar.png' ?>"></td>
                                                                    <td><?php echo  date("Y-m-d H:i:s", $asset[0]['last_seen']['$date']['$numberLong'] / 1000) ?></td>
                                                                </tr>

                                                            <?php } ?>
                                                        
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </td>

                                            <td align="center" valign="top" bgcolor="#FFFFFF" style="padding:0" class="borleft">
                                                <table width="100%" border="0" cellpadding="2" cellspacing="2">
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                        </div>

                        <div class="page-div-header"><img src="<?php echo base_url() . '/assets/img/relation.png' ?>" alt="" hspace="14" vspace="2">Relations</div>

                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="hardware" aria-labelledby="hardware-tab">

                        <div class="hardware-tab">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-10 p-0">

                                        <div class="menu-content baseboard">   

                                            <div class="inner-tab">

                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#computersystem"><img class="device-img" src="<?php echo base_url() . '/assets/img/computer.png' ?>">Computer System</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chassis"><img class="device-img" src="<?php echo base_url() . '/assets/img/chassis.png' ?>">Chassis</a></li>                                                        
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#motherboard"><img class="device-img" src="<?php echo base_url() . '/assets/img/motherboard.png' ?>">Motherboard</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#bios"><img class="device-img" src="<?php echo base_url() . '/assets/img/bios.png' ?>">BIOS</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#systemslots"><img class="device-img" src="<?php echo base_url() . '/assets/img/slot.png' ?>">System Slots</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#memoryslots"><img class="device-img" src="<?php echo base_url() . '/assets/img/ram.png' ?>">Memory Slots</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ports"><img class="device-img" src="<?php echo base_url() . '/assets/img/port.png' ?>">Ports</a></li>
                                                </ul>

                                            </div>

                                            <div class="tab-content">

                                                <div id="computersystem" class="tab-pane active">

                                                    <div class="row row-buffer">
                                                        
                                                        <?php if (array_key_exists('ComputerSystem',$asset[0]['data'])) { 

                                                            if (isset($asset[0]['data']['ComputerSystem'])) { ?>
                                                                                                
                                                                <div class="col-sm-4">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">Computer System<img width="48" height="48" src="<?php echo base_url() . '/assets/img/computer.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                            <div class="table-responsive">
                                                                                <table class="table-hover table-sm main-table">
                                                                                    <tbody>
                                                                                        <tr><td>Domain</td><td><?php echo(isset($asset[0]['data']['ComputerSystem']['Domain']) ? $asset[0]['data']['ComputerSystem']['Domain'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['ComputerSystem']['Manufacturer']) ? $asset[0]['data']['ComputerSystem']['Manufacturer'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Model</td><td><?php echo(isset($asset[0]['data']['ComputerSystem']['Model']) ? $asset[0]['data']['ComputerSystem']['Model'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Name</td><td><?php echo(isset($asset[0]['data']['ComputerSystem']['Name']) ? $asset[0]['data']['ComputerSystem']['Name'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Owner Name</td><td><?php echo(isset($asset[0]['data']['ComputerSystem']['PrimaryOwnerName']) ? $asset[0]['data']['ComputerSystem']['PrimaryOwnerName'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Total Memory</td><td><?php echo(isset($asset[0]['data']['ComputerSystem']['TotalPhysicalMemory']) ? $this->utility->format_bytes($asset[0]['data']['ComputerSystem']['TotalPhysicalMemory']) : $no_data_message)  ?></td></tr>                                                                                 
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>

                                                            <?php } else { ?>

                                                                <div class="col-sm-3">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">Computer System<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text">No information available</p>                                                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        <?php } ?>

                                                    </div>
                                                
                                                </div>

                                                <div id="chassis" class="tab-pane fade">
                                                    
                                                    <div class="row row-buffer">

                                                        <?php if (array_key_exists('SystemEnclosure',$asset[0]['data'])) { 

                                                            if (isset($asset[0]['data']['SystemEnclosure'])) { ?>

                                                                <div class="col-sm-4">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">Chassis<img width="48" height="48" src="<?php echo base_url() . '/assets/img/chassis.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                            <div class="table-responsive">
                                                                                <table class="table-hover table-sm main-table">
                                                                                    <tbody>                                                                                
                                                                                        <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['SystemEnclosure']['Manufacturer']) ? $asset[0]['data']['SystemEnclosure']['Manufacturer'] : $no_data_message)  ?></td></tr>    
                                                                                        <tr><td>Model</td><td><?php echo(isset($asset[0]['data']['SystemEnclosure']['Model']) ? $asset[0]['data']['SystemEnclosure']['Model'] : $no_data_message)  ?></td></tr> 
                                                                                        <tr><td>Lock Present</td><td><?php echo(isset($asset[0]['data']['SystemEnclosure']['LockPresent']) ? ($asset[0]['data']['SystemEnclosure']['LockPresent'] ? "True" : "False") : $no_data_message)  ?></td></tr>                                                                                                                                                                          
                                                                                        <tr><td>Security Status</td><td><?php echo(isset($asset[0]['data']['SystemEnclosure']['SecurityStatus']) ? $system_enclosure_security_status[$asset[0]['data']['SystemEnclosure']['SecurityStatus']] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Chassis Types</td><td><?php echo(isset($asset[0]['data']['SystemEnclosure']['ChassisTypes'][0]) ? $system_enclosure_chassis_types[$asset[0]['data']['SystemEnclosure']['ChassisTypes'][0]] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Serial #</td><td><?php echo(isset($asset[0]['data']['SystemEnclosure']['SerialNumber']) ? $asset[0]['data']['SystemEnclosure']['SerialNumber'] : $no_data_message)  ?></td></tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>

                                                            <?php } else { ?>

                                                                <div class="col-sm-3">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                        <h6 class="card-title">Chassis<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text">No information available</p>                                                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                                <div id="motherboard" class="tab-pane fade">
                                                    
                                                    <div class="row row-buffer">

                                                        <?php if (array_key_exists('BaseBoard',$asset[0]['data'])) { 

                                                            if (isset($asset[0]['data']['BaseBoard'])) { ?>

                                                                <div class="col-sm-4">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">Motherboard<img width="48" height="48" src="<?php echo base_url() . '/assets/img/motherboard.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                            <div class="table-responsive">
                                                                                <table class="table-hover table-sm main-table">
                                                                                    <tbody>  
                                                                                        <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['BaseBoard']['Manufacturer']) ? $asset[0]['data']['BaseBoard']['Manufacturer'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Model</td><td><?php echo(isset($asset[0]['data']['BaseBoard']['Model']) ? $asset[0]['data']['BaseBoard']['Model'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Name</td><td><?php echo(isset($asset[0]['data']['BaseBoard']['Name']) ? $asset[0]['data']['BaseBoard']['Name'] : $no_data_message)  ?></td></tr>                                                                                                                                                                                                                                                    
                                                                                        <tr><td>Serial #</td><td><?php echo(isset($asset[0]['data']['BaseBoard']['SerialNumber']) ? $asset[0]['data']['BaseBoard']['SerialNumber'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Version</td><td><?php echo(isset($asset[0]['data']['BaseBoard']['Version']) ? $asset[0]['data']['BaseBoard']['Version'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Product Name</td><td><?php echo(isset($asset[0]['data']['BaseBoard']['Product']) ? $asset[0]['data']['BaseBoard']['Product'] : $no_data_message)  ?></td></tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>

                                                            <?php } else { ?>

                                                                <div class="col-sm-3">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">Motherboard<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text">No information available</p>                                                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                                <div id="bios" class="tab-pane fade">
                                                    
                                                    <div class="row row-buffer">

                                                        <?php if (array_key_exists('BIOS',$asset[0]['data'])) { 

                                                            if (isset($asset[0]['data']['BIOS'])) { ?>

                                                                <div class="col-sm-4">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">BIOS<img width="48" height="48" src="<?php echo base_url() . '/assets/img/bios.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                            <div class="table-responsive">
                                                                                <table class="table-hover table-sm main-table">
                                                                                    <tbody>
                                                                                        <tr><td>Name</td><td><?php echo(isset($asset[0]['data']['BIOS']['Name']) ? $asset[0]['data']['BIOS']['Name'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['BIOS']['Manufacturer']) ? $asset[0]['data']['BIOS']['Manufacturer'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Release Date</td><td><?php echo(isset($asset[0]['data']['BIOS']['ReleaseDate']) ? $asset[0]['data']['BIOS']['ReleaseDate'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>SMBIOS Version</td><td><?php echo(isset($asset[0]['data']['BIOS']['SMBIOSBIOSVersion']) ? $asset[0]['data']['BIOS']['SMBIOSBIOSVersion'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Serial #</td><td><?php echo(isset($asset[0]['data']['BIOS']['SerialNumber']) ? $asset[0]['data']['BIOS']['SerialNumber'] : $no_data_message)  ?></td></tr>
                                                                                        <tr><td>Version</td><td><?php echo(isset($asset[0]['data']['BIOS']['Version']) ? $asset[0]['data']['BIOS']['Version'] : $no_data_message)  ?></td></tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>

                                                            <?php } else { ?>

                                                                <div class="col-sm-3">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">BIOS<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text">No information available</p>                                                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                                <div id="systemslots" class="tab-pane fade">

                                                    <div class="row row-buffer">

                                                        <?php if (array_key_exists('SystemSlot',$asset[0]['data'])) { 

                                                            if (isset($asset[0]['data']['SystemSlot'])) { ?>

                                                                <div class="col-sm-4">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">System Slots<img width="48" height="48" src="<?php echo base_url() . '/assets/img/slot.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                            <div class="table-responsive">
                                                                                <table class="table-hover table-sm main-table">
                                                                                    <tbody>  
                                                                                        <?php for ($x = 0; $x < sizeof($asset[0]['data']['SystemSlot']); $x++) { ?>
                                                                                            <tr>
                                                                                                <td>System Slot <?php echo ($x+1) ?></td>
                                                                                                <td><?php echo(isset($asset[0]['data']['SystemSlot'][$x]['SlotDesignation']) ? $asset[0]['data']['SystemSlot'][$x]['SlotDesignation'] : $no_data_message)  ?></td>
                                                                                                <td><?php echo(isset($asset[0]['data']['SystemSlot'][$x]['CurrentUsage']) ? $system_slot_current_usage[$asset[0]['data']['SystemSlot'][$x]['CurrentUsage']] : $no_data_message)  ?></td>
                                                                                            </tr>   
                                                                                        <?php } ?>                                                                           
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>

                                                            <?php } else { ?>

                                                                <div class="col-sm-3">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">System Slots<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text">No information available</p>                                                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                                <div id="memoryslots" class="tab-pane fade">
                                                    
                                                    <div class="row row-buffer">

                                                        <?php 

                                                            $no_mem_slots = 0;
                                                            
                                                            if (array_key_exists('PhysicalMemoryArray',$asset[0]['data'])){

                                                                if (isset($asset[0]['data']['PhysicalMemoryArray'])) { 

                                                                    if (isset($asset[0]['data']['PhysicalMemoryArray'][0])){

                                                                        for ($x = 0; $x < sizeof($asset[0]['data']['PhysicalMemoryArray']); $x++) {

                                                                            $no_mem_slots += $asset[0]['data']['PhysicalMemoryArray'][$x]['MemoryDevices'];

                                                                        }
                                                                    }else{

                                                                        $no_mem_slots += $asset[0]['data']['PhysicalMemoryArray']['MemoryDevices'];

                                                                    }

                                                                }

                                                            }

                                                        ?>

                                                        <?php if (array_key_exists('PhysicalMemory',$asset[0]['data'])) { 

                                                            if (isset($asset[0]['data']['PhysicalMemory'])) { ?>

                                                                <div class="col-sm-4">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">Memory Slots<img width="48" height="48" src="<?php echo base_url() . '/assets/img/ram.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                            <div class="table-responsive">
                                                                                <table class="table-hover table-sm main-table">
                                                                                    <tbody>  

                                                                                        <?php 

                                                                                            if (isset($asset[0]['data']['PhysicalMemory'][0])){

                                                                                                for ($x = 0; $x < $no_mem_slots; $x++) {  

                                                                                                    if (isset($asset[0]['data']['PhysicalMemory'][$x])){
                                                                                        ?>                                                                                            
                                                                                                        <tr>
                                                                                                            <td>Memory Slot <?php echo ($x+1) ?></td>
                                                                                                            <td><?php echo ($asset[0]['data']['PhysicalMemory'][$x]['DeviceLocator']) ?></td> 
                                                                                                            <td><?php echo ($this->utility->format_bytes($asset[0]['data']['PhysicalMemory'][$x]['Capacity'])) ?></td>
                                                                                                        </tr> 

                                                                                        <?php }else{ ?> 

                                                                                            <tr>
                                                                                                <td>Memory Slot # <?php echo ($x+1) . ($x+1 < $no_mem_slots ? ' to ' . $no_mem_slots : '')  ?>  </td>
                                                                                                <td><?php echo $no_data_message ?></td> 
                                                                                                <td><?php echo $no_data_message ?></td> 
                                                                                            </tr> 

                                                                                            <?php break; ?>

                                                                                        <?php }}}else{ ?>

                                                                                        <tr>
                                                                                                <td>Memory Slot</td>
                                                                                                <td><?php echo ($asset[0]['data']['PhysicalMemory']['DeviceLocator']) ?></td> 
                                                                                                <td><?php echo ($this->utility->format_bytes($asset[0]['data']['PhysicalMemory']['Capacity'])) ?></td>
                                                                                            </tr>  
                                                                                            
                                                                                        <?php for ($x = 1; $x < $no_mem_slots; $x++) { ?>

                                                                                            <tr>
                                                                                                <td>Memory Slot # <?php echo ($x+1) . ($x+1 < $no_mem_slots ? ' to ' . $no_mem_slots : '')  ?>  </td>
                                                                                                <td><?php echo $no_data_message ?></td>  
                                                                                                <td><?php echo $no_data_message ?></td> 
                                                                                            </tr>   

                                                                                            <?php break; ?>                                                                              
                                                                                                    
                                                                                    <?php }} ?>    

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php } ?>

                                                            <?php } else { ?>

                                                                <div class="col-sm-3">
                                                                    <div class="card">
                                                                        <div class="card-body">  
                                                                            <h6 class="card-title">Memory Slots<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                            <p class="card-text">No information available</p>                                                                                    
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                                <div id="ports" class="tab-pane fade">

                                                    <div class="row row-buffer">

                                                        <?php
                                                        
                                                            if (array_key_exists('PortConnector',$asset[0]['data'])) { 

                                                                if (isset($asset[0]['data']['PortConnector'])) { ?>

                                                                    <div class="col-sm-6">
                                                                        <div class="card">
                                                                            <div class="card-body">  
                                                                                <h6 class="card-title">Ports<img width="48" height="48" src="<?php echo base_url() . '/assets/img/port.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                                <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                                <div class="table-responsive">
                                                                                    <table class="table-hover table-sm main-table">
                                                                                        <tbody>  
                                                                                            <?php for ($x = 0; $x < sizeof($asset[0]['data']['PortConnector']); $x++) { ?>
                                                                                                <tr>
                                                                                                    <td>Port <?php echo ($x+1) ?></td>
                                                                                                    <td><?php echo((isset($asset[0]['data']['PortConnector'][$x]['InternalReferenceDesignator']) ? $asset[0]['data']['PortConnector'][$x]['InternalReferenceDesignator'] : $no_data_message))?></td>                                                                                                                                                                                    
                                                                                                    <td><?php echo((isset($asset[0]['data']['PortConnector'][$x]['ExternalReferenceDesignator']) ? $asset[0]['data']['PortConnector'][$x]['ExternalReferenceDesignator'] : $no_data_message))?></td>
                                                                                                    <td><?php echo((isset($asset[0]['data']['PortConnector'][$x]['ExternalReferenceDesignator']) ? $asset[0]['data']['PortConnector'][$x]['ExternalReferenceDesignator'] : $asset[0]['data']['PortConnector'][$x]['InternalReferenceDesignator']) . ' (' . $port_connector_port_type[$asset[0]['data']['PortConnector'][$x]['PortType']] . ' / ' .  $port_connector_connector_type[$asset[0]['data']['PortConnector'][$x]['ConnectorType'][0]] . ')') ?></td>                                                                                                                                                                                    
                                                                                                </tr>   
                                                                                            <?php } ?>                                                                           
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                            <?php }} else { ?>

                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Ports<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="menu-content processor">

                                            <?php 

                                                $col_cnt=0;

                                                if (isset($asset[0]['data']['Processor'])){

                                                    if (isset($asset[0]['data']['Processor'][0])){

                                                        for ($x = 0; $x < sizeof($asset[0]['data']['Processor']); $x++) {

                                            ?>

                                            <?php 

                                                if ($col_cnt == 0){
                                                    echo  '<div class="row row-buffer">';                                                      
                                                }

                                                $col_cnt += 4;  
                                            
                                            ?>

                                                <div class="col-sm-4">
                                                    <div class="card">
                                                        <div class="card-body">  
                                                            <h6 class="card-title">Processor <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/cpu.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                            <p class="card-text"><?php echo $asset[0]['data']['Processor'][$x]['Name'] ?></p>
                                                            <div class="table-responsive">
                                                                <table class="table-hover table-sm main-table">
                                                                    <tbody>
                                                                        <tr><td>Description</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['Description']) ? $asset[0]['data']['Processor'][$x]['Description'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['Manufacturer']) ? $asset[0]['data']['Processor'][$x]['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Processor Id</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['ProcessorId']) ? $asset[0]['data']['Processor'][$x]['ProcessorId'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Socket Designation</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['SocketDesignation']) ? $asset[0]['data']['Processor'][$x]['SocketDesignation'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Address Width</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['AddressWidth']) ? $asset[0]['data']['Processor'][$x]['AddressWidth'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Architecture</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['Architecture']) ? (isset($processor_architecture[$asset[0]['data']['Processor'][$x]['Architecture']]) ? $processor_architecture[$asset[0]['data']['Processor'][$x]['Architecture']] : $asset[0]['data']['Processor'][$x]['Architecture']) : $no_data_message) ?></td></tr>
                                                                        <tr><td>Availability</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['Availability']) ? (isset($processor_availability[$asset[0]['data']['Processor'][$x]['Availability']]) ? $processor_availability[$asset[0]['data']['Processor'][$x]['Availability']] : $asset[0]['data']['Processor'][$x]['Availability']) : $no_data_message) ?></td></tr>
                                                                        <tr><td>Cpu Status</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['CpuStatus']) ? (isset($processor_cpu_status[$asset[0]['data']['Processor'][$x]['CpuStatus']]) ? $processor_cpu_status[$asset[0]['data']['Processor'][$x]['CpuStatus']] : $asset[0]['data']['Processor'][$x]['CpuStatus']) : $no_data_message) ?></td></tr>
                                                                        <tr><td>Data Width</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['DataWidth']) ? $asset[0]['data']['Processor'][$x]['DataWidth'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Device ID</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['DeviceID']) ? $asset[0]['data']['Processor'][$x]['DeviceID'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Ext Clock</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['ExtClock']) ? $asset[0]['data']['Processor'][$x]['ExtClock'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Family</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['Family']) ? (isset($processor_family[$asset[0]['data']['Processor'][$x]['Family']]) ? $processor_family[$asset[0]['data']['Processor'][$x]['Family']] : $asset[0]['data']['Processor'][$x]['Family']) : $no_data_message) ?></td></tr>
                                                                        <tr><td>Max Clock Speed</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['MaxClockSpeed']) ? $asset[0]['data']['Processor'][$x]['MaxClockSpeed'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>L2 Cache Size</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['L2CacheSize']) ? $asset[0]['data']['Processor'][$x]['L2CacheSize'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>L2 Cache Speed</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['L2CacheSpeed']) ? $asset[0]['data']['Processor'][$x]['L2CacheSpeed'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>L3 Cache Size</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['L3CacheSize']) ? $asset[0]['data']['Processor'][$x]['L3CacheSize'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>L3 Cache Speed</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['L3CacheSpeed']) ? $asset[0]['data']['Processor'][$x]['L3CacheSpeed'] : $no_data_message) ?></td></tr>
                                                                        <tr><td># Cores</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['NumberOfCores']) ? $asset[0]['data']['Processor'][$x]['NumberOfCores'] : $no_data_message) ?></td></tr>
                                                                        <tr><td># Logical Processors</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['NumberOfLogicalProcessors']) ? $asset[0]['data']['Processor'][$x]['NumberOfLogicalProcessors'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Processor Type</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['ProcessorType']) ? $processor_processor_type[$asset[0]['data']['Processor'][$x]['ProcessorType']] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Revision</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['Revision']) ? $asset[0]['data']['Processor'][$x]['Revision'] : $no_data_message) ?></td></tr>
                                                                        <tr><td>Upgrade Method</td><td><?php echo(isset($asset[0]['data']['Processor'][$x]['UpgradeMethod']) ? (isset($processor_upgrade_method[$asset[0]['data']['Processor'][$x]['UpgradeMethod']]) ? $processor_family[$asset[0]['data']['Processor'][$x]['UpgradeMethod']] : $asset[0]['data']['Processor'][$x]['UpgradeMethod']) : $no_data_message) ?></td></tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php 

                                                    if ($col_cnt == 12){
                                                        echo  '</div>';
                                                        $col_cnt = 0;    
                                                    }

                                                }

                                                if ($col_cnt <> 0){
                                                    echo  '</div>';
                                                    $col_cnt = 0;    
                                                }
                                                        
                                                }else{
                                                    
                                            ?>

                                                <div class="row row-buffer">
                                                    <div class="col-sm-4">
                                                        <div class="card">
                                                            <div class="card-body">  
                                                                <h6 class="card-title">Processor<img width="48" height="48" src="<?php echo base_url() . '/assets/img/cpu.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                <p class="card-text"><?php echo $asset[0]['data']['Processor']['Name'] ?></p>
                                                                <div class="table-responsive">
                                                                    <table class="table-hover table-sm main-table">
                                                                        <tbody>
                                                                            <tr><td>Description</td><td><?php echo(isset($asset[0]['data']['Processor']['Description']) ? $asset[0]['data']['Processor']['Description'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['Processor']['Manufacturer']) ? $asset[0]['data']['Processor']['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Processor Id</td><td><?php echo(isset($asset[0]['data']['Processor']['ProcessorId']) ? $asset[0]['data']['Processor']['ProcessorId'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Socket Designation</td><td><?php echo(isset($asset[0]['data']['Processor']['SocketDesignation']) ? $asset[0]['data']['Processor']['SocketDesignation'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Address Width</td><td><?php echo(isset($asset[0]['data']['Processor']['AddressWidth']) ? $asset[0]['data']['Processor']['AddressWidth'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Architecture</td><td><?php echo(isset($asset[0]['data']['Processor']['Architecture']) ? (isset($processor_architecture[$asset[0]['data']['Processor']['Architecture']]) ? $processor_architecture[$asset[0]['data']['Processor']['Architecture']] : $asset[0]['data']['Processor']['Architecture']) : $no_data_message) ?></td></tr>
                                                                            <tr><td>Availability</td><td><?php echo(isset($asset[0]['data']['Processor']['Availability']) ? (isset($processor_availability[$asset[0]['data']['Processor']['Availability']]) ? $processor_availability[$asset[0]['data']['Processor']['Availability']] : $asset[0]['data']['Processor']['Availability']) : $no_data_message) ?></td></tr>
                                                                            <tr><td>Cpu Status</td><td><?php echo(isset($asset[0]['data']['Processor']['CpuStatus']) ? (isset($processor_cpu_status[$asset[0]['data']['Processor']['CpuStatus']]) ? $processor_cpu_status[$asset[0]['data']['Processor']['CpuStatus']] : $asset[0]['data']['Processor']['CpuStatus']) : $no_data_message) ?></td></tr>
                                                                            <tr><td>Data Width</td><td><?php echo(isset($asset[0]['data']['Processor']['DataWidth']) ? $asset[0]['data']['Processor']['DataWidth'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Device ID</td><td><?php echo(isset($asset[0]['data']['Processor']['DeviceID']) ? $asset[0]['data']['Processor']['DeviceID'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Ext Clock</td><td><?php echo(isset($asset[0]['data']['Processor']['ExtClock']) ? $asset[0]['data']['Processor']['ExtClock'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Family</td><td><?php echo(isset($asset[0]['data']['Processor']['Family']) ? (isset($processor_family[$asset[0]['data']['Processor']['Family']]) ? $processor_family[$asset[0]['data']['Processor']['Family']] : $asset[0]['data']['Processor']['Family']) : $no_data_message) ?></td></tr>
                                                                            <tr><td>Max Clock Speed</td><td><?php echo(isset($asset[0]['data']['Processor']['MaxClockSpeed']) ? $asset[0]['data']['Processor']['MaxClockSpeed'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>L2 Cache Size</td><td><?php echo(isset($asset[0]['data']['Processor']['L2CacheSize']) ? $asset[0]['data']['Processor']['L2CacheSize'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>L2 Cache Speed</td><td><?php echo(isset($asset[0]['data']['Processor']['L2CacheSpeed']) ? $asset[0]['data']['Processor']['L2CacheSpeed'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>L3 Cache Size</td><td><?php echo(isset($asset[0]['data']['Processor']['L3CacheSize']) ? $asset[0]['data']['Processor']['L3CacheSize'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>L3 Cache Speed</td><td><?php echo(isset($asset[0]['data']['Processor']['L3CacheSpeed']) ? $asset[0]['data']['Processor']['L3CacheSpeed'] : $no_data_message) ?></td></tr>
                                                                            <tr><td># Cores</td><td><?php echo(isset($asset[0]['data']['Processor']['NumberOfCores']) ? $asset[0]['data']['Processor']['NumberOfCores'] : $no_data_message) ?></td></tr>
                                                                            <tr><td># Logical Processors</td><td><?php echo(isset($asset[0]['data']['Processor']['NumberOfLogicalProcessors']) ? $asset[0]['data']['Processor']['NumberOfLogicalProcessors'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Processor Type</td><td><?php echo(isset($asset[0]['data']['Processor']['ProcessorType']) ? $processor_processor_type[$asset[0]['data']['Processor']['ProcessorType']] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Revision</td><td><?php echo(isset($asset[0]['data']['Processor']['Revision']) ? $asset[0]['data']['Processor']['Revision'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Upgrade Method</td><td><?php echo(isset($asset[0]['data']['Processor']['UpgradeMethod']) ? (isset($processor_upgrade_method[$asset[0]['data']['Processor']['UpgradeMethod']]) ? $processor_family[$asset[0]['data']['Processor']['UpgradeMethod']] : $asset[0]['data']['Processor']['UpgradeMethod']) : $no_data_message) ?></td></tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php }} else { ?>

                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-body">  
                                                            <h6 class="card-title">Processor<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                            <p class="card-text">No information available</p>                                                                                    
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>
                                                                                                
                                        </div>
                                                                                
                                        <div class="menu-content memory">

                                            <div class="inner-tab">

                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#memory"><img class="device-img" src="<?php echo base_url() . '/assets/img/ram.png' ?>">Memory</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#memoryarray"><img class="device-img" src="<?php echo base_url() . '/assets/img/memarr.png' ?>">Memory Array</a></li>                                                       
                                                </ul>

                                            </div>  

                                            <!-- Tab panes -->
                                            <div class="tab-content">

                                                <div id="memory" class="tab-pane active">

                                                    <!-- Physical Memory -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['PhysicalMemory'])){

                                                            if (isset($asset[0]['data']['PhysicalMemory'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['PhysicalMemory']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Memory <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/ram.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>
                                                                                <tr><td>Device Locator</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['DeviceLocator']) ? $asset[0]['data']['PhysicalMemory'][$x]['DeviceLocator'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Capacity</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['Capacity']) ? $this->utility->format_bytes($asset[0]['data']['PhysicalMemory'][$x]['Capacity']) : $no_data_message) ?></td></tr>
                                                                                <tr><td>Position In Row</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['PositionInRow']) ? $asset[0]['data']['PhysicalMemory'][$x]['PositionInRow'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Data Width</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['DataWidth']) ? $asset[0]['data']['PhysicalMemory'][$x]['DataWidth'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Form Factor</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['FormFactor']) ? (isset($physical_memory_form_factor[$asset[0]['data']['PhysicalMemory'][$x]['FormFactor']]) ? $physical_memory_form_factor[$asset[0]['data']['PhysicalMemory'][$x]['FormFactor']] : $asset[0]['data']['PhysicalMemory'][$x]['FormFactor']) : $no_data_message) ?></td></tr>
                                                                                <tr><td>Interleave Data Depth</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['InterleaveDataDepth']) ? $asset[0]['data']['PhysicalMemory'][$x]['InterleaveDataDepth'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Interleave Position</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['InterleavePosition']) ? (isset($physical_memory_interleave_position[$asset[0]['data']['PhysicalMemory'][$x]['InterleavePosition']]) ? $physical_memory_interleave_position[$asset[0]['data']['PhysicalMemory'][$x]['InterleavePosition']] : $asset[0]['data']['PhysicalMemory'][$x]['InterleavePosition']) : $no_data_message) ?></td></tr>
                                                                                <tr><td>Speed</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['Speed']) ? $asset[0]['data']['PhysicalMemory'][$x]['Speed'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Memory Type</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['MemoryType']) ? (isset($physical_memory_memory_type[$asset[0]['data']['PhysicalMemory'][$x]['MemoryType']]) ? $physical_memory_memory_type[$asset[0]['data']['PhysicalMemory'][$x]['MemoryType']] : $asset[0]['data']['PhysicalMemory'][$x]['MemoryType']) : $no_data_message) ?></td></tr>
                                                                                <tr><td>Total Width</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['TotalWidth']) ? $asset[0]['data']['PhysicalMemory'][$x]['TotalWidth'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Type Detail</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory'][$x]['TypeDetail']) ? (isset($physical_memory_type_detail[$asset[0]['data']['PhysicalMemory'][$x]['TypeDetail']]) ? $physical_memory_type_detail[$asset[0]['data']['PhysicalMemory'][$x]['TypeDetail']] : $asset[0]['data']['PhysicalMemory'][$x]['TypeDetail']) : $no_data_message) ?></td></tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Memory<img width="48" height="48" src="<?php echo base_url() . '/assets/img/ram.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>
                                                                                    <tr><td>Device Locator</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['DeviceLocator']) ? $asset[0]['data']['PhysicalMemory']['DeviceLocator'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Capacity</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['Capacity']) ? $this->utility->format_bytes($asset[0]['data']['PhysicalMemory']['Capacity']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Position In Row</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['PositionInRow']) ? $asset[0]['data']['PhysicalMemory']['PositionInRow'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Data Width</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['DataWidth']) ? $asset[0]['data']['PhysicalMemory']['DataWidth'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Form Factor</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['FormFactor']) ? (isset($physical_memory_form_factor[$asset[0]['data']['PhysicalMemory']['FormFactor']]) ? $physical_memory_form_factor[$asset[0]['data']['PhysicalMemory']['FormFactor']] : $asset[0]['data']['PhysicalMemory']['FormFactor']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Interleave Data Depth</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['InterleaveDataDepth']) ? $asset[0]['data']['PhysicalMemory']['InterleaveDataDepth'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Interleave Position</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['InterleavePosition']) ? (isset($physical_memory_interleave_position[$asset[0]['data']['PhysicalMemory']['InterleavePosition']]) ? $physical_memory_interleave_position[$asset[0]['data']['PhysicalMemory']['InterleavePosition']] : $asset[0]['data']['PhysicalMemory']['InterleavePosition']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Speed</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['Speed']) ? $asset[0]['data']['PhysicalMemory']['Speed'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Memory Type</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['MemoryType']) ? (isset($physical_memory_memory_type[$asset[0]['data']['PhysicalMemory']['MemoryType']]) ? $physical_memory_memory_type[$asset[0]['data']['PhysicalMemory']['MemoryType']] : $asset[0]['data']['PhysicalMemory']['MemoryType']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Total Width</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['TotalWidth']) ? $asset[0]['data']['PhysicalMemory']['TotalWidth'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Type Detail</td><td><?php echo(isset($asset[0]['data']['PhysicalMemory']['TypeDetail']) ? (isset($physical_memory_type_detail[$asset[0]['data']['PhysicalMemory']['TypeDetail']]) ? $physical_memory_type_detail[$asset[0]['data']['PhysicalMemory']['TypeDetail']] : $asset[0]['data']['PhysicalMemory']['TypeDetail']) : $no_data_message) ?></td></tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="col-sm-3">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Memory<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text">No information available</p>                                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                    
                                                </div>

                                                <div id="memoryarray" class="tab-pane fade">
                                                
                                                    <!-- Memory Array -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['PhysicalMemoryArray'])){

                                                            if (isset($asset[0]['data']['PhysicalMemoryArray'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['PhysicalMemoryArray']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Memory Array <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/memarr.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>                                                                            
                                                                                <tr><td>Location</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray'][$x]['Location']) ? (isset($physical_memory_array_location[$asset[0]['data']['PhysicalMemoryArray'][$x]['Location']]) ? $physical_memory_array_location[$asset[0]['data']['PhysicalMemoryArray'][$x]['Location']] : $asset[0]['data']['PhysicalMemoryArray'][$x]['Location']) : $no_data_message) ?></td></tr>                                                                                                                                                        
                                                                                <tr><td># Memory Slots</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray'][$x]['MemoryDevices']) ? $asset[0]['data']['PhysicalMemoryArray'][$x]['MemoryDevices'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Memory Error Correction</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray'][$x]['MemoryErrorCorrection']) ? (isset($physical_memory_array_memory_error_correction[$asset[0]['data']['PhysicalMemoryArray'][$x]['MemoryErrorCorrection']]) ? $physical_memory_array_memory_error_correction[$asset[0]['data']['PhysicalMemoryArray'][$x]['MemoryErrorCorrection']] : $asset[0]['data']['PhysicalMemoryArray'][$x]['MemoryErrorCorrection']) : $no_data_message) ?></td></tr>                                                                                                                                                
                                                                                <tr><td>Tag</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray'][$x]['Tag']) ? $asset[0]['data']['PhysicalMemoryArray'][$x]['Tag'] : $no_data_message) ?></td></tr>                                                                            
                                                                                <tr><td>Use</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray'][$x]['Use']) ? (isset($physical_memory_array_use[$asset[0]['data']['PhysicalMemoryArray'][$x]['Use']]) ? $physical_memory_array_use[$asset[0]['data']['PhysicalMemoryArray'][$x]['Use']] : $asset[0]['data']['PhysicalMemoryArray'][$x]['Use']) : $no_data_message) ?></td></tr>                                                                            
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                            if ($col_cnt == 12){
                                                                echo  '</div>';
                                                                $col_cnt = 0;    
                                                            }

                                                        }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Memory Array<img width="48" height="48" src="<?php echo base_url() . '/assets/img/memarr.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>                                                                            
                                                                                    <tr><td>Location</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray']['Location']) ? (isset($physical_memory_array_location[$asset[0]['data']['PhysicalMemoryArray']['Location']]) ? $physical_memory_array_location[$asset[0]['data']['PhysicalMemoryArray']['Location']] : $asset[0]['data']['PhysicalMemoryArray']['Location']) : $no_data_message) ?></td></tr>                                                                                                                                                            
                                                                                    <tr><td># Memory Slots</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray']['MemoryDevices']) ? $asset[0]['data']['PhysicalMemoryArray']['MemoryDevices'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Memory Error Correction</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray']['MemoryErrorCorrection']) ? (isset($physical_memory_array_memory_error_correction[$asset[0]['data']['PhysicalMemoryArray']['MemoryErrorCorrection']]) ? $physical_memory_array_memory_error_correction[$asset[0]['data']['PhysicalMemoryArray']['MemoryErrorCorrection']] : $asset[0]['data']['PhysicalMemoryArray']['MemoryErrorCorrection']) : $no_data_message) ?></td></tr>                                                                                                                                                
                                                                                    <tr><td>Tag</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray']['Tag']) ? $asset[0]['data']['PhysicalMemoryArray']['Tag'] : $no_data_message) ?></td></tr>                                                                            
                                                                                    <tr><td>Use</td><td><?php echo(isset($asset[0]['data']['PhysicalMemoryArray']['Use']) ? (isset($physical_memory_array_use[$asset[0]['data']['PhysicalMemoryArray']['Use']]) ? $physical_memory_array_use[$asset[0]['data']['PhysicalMemoryArray']['Use']] : $asset[0]['data']['PhysicalMemoryArray']['Use']) : $no_data_message) ?></td></tr>                                                                            
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Memory Array<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                                    
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    <?php } ?>
                                                
                                                </div>

                                            </div>

                                        </div>
                                        
                                        <div class="menu-content storage">
                                        
                                            <div class="inner-tab">

                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#localdisk"><img class="device-img" src="<?php echo base_url() . '/assets/img/localdisk.png' ?>">Local Disks</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#networkdrive"><img class="device-img" src="<?php echo base_url() . '/assets/img/networkdrive.png' ?>">Network Drives</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#partition"><img class="device-img" src="<?php echo base_url() . '/assets/img/partitions.png' ?>">Partitions</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#volume"><img class="device-img" src="<?php echo base_url() . '/assets/img/volumes.png' ?>">Volumes</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#harddisk"><img class="device-img" src="<?php echo base_url() . '/assets/img/hdd.png' ?>">Hard Disks</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dvddrive"><img class="device-img" src="<?php echo base_url() . '/assets/img/dvddrive.png' ?>">CD/DVD Drive</a></li>
                                                </ul>

                                            </div>
                                        
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                            
                                                <div id="localdisk" class="tab-pane active">
                                                    
                                                    <!-- Local Disk -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['LocalDisk'])){

                                                            if (isset($asset[0]['data']['LocalDisk'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['LocalDisk']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 3;  

                                                    ?>

                                                    <div class="col-sm-3">
                                                        <div class="card">
                                                            <div class="card-body">  
                                                                <h6 class="card-title"><?php echo(!empty($asset[0]['data']['LocalDisk'][$x]['VolumeName']) ? $asset[0]['data']['LocalDisk'][$x]['VolumeName'] : $asset[0]['data']['LocalDisk'][$x]['Description']) ?><?php echo(isset($asset[0]['data']['LocalDisk'][$x]['DeviceID']) ? ' (' . $asset[0]['data']['LocalDisk'][$x]['DeviceID'] . ')' : $no_data_message) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/localdisk.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                <p class="card-text"><?php echo(isset($asset[0]['data']['LocalDisk'][$x]['DriveType']) ? (isset($logical_disk_drive_type[$asset[0]['data']['LocalDisk'][$x]['DriveType']]) ? $logical_disk_drive_type[$asset[0]['data']['LocalDisk'][$x]['DriveType']] : $asset[0]['data']['LocalDisk'][$x]['DriveType']) : $no_data_message) ?></p>                                                                        
                                                                                                        
                                                                <?php
                                                                    $FreePercent = round(($asset[0]['data']['LocalDisk'][$x]['FreeSpace'] / $asset[0]['data']['LocalDisk'][$x]['Size']) * 100);
                                                                    $FilledPercent = 100-$FreePercent;
                                                                ?>
                                                                
                                                                <div class="progress_bar fadeIn">
                                                                    <div class="progress_holder">
                                                                        <div class="progress_bar_title"><?php echo $this->utility->format_bytes($asset[0]['data']['LocalDisk'][$x]['FreeSpace']) . ' free of ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk'][$x]['Size']) ?></div>
                                                                        <div class="progress_number"><?php echo $FilledPercent . '%' ?></div>
                                                                    </div>
                                                                    <div class="progress_bar_holder">
                                                                        <div class="progress_bar_content" style="<?php echo 'width: ' . $FilledPercent  . '%; background:' . ($FreePercent <= 10 ? '#D20000' : '#26A0DA') .';' ?>" data-score="<?php echo $FilledPercent ?>"></div>
                                                                    </div>
                                                                </div>  

                                                                <p class="card-text"><?php echo(isset($asset[0]['data']['LocalDisk'][$x]['FileSystem']) ? $asset[0]['data']['LocalDisk'][$x]['FileSystem'] : '') ?><?php echo(isset($asset[0]['data']['LocalDisk'][$x]['VolumeSerialNumber']) ? ' - ' . $asset[0]['data']['LocalDisk'][$x]['VolumeSerialNumber'] : '') ?></p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title"><?php echo(!empty($asset[0]['data']['LocalDisk']['VolumeName']) ? $asset[0]['data']['LocalDisk']['VolumeName'] : $asset[0]['data']['LocalDisk']['Description']) ?><?php echo(isset($asset[0]['data']['LocalDisk']['DeviceID']) ? ' (' . $asset[0]['data']['LocalDisk']['DeviceID'] . ')' : $no_data_message) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/localdisk.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo(isset($asset[0]['data']['LocalDisk']['DriveType']) ? (isset($logical_disk_drive_type[$asset[0]['data']['LocalDisk']['DriveType']]) ? $logical_disk_drive_type[$asset[0]['data']['LocalDisk']['DriveType']] : $asset[0]['data']['LocalDisk']['DriveType']) : $no_data_message) ?></p>                                                                        
                                                                                                                
                                                                        <?php
                                                                            $FreePercent = round(($asset[0]['data']['LocalDisk']['FreeSpace'] / $asset[0]['data']['LocalDisk']['Size']) * 100);
                                                                            $FilledPercent = 100-$FreePercent;
                                                                        ?>
                                                                        
                                                                        <div class="progress_bar fadeIn">
                                                                            <div class="progress_holder">
                                                                                <div class="progress_bar_title"><?php echo $this->utility->format_bytes($asset[0]['data']['LocalDisk']['FreeSpace']) . ' free of ' . $this->utility->format_bytes($asset[0]['data']['LocalDisk']['Size']) ?></div>
                                                                                <div class="progress_number"><?php echo $FilledPercent . '%' ?></div>
                                                                            </div>
                                                                            <div class="progress_bar_holder">
                                                                                <div class="progress_bar_content" style="<?php echo 'width: ' . $FilledPercent  . '%; background:' . ($FreePercent <= 10 ? '#D20000' : '#26A0DA') .';' ?>" data-score="<?php echo $FilledPercent ?>"></div>
                                                                            </div>
                                                                        </div>  

                                                                        <p class="card-text"><?php echo(isset($asset[0]['data']['LocalDisk']['FileSystem']) ? $asset[0]['data']['LocalDisk']['FileSystem'] : '') ?><?php echo(isset($asset[0]['data']['LocalDisk']['VolumeSerialNumber']) ? ' - ' . $asset[0]['data']['LocalDisk']['VolumeSerialNumber'] : '') ?></p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Local Disk<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                                                                        
                                                </div>

                                                <div id="networkdrive" class="tab-pane fade">
                                                
                                                    <!-- Network Drive -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['NetworkDrive'])){

                                                            if (isset($asset[0]['data']['NetworkDrive'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['NetworkDrive']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 3;  

                                                    ?>

                                                        <div class="col-sm-3">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title"><?php echo(isset($asset[0]['data']['NetworkDrive'][$x]['ProviderName']) ? $asset[0]['data']['NetworkDrive'][$x]['ProviderName'] : $asset[0]['data']['NetworkDrive'][$x]['Description']) ?><?php echo(isset($asset[0]['data']['NetworkDrive'][$x]['DeviceID']) ? ' (' . $asset[0]['data']['NetworkDrive'][$x]['DeviceID'] . ')' : $no_data_message) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/networkdrive.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo(isset($asset[0]['data']['NetworkDrive'][$x]['DriveType']) ? (isset($logical_disk_drive_type[$asset[0]['data']['NetworkDrive'][$x]['DriveType']]) ? $logical_disk_drive_type[$asset[0]['data']['NetworkDrive'][$x]['DriveType']] : $asset[0]['data']['NetworkDrive'][$x]['DriveType']) : $no_data_message) ?></p>                                                                        
                                                                                                            
                                                                    <?php
                                                                        $FreePercent = round(($asset[0]['data']['NetworkDrive'][$x]['FreeSpace'] / $asset[0]['data']['NetworkDrive'][$x]['Size']) * 100);
                                                                        $FilledPercent = 100-$FreePercent;
                                                                    ?>
                                                                    
                                                                    <div class="progress_bar fadeIn">
                                                                        <div class="progress_holder">
                                                                            <div class="progress_bar_title"><?php echo $this->utility->format_bytes($asset[0]['data']['NetworkDrive'][$x]['FreeSpace']) . ' free of ' . $this->utility->format_bytes($asset[0]['data']['NetworkDrive'][$x]['Size']) ?></div>
                                                                            <div class="progress_number"><?php echo $FilledPercent . '%' ?></div>
                                                                        </div>
                                                                        <div class="progress_bar_holder">
                                                                            <div class="progress_bar_content" style="<?php echo 'width: ' . $FilledPercent  . '%; background:' . ($FreePercent <= 10 ? '#D20000' : '#26A0DA') .';' ?>" data-score="<?php echo $FilledPercent ?>"></div>
                                                                        </div>
                                                                    </div>  

                                                                    <p class="card-text"><?php echo(isset($asset[0]['data']['NetworkDrive'][$x]['FileSystem']) ? $asset[0]['data']['NetworkDrive'][$x]['FileSystem'] : '') ?><?php echo(isset($asset[0]['data']['NetworkDrive'][$x]['VolumeSerialNumber']) ? ' - ' . $asset[0]['data']['NetworkDrive'][$x]['VolumeSerialNumber'] : '') ?></p>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title"><?php echo(isset($asset[0]['data']['NetworkDrive']['ProviderName']) ? $asset[0]['data']['NetworkDrive']['ProviderName'] : $asset[0]['data']['NetworkDrive']['Description']) ?><?php echo(isset($asset[0]['data']['NetworkDrive']['DeviceID']) ? ' (' . $asset[0]['data']['NetworkDrive']['DeviceID'] . ')' : $no_data_message) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/localdisk.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo(isset($asset[0]['data']['NetworkDrive']['DriveType']) ? (isset($logical_disk_drive_type[$asset[0]['data']['NetworkDrive']['DriveType']]) ? $logical_disk_drive_type[$asset[0]['data']['NetworkDrive']['DriveType']] : $asset[0]['data']['NetworkDrive']['DriveType']) : $no_data_message) ?></p>                                                                        
                                                                                                                
                                                                        <?php
                                                                            $FreePercent = round(($asset[0]['data']['NetworkDrive']['FreeSpace'] / $asset[0]['data']['NetworkDrive']['Size']) * 100);
                                                                            $FilledPercent = 100-$FreePercent;
                                                                        ?>
                                                                        
                                                                        <div class="progress_bar fadeIn">
                                                                            <div class="progress_holder">
                                                                                <div class="progress_bar_title"><?php echo $this->utility->format_bytes($asset[0]['data']['NetworkDrive']['FreeSpace']) . ' free of ' . $this->utility->format_bytes($asset[0]['data']['NetworkDrive']['Size']) ?></div>
                                                                                <div class="progress_number"><?php echo $FilledPercent . '%' ?></div>
                                                                            </div>
                                                                            <div class="progress_bar_holder">
                                                                                <div class="progress_bar_content" style="<?php echo 'width: ' . $FilledPercent  . '%; background:' . ($FreePercent <= 10 ? '#D20000' : '#26A0DA') .';' ?>" data-score="<?php echo $FilledPercent ?>"></div>
                                                                            </div>
                                                                        </div>  

                                                                        <p class="card-text"><?php echo(isset($asset[0]['data']['NetworkDrive']['FileSystem']) ? $asset[0]['data']['NetworkDrive']['FileSystem'] : '') ?><?php echo(isset($asset[0]['data']['NetworkDrive']['VolumeSerialNumber']) ? ' - ' . $asset[0]['data']['NetworkDrive']['VolumeSerialNumber'] : '') ?></p>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Network Drive<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>


                                                </div>

                                                <div id="partition" class="tab-pane fade">
                                                
                                                    <!-- Disk Partition -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['DiskPartition'])){

                                                            if (isset($asset[0]['data']['DiskPartition'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['DiskPartition']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Disk Partition <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/partitions.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['data']['DiskPartition'][$x]['Caption'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>                                                                                                                                                                                                                           
                                                                                <tr><td>Block Size</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['BlockSize']) ? $asset[0]['data']['DiskPartition'][$x]['BlockSize'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Bootable</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['Bootable']) ? ($asset[0]['data']['DiskPartition'][$x]['Bootable'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                <tr><td>Boot Partition</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['BootPartition']) ? ($asset[0]['data']['DiskPartition'][$x]['BootPartition'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                <tr><td>Disk Index</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['DiskIndex']) ? $asset[0]['data']['DiskPartition'][$x]['DiskIndex'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Index</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['Index']) ? $asset[0]['data']['DiskPartition'][$x]['Index'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Number of Blocks</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['NumberOfBlocks']) ? $asset[0]['data']['DiskPartition'][$x]['NumberOfBlocks'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Primary Partition</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['PrimaryPartition']) ? ($asset[0]['data']['DiskPartition'][$x]['PrimaryPartition'] ? 'True' : 'False') : $no_data_message) ?></td></tr>                                                                                
                                                                                <tr><td>Size</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['Size']) ? $this->utility->format_bytes($asset[0]['data']['DiskPartition'][$x]['Size']) : $no_data_message) ?></td></tr>
                                                                                <tr><td>Starting Offset</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['StartingOffset']) ? $asset[0]['data']['DiskPartition'][$x]['StartingOffset'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Type</td><td><?php echo(isset($asset[0]['data']['DiskPartition'][$x]['Type']) ? $asset[0]['data']['DiskPartition'][$x]['Type'] : $no_data_message) ?></td></tr>                                                                               
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Disk Partition<img width="48" height="48" src="<?php echo base_url() . '/assets/img/partitions.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['data']['DiskPartition']['Caption'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>                                                                                                                                                                                                                           
                                                                                    <tr><td>Block Size</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['BlockSize']) ? $asset[0]['data']['DiskPartition']['BlockSize'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Bootable</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['Bootable']) ? ($asset[0]['data']['DiskPartition']['Bootable'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Boot Partition</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['BootPartition']) ? ($asset[0]['data']['DiskPartition']['BootPartition'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Disk Index</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['DiskIndex']) ? $asset[0]['data']['DiskPartition']['DiskIndex'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Index</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['Index']) ? $asset[0]['data']['DiskPartition']['Index'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Number of Blocks</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['NumberOfBlocks']) ? $asset[0]['data']['DiskPartition']['NumberOfBlocks'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Primary Partition</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['PrimaryPartition']) ? ($asset[0]['data']['DiskPartition']['PrimaryPartition'] ? 'True' : 'False') : $no_data_message) ?></td></tr>                                                                                
                                                                                    <tr><td>Size</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['Size']) ? $this->utility->format_bytes($asset[0]['data']['DiskPartition']['Size']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Starting Offset</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['StartingOffset']) ? $asset[0]['data']['DiskPartition']['StartingOffset'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Type</td><td><?php echo(isset($asset[0]['data']['DiskPartition']['Type']) ? $asset[0]['data']['DiskPartition']['Type'] : $no_data_message) ?></td></tr>                                                                               
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Disk Partition<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                    
                                                </div>

                                                <div id="volume" class="tab-pane fade">
                                                
                                                    <!-- Volume -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['Volume'])){

                                                            if (isset($asset[0]['data']['Volume'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['Volume']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                    <div class="col-sm-4">
                                                        <div class="card">
                                                            <div class="card-body">  
                                                                <h6 class="card-title">Volume <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/volumes.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                <p class="card-text"><?php echo $asset[0]['data']['Volume'][$x]['DeviceID'] ?></p>
                                                                <div class="table-responsive">
                                                                    <table class="table-hover table-sm main-table">
                                                                        <tbody>                                                                                                                                                                                                                                    
                                                                            <tr><td>Drive Letter</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['DriveLetter']) ? $asset[0]['data']['Volume'][$x]['DriveLetter'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Label</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['Label']) ? $asset[0]['data']['Volume'][$x]['Label'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Block Size</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['BlockSize']) ? $asset[0]['data']['Volume'][$x]['BlockSize'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Capacity</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['Capacity']) ? $this->utility->format_bytes($asset[0]['data']['Volume'][$x]['Capacity']) : $no_data_message) ?></td></tr>
                                                                            <tr><td>Free Space</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['FreeSpace']) ? $this->utility->format_bytes($asset[0]['data']['Volume'][$x]['FreeSpace']) : $no_data_message) ?></td></tr>
                                                                            <tr><td>Compressed</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['Compressed']) ? ($asset[0]['data']['Volume'][$x]['Compressed'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                            <tr><td>Dirty Bit Set</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['DirtyBitSet']) ? ($asset[0]['data']['Volume'][$x]['DirtyBitSet'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                            <tr><td>Drive Type</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['DriveType']) ? $asset[0]['data']['Volume'][$x]['DriveType'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>File System</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['FileSystem']) ? $asset[0]['data']['Volume'][$x]['FileSystem'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Indexing Enabled</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['IndexingEnabled']) ? ($asset[0]['data']['Volume'][$x]['IndexingEnabled'] ? 'True' : 'False') : $no_data_message) ?></td></tr>                                                                                
                                                                            <tr><td>Page File Present</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['PageFilePresent']) ? ($asset[0]['data']['Volume'][$x]['PageFilePresent'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                            <tr><td>Supports Disk Quotas</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['SupportsDiskQuotas']) ? ($asset[0]['data']['Volume'][$x]['SupportsDiskQuotas'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                            <tr><td>Supports File Based Compression</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['SupportsFileBasedCompression']) ? ($asset[0]['data']['Volume'][$x]['SupportsFileBasedCompression'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                            <tr><td>Auto mount</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['Automount']) ? ($asset[0]['data']['Volume'][$x]['Automount'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                            <tr><td>Error Cleared</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['ErrorCleared']) ? $asset[0]['data']['Volume'][$x]['ErrorCleared'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Error Description</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['ErrorDescription']) ? $asset[0]['data']['Volume'][$x]['ErrorDescription'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Error Methodology</td><td><?php echo(isset($asset[0]['data']['Volume'][$x]['ErrorMethodology']) ? $asset[0]['data']['Volume'][$x]['ErrorMethodology'] : $no_data_message) ?></td></tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Volume<img width="48" height="48" src="<?php echo base_url() . '/assets/img/volumes.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['data']['Volume']['DeviceID'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>                                                                                                                                                                                                                                    
                                                                                    <tr><td>Drive Letter</td><td><?php echo(isset($asset[0]['data']['Volume']['DriveLetter']) ? $asset[0]['data']['Volume']['DriveLetter'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Label</td><td><?php echo(isset($asset[0]['data']['Volume']['Label']) ? $asset[0]['data']['Volume']['Label'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Block Size</td><td><?php echo(isset($asset[0]['data']['Volume']['BlockSize']) ? $asset[0]['data']['Volume']['BlockSize'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Capacity</td><td><?php echo(isset($asset[0]['data']['Volume']['Capacity']) ? $this->utility->format_bytes($asset[0]['data']['Volume']['Capacity']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Free Space</td><td><?php echo(isset($asset[0]['data']['Volume']['FreeSpace']) ? $this->utility->format_bytes($asset[0]['data']['Volume']['FreeSpace']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Compressed</td><td><?php echo(isset($asset[0]['data']['Volume']['Compressed']) ? ($asset[0]['data']['Volume']['Compressed'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Dirty Bit Set</td><td><?php echo(isset($asset[0]['data']['Volume']['DirtyBitSet']) ? ($asset[0]['data']['Volume']['DirtyBitSet'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Drive Type</td><td><?php echo(isset($asset[0]['data']['Volume']['DriveType']) ? $asset[0]['data']['Volume']['DriveType'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>File System</td><td><?php echo(isset($asset[0]['data']['Volume']['FileSystem']) ? $asset[0]['data']['Volume']['FileSystem'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Indexing Enabled</td><td><?php echo(isset($asset[0]['data']['Volume']['IndexingEnabled']) ? ($asset[0]['data']['Volume']['IndexingEnabled'] ? 'True' : 'False') : $no_data_message) ?></td></tr>                                                                                
                                                                                    <tr><td>Page File Present</td><td><?php echo(isset($asset[0]['data']['Volume']['PageFilePresent']) ? ($asset[0]['data']['Volume']['PageFilePresent'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Supports Disk Quotas</td><td><?php echo(isset($asset[0]['data']['Volume']['SupportsDiskQuotas']) ? ($asset[0]['data']['Volume']['SupportsDiskQuotas'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Supports File Based Compression</td><td><?php echo(isset($asset[0]['data']['Volume']['SupportsFileBasedCompression']) ? ($asset[0]['data']['Volume']['SupportsFileBasedCompression'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Auto mount</td><td><?php echo(isset($asset[0]['data']['Volume']['Automount']) ? ($asset[0]['data']['Volume']['Automount'] ? 'True' : 'False') : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Error Cleared</td><td><?php echo(isset($asset[0]['data']['Volume']['ErrorCleared']) ? $asset[0]['data']['Volume']['ErrorCleared'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Error Description</td><td><?php echo(isset($asset[0]['data']['Volume']['ErrorDescription']) ? $asset[0]['data']['Volume']['ErrorDescription'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Error Methodology</td><td><?php echo(isset($asset[0]['data']['Volume']['ErrorMethodology']) ? $asset[0]['data']['Volume']['ErrorMethodology'] : $no_data_message) ?></td></tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Volume<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                </div>

                                                <div id="harddisk" class="tab-pane fade">

                                                    <!-- Physical Disk -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['DiskDrive'])){

                                                            if (isset($asset[0]['data']['DiskDrive'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['DiskDrive']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Hard Disk <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/hdd.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['data']['DiskDrive'][$x]['Name'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>                                                                                                                                                                                                                                    
                                                                                <tr><td>Serial #</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['SerialNumber']) ? $asset[0]['data']['DiskDrive'][$x]['SerialNumber'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Status</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['Status']) ? $asset[0]['data']['DiskDrive'][$x]['Status'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Bytes Per Sector</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['BytesPerSector']) ? $asset[0]['data']['DiskDrive'][$x]['BytesPerSector'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Interface Type</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['InterfaceType']) ? $asset[0]['data']['DiskDrive'][$x]['InterfaceType'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['Manufacturer']) ? $asset[0]['data']['DiskDrive'][$x]['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Model</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['Model']) ? $asset[0]['data']['DiskDrive'][$x]['Model'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Partitions</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['Partitions']) ? $asset[0]['data']['DiskDrive'][$x]['Partitions'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Sectors Per Track</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['SectorsPerTrack']) ? $asset[0]['data']['DiskDrive'][$x]['SectorsPerTrack'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Size</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['Size']) ? $this->utility->format_bytes($asset[0]['data']['DiskDrive'][$x]['Size']) : $no_data_message) ?></td></tr>
                                                                                <tr><td>Total Cylinders</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['TotalCylinders']) ? $asset[0]['data']['DiskDrive'][$x]['TotalCylinders'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Total Heads</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['TotalHeads']) ? $asset[0]['data']['DiskDrive'][$x]['TotalHeads'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Total Sectors</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['TotalSectors']) ? $asset[0]['data']['DiskDrive'][$x]['TotalSectors'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Total Tracks</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['TotalTracks']) ? $asset[0]['data']['DiskDrive'][$x]['TotalTracks'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Tracks Per Cylinder</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['TracksPerCylinder']) ? $asset[0]['data']['DiskDrive'][$x]['TracksPerCylinder'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Firmware Revision</td><td><?php echo(isset($asset[0]['data']['DiskDrive'][$x]['FirmwareRevision']) ? $asset[0]['data']['DiskDrive'][$x]['FirmwareRevision'] : $no_data_message) ?></td></tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Hard Disk<img width="48" height="48" src="<?php echo base_url() . '/assets/img/hdd.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['data']['DiskDrive']['Name'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>                                                                                                                                                                                                                                            
                                                                                    <tr><td>Serial #</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['SerialNumber']) ? $asset[0]['data']['DiskDrive']['SerialNumber'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Status</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['Status']) ? $asset[0]['data']['DiskDrive']['Status'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Bytes Per Sector</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['BytesPerSector']) ? $asset[0]['data']['DiskDrive']['BytesPerSector'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Interface Type</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['InterfaceType']) ? $asset[0]['data']['DiskDrive']['InterfaceType'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['Manufacturer']) ? $asset[0]['data']['DiskDrive']['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Model</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['Model']) ? $asset[0]['data']['DiskDrive']['Model'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Partitions</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['Partitions']) ? $asset[0]['data']['DiskDrive']['Partitions'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Sectors Per Track</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['SectorsPerTrack']) ? $asset[0]['data']['DiskDrive']['SectorsPerTrack'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Size</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['Size']) ? $this->utility->format_bytes($asset[0]['data']['DiskDrive']['Size']) : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Total Cylinders</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['TotalCylinders']) ? $asset[0]['data']['DiskDrive']['TotalCylinders'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Total Heads</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['TotalHeads']) ? $asset[0]['data']['DiskDrive']['TotalHeads'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Total Sectors</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['TotalSectors']) ? $asset[0]['data']['DiskDrive']['TotalSectors'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Total Tracks</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['TotalTracks']) ? $asset[0]['data']['DiskDrive']['TotalTracks'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Tracks Per Cylinder</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['TracksPerCylinder']) ? $asset[0]['data']['DiskDrive']['TracksPerCylinder'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Firmware Revision</td><td><?php echo(isset($asset[0]['data']['DiskDrive']['FirmwareRevision']) ? $asset[0]['data']['DiskDrive']['FirmwareRevision'] : $no_data_message) ?></td></tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Hard Disk<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                </div>

                                                <div id="dvddrive" class="tab-pane fade">
                                                
                                                    <!-- CD Drive -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['CDROMDrive'])){

                                                            if (isset($asset[0]['data']['CDROMDrive'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['CDROMDrive']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">CD Drive <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/dvddrive.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['data']['CDROMDrive'][$x]['Caption'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>                                                                                                                                                                                                                                    
                                                                                <tr><td>Drive</td><td><?php echo(isset($asset[0]['data']['CDROMDrive'][$x]['Drive']) ? $asset[0]['data']['CDROMDrive'][$x]['Drive'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['CDROMDrive'][$x]['Manufacturer']) ? $asset[0]['data']['CDROMDrive'][$x]['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>SCSIBus</td><td><?php echo(isset($asset[0]['data']['CDROMDrive'][$x]['SCSIBus']) ? $asset[0]['data']['CDROMDrive'][$x]['SCSIBus'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>SCSILogicalUnit</td><td><?php echo(isset($asset[0]['data']['CDROMDrive'][$x]['SCSILogicalUnit']) ? $asset[0]['data']['CDROMDrive'][$x]['SCSILogicalUnit'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>SCSIPort</td><td><?php echo(isset($asset[0]['data']['CDROMDrive'][$x]['SCSIPort']) ? $asset[0]['data']['CDROMDrive'][$x]['SCSIPort'] : $no_data_message) ?></td></tr>                                                                               
                                                                                <tr><td>SCSITargetId</td><td><?php echo(isset($asset[0]['data']['CDROMDrive'][$x]['SCSITargetId']) ? $asset[0]['data']['CDROMDrive'][$x]['SCSITargetId'] : $no_data_message) ?></td></tr>                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">CD Drive<img width="48" height="48" src="<?php echo base_url() . '/assets/img/dvddrive.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['data']['CDROMDrive']['Caption'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>                                                                                                                                                                                                                                    
                                                                                    <tr><td>Drive</td><td><?php echo(isset($asset[0]['data']['CDROMDrive']['Drive']) ? $asset[0]['data']['CDROMDrive']['Drive'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['CDROMDrive']['Manufacturer']) ? $asset[0]['data']['CDROMDrive']['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>SCSIBus</td><td><?php echo(isset($asset[0]['data']['CDROMDrive']['SCSIBus']) ? $asset[0]['data']['CDROMDrive']['SCSIBus'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>SCSILogicalUnit</td><td><?php echo(isset($asset[0]['data']['CDROMDrive']['SCSILogicalUnit']) ? $asset[0]['data']['CDROMDrive']['SCSILogicalUnit'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>SCSIPort</td><td><?php echo(isset($asset[0]['data']['CDROMDrive']['SCSIPort']) ? $asset[0]['data']['CDROMDrive']['SCSIPort'] : $no_data_message) ?></td></tr>                                                                               
                                                                                    <tr><td>SCSITargetId</td><td><?php echo(isset($asset[0]['data']['CDROMDrive']['SCSITargetId']) ? $asset[0]['data']['CDROMDrive']['SCSITargetId'] : $no_data_message) ?></td></tr>                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">CD Drive<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                </div>
                                            </div>
                                        
                                        </div>

                                        <div class="menu-content scsi">

                                            <?php 

                                                $col_cnt=0;
    
                                                if (isset($asset[0]['data']['SCSIController'])){

                                                    if (isset($asset[0]['data']['SCSIController'][0])){

                                                        for ($x = 0; $x < sizeof($asset[0]['data']['SCSIController']); $x++) {

                                            ?>

                                            <?php 

                                                if ($col_cnt == 0){
                                                    echo  '<div class="row row-buffer">';                                                      
                                                }

                                                $col_cnt += 4;  

                                            ?>

                                                <div class="col-sm-4">
                                                    <div class="card">
                                                        <div class="card-body">  
                                                            <h6 class="card-title">SCSI <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/scsicon.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                            <p class="card-text"><?php echo $asset[0]['data']['SCSIController'][$x]['Caption'] ?></p>
                                                            <div class="table-responsive">
                                                                <table class="table-hover table-sm main-table">
                                                                    <tbody>
                                                                        <tr><td>Availability</td><td><?php echo(isset($asset[0]['data']['SCSIController'][$x]['Availability']) ? (isset($scsi_controller_availability[$asset[0]['data']['SCSIController'][$x]['Availability']]) ? $scsi_controller_availability[$asset[0]['data']['SCSIController'][$x]['Availability']] : $asset[0]['data']['SCSIController'][$x]['Availability']) : $no_data_message) ?></td></tr>                                                                        
                                                                        <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['SCSIController'][$x]['Manufacturer']) ? $asset[0]['data']['SCSIController'][$x]['Manufacturer'] : $no_data_message) ?></td></tr>           
                                                                        <tr><td>Protocol Supported</td><td><?php echo(isset($asset[0]['data']['SCSIController'][$x]['ProtocolSupported']) ? (isset($scsi_controller_protocol_supported[$asset[0]['data']['SCSIController'][$x]['ProtocolSupported']]) ? $scsi_controller_protocol_supported[$asset[0]['data']['SCSIController'][$x]['ProtocolSupported']] : $asset[0]['data']['SCSIController'][$x]['ProtocolSupported']) : $no_data_message) ?></td></tr>                                                                                                                                                
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php 

                                                    if ($col_cnt == 12){
                                                        echo  '</div>';
                                                        $col_cnt = 0;    
                                                    }

                                                }

                                                if ($col_cnt <> 0){
                                                    echo  '</div>';
                                                    $col_cnt = 0;    
                                                }
                                                        
                                                }else{
                                                
                                            ?>

                                                <div class="row row-buffer">
                                                    <div class="col-sm-4">
                                                        <div class="card">
                                                            <div class="card-body">  
                                                                <h6 class="card-title">SCSI<img width="48" height="48" src="<?php echo base_url() . '/assets/img/scsicon.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                <p class="card-text"><?php echo $asset[0]['data']['SCSIController']['Caption'] ?></p>
                                                                <div class="table-responsive">
                                                                    <table class="table-hover table-sm main-table">
                                                                        <tbody>
                                                                            <tr><td>Availability</td><td><?php echo(isset($asset[0]['data']['SCSIController']['Availability']) ? (isset($scsi_controller_availability[$asset[0]['data']['SCSIController']['Availability']]) ? $scsi_controller_availability[$asset[0]['data']['SCSIController']['Availability']] : $asset[0]['data']['SCSIController']['Availability']) : $no_data_message) ?></td></tr>                                                                        
                                                                            <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['SCSIController']['Manufacturer']) ? $asset[0]['data']['SCSIController']['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Protocol Supported</td><td><?php echo(isset($asset[0]['data']['SCSIController']['ProtocolSupported']) ? (isset($scsi_controller_protocol_supported[$asset[0]['data']['SCSIController']['ProtocolSupported']]) ? $scsi_controller_protocol_supported[$asset[0]['data']['SCSIController']['ProtocolSupported']] : $asset[0]['data']['SCSIController']['ProtocolSupported']) : $no_data_message) ?></td></tr>                                                                                                                                                    
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php } ?>

                                            <?php } else { ?>

                                                <div class="row row-buffer">
                                                    <div class="col-sm-3">
                                                        <div class="card">
                                                            <div class="card-body">  
                                                                <h6 class="card-title">SCSI<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                <p class="card-text">No information available</p>                                                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                        </div>

                                        <div class="menu-content network">

                                            <div class="inner-tab">

                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#networkadapter"><img class="device-img" src="<?php echo base_url() . '/assets/img/network.png' ?>">Network Adapters</a></li>                                                       
                                                </ul>

                                            </div>

                                            <div class="tab-content">

                                                <div id="networkadapter" class="tab-pane active">
                                                
                                                    <!-- Network Adapter -->

                                                    <?php 

                                                        if (isset($asset[0]['data']['NetworkAdapter'])){

                                                            if (isset($asset[0]['data']['NetworkAdapter'][0])){

                                                    ?>
                                        
                                                        <div class="row row-buffer">
                                                            <div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Network Adapters<img width="48" height="48" src="<?php echo base_url() . '/assets/img/network.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['name'] ?></p>      
                                                                        <div class="table-responsive">                                                                      
                                                                            <table class="table-hover table-sm main-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Description</th>
                                                                                        <th>IP Address</th>
                                                                                        <th>MAC Address</th>
                                                                                        <th>DHCP</th>
                                                                                        <th>Gateway</th>
                                                                                        <th>DNS</th>
                                                                                        <th>IP Subnet</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody> 
                                                                                    <?php for ($x = 0; $x < sizeof($asset[0]['data']['NetworkAdapter']); $x++) { ?>                                                                                                                                                                                                                              
                                                                                        <tr>
                                                                                            <td><?php echo(isset($asset[0]['data']['NetworkAdapter'][$x]['Name']) ? $asset[0]['data']['NetworkAdapter'][$x]['Name'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['NetworkAdapter'][$x]['IPAddress']) ? $asset[0]['data']['NetworkAdapter'][$x]['IPAddress'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['NetworkAdapter'][$x]['MACAddress']) ? $asset[0]['data']['NetworkAdapter'][$x]['MACAddress'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['NetworkAdapter'][$x]['DHCPEnabled']) ? $asset[0]['data']['NetworkAdapter'][$x]['DHCPEnabled'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['NetworkAdapter'][$x]['DefaultIPGateway']) ? $asset[0]['data']['NetworkAdapter'][$x]['DefaultIPGateway'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['NetworkAdapter'][$x]['DNSServerSearchOrder']) ? $asset[0]['data']['NetworkAdapter'][$x]['DNSServerSearchOrder'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['NetworkAdapter'][$x]['IPSubnet']) ? $asset[0]['data']['NetworkAdapter'][$x]['IPSubnet'] : $no_data_message) ?></td>
                                                                                        </tr>       
                                                                                    <?php } ?> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }else{ ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Network Adapter<img width="48" height="48" src="<?php echo base_url() . '/assets/img/network.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['data']['NetworkAdapter']['Name'] ?></p>
                                                                        <div class="table-responsive">  
                                                                            <table class="table-hover table-sm main-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Description</th>
                                                                                        <th>IP Address</th>
                                                                                        <th>MAC Address</th>
                                                                                        <th>DHCP</th>
                                                                                        <th>Gateway</th>
                                                                                        <th>DNS</th>
                                                                                        <th>IP Subnet</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>                                                                                                                                                                                                                                                                                                                       
                                                                                    <tr>
                                                                                        <td><?php echo(isset($asset[0]['data']['NetworkAdapter']['Name']) ? $asset[0]['data']['NetworkAdapter']['Name'] : $no_data_message) ?></td>
                                                                                        <td><?php echo(isset($asset[0]['data']['NetworkAdapter']['IPAddress']) ? $asset[0]['data']['NetworkAdapter']['IPAddress'] : $no_data_message) ?></td>
                                                                                        <td><?php echo(isset($asset[0]['data']['NetworkAdapter']['MACAddress']) ? $asset[0]['data']['NetworkAdapter']['MACAddress'] : $no_data_message) ?></td>
                                                                                        <td><?php echo(isset($asset[0]['data']['NetworkAdapter']['DHCPEnabled']) ? $asset[0]['data']['NetworkAdapter']['DHCPEnabled'] : $no_data_message) ?></td>
                                                                                        <td><?php echo(isset($asset[0]['data']['NetworkAdapter']['DefaultIPGateway']) ? $asset[0]['data']['NetworkAdapter']['DefaultIPGateway'] : $no_data_message) ?></td>
                                                                                        <td><?php echo(isset($asset[0]['data']['NetworkAdapter']['DNSServerSearchOrder']) ? $asset[0]['data']['NetworkAdapter']['DNSServerSearchOrder'] : $no_data_message) ?></td>
                                                                                        <td><?php echo(isset($asset[0]['data']['NetworkAdapter']['IPSubnet']) ? $asset[0]['data']['NetworkAdapter']['IPSubnet'] : $no_data_message) ?></td>
                                                                                    </tr>                                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Network Adapters<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                </div>

                                            </div>
                                            
                                        </div>

                                        <div class="menu-content usbcon">

                                            <?php 

                                                $col_cnt=0;

                                                //echo 'pre'; print_r($asset[0]['data']);

                                                if (isset($asset[0]['data']['USBController'])){

                                                    if (isset($asset[0]['data']['USBController'][0])){

                                                        for ($x = 0; $x < sizeof($asset[0]['data']['USBController']); $x++) {

                                            ?>

                                            <?php 

                                                if ($col_cnt == 0){
                                                    echo  '<div class="row row-buffer">';                                                      
                                                }

                                                $col_cnt += 4;  

                                            ?>

                                                <div class="col-sm-4">
                                                    <div class="card">
                                                        <div class="card-body">  
                                                            <h6 class="card-title">USB <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/usbcon.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                            <p class="card-text"><?php echo $asset[0]['data']['USBController'][$x]['Caption'] ?></p>
                                                            <div class="table-responsive">
                                                                <table class="table-hover table-sm main-table">
                                                                    <tbody>                                                                        
                                                                        <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['USBController'][$x]['Manufacturer']) ? $asset[0]['data']['USBController'][$x]['Manufacturer'] : $no_data_message) ?></td></tr>           
                                                                        <tr><td>Protocol Supported</td><td><?php echo(isset($asset[0]['data']['USBController'][$x]['ProtocolSupported']) ? (isset($usb_controller_protocol_supported[$asset[0]['data']['USBController'][$x]['ProtocolSupported']]) ? $usb_controller_protocol_supported[$asset[0]['data']['USBController'][$x]['ProtocolSupported']] : $asset[0]['data']['USBController'][$x]['ProtocolSupported']) : $no_data_message) ?></td></tr>                                                                                                                                                
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php 

                                                    if ($col_cnt == 12){
                                                        echo  '</div>';
                                                        $col_cnt = 0;    
                                                    }

                                                }

                                                if ($col_cnt <> 0){
                                                    echo  '</div>';
                                                    $col_cnt = 0;    
                                                }
                                                        
                                                }else{
                                                
                                            ?>

                                                <div class="row row-buffer">
                                                    <div class="col-sm-4">
                                                        <div class="card">
                                                            <div class="card-body">  
                                                                <h6 class="card-title">USB<img width="48" height="48" src="<?php echo base_url() . '/assets/img/usbcon.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                <p class="card-text"><?php echo $asset[0]['data']['USBController']['Caption'] ?></p>
                                                                <div class="table-responsive">
                                                                    <table class="table-hover table-sm main-table">
                                                                        <tbody>                                                                            
                                                                            <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['USBController']['Manufacturer']) ? $asset[0]['data']['USBController']['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                            <tr><td>Protocol Supported</td><td><?php echo(isset($asset[0]['data']['USBController']['ProtocolSupported']) ? (isset($usb_controller_protocol_supported[$asset[0]['data']['USBController']['ProtocolSupported']]) ? $usb_controller_protocol_supported[$asset[0]['data']['USBController']['ProtocolSupported']] : $asset[0]['data']['USBController']['ProtocolSupported']) : $no_data_message) ?></td></tr>                                                                                                                                                    
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            <?php } ?>

                                            <?php } else { ?>

                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-body">  
                                                            <h6 class="card-title">USB<img width="48" height="48" src="<?php echo base_url() . '/assets/img/ram.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                            <p class="card-text">No information available</p>                                                                                    
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php } ?>

                                        </div>

                                        <div class="menu-content peripheral">
                                        
                                            <div class="inner-tab">

                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#keyboard"><img class="device-img" src="<?php echo base_url() . '/assets/img/keyboard.png' ?>">Keyboard</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#mouse"><img class="device-img" src="<?php echo base_url() . '/assets/img/mouse.png' ?>">Mouse</a></li>     
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#printer"><img class="device-img" src="<?php echo base_url() . '/assets/img/printer.png' ?>">Printer</a></li>
                                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#monitor"><img class="device-img" src="<?php echo base_url() . '/assets/img/monitor.png' ?>">Monitor</a></li>
                                                </ul>

                                            </div>  

                                            <!-- Tab panes -->
                                            <div class="tab-content">

                                                <div id="keyboard" class="tab-pane active">

                                                    <!-- Keyboard -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['Keyboard'])){

                                                            if (isset($asset[0]['data']['Keyboard'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['Keyboard']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 6;  

                                                    ?>

                                                        <div class="col-sm-6">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Keyboard <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/keyboard.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['data']['Keyboard'][$x]['Description'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>
                                                                                <tr><td>Device ID</td><td><?php echo(isset($asset[0]['data']['Keyboard'][$x]['DeviceID']) ? $asset[0]['data']['Keyboard'][$x]['DeviceID'] : $no_data_message) ?></td></tr>                                                                               
                                                                                <tr><td>Layout</td><td><?php echo(isset($asset[0]['data']['Keyboard'][$x]['Layout']) ? $asset[0]['data']['Keyboard'][$x]['Layout'] : $no_data_message) ?></td></tr>
                                                                                <tr><td># of Function Keys</td><td><?php echo(isset($asset[0]['data']['Keyboard'][$x]['NumberOfFunctionKeys']) ? $asset[0]['data']['Keyboard'][$x]['NumberOfFunctionKeys'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Caption</td><td><?php echo(isset($asset[0]['data']['Keyboard'][$x]['Caption']) ? $asset[0]['data']['Keyboard'][$x]['Caption'] : $no_data_message) ?></td></tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                                if ($col_cnt == 12){
                                                                    echo  '</div>';
                                                                    $col_cnt = 0;    
                                                                }

                                                            }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-6">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Keyboard <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/keyboard.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['data']['Keyboard']['Description'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>
                                                                                    <tr><td>Device ID</td><td><?php echo(isset($asset[0]['data']['Keyboard']['DeviceID']) ? $asset[0]['data']['Keyboard']['DeviceID'] : $no_data_message) ?></td></tr>                                                                                    
                                                                                    <tr><td>Layout</td><td><?php echo(isset($asset[0]['data']['Keyboard']['Layout']) ? $asset[0]['data']['Keyboard']['Layout'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td># of Function Keys</td><td><?php echo(isset($asset[0]['data']['Keyboard']['NumberOfFunctionKeys']) ? $asset[0]['data']['Keyboard']['NumberOfFunctionKeys'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Caption</td><td><?php echo(isset($asset[0]['data']['Keyboard']['Caption']) ? $asset[0]['data']['Keyboard']['Caption'] : $no_data_message) ?></td></tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="col-sm-3">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Keyboard<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text">No information available</p>                                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                    
                                                </div>

                                                <div id="mouse" class="tab-pane fade">
                                                
                                                    <!-- Mouse -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($asset[0]['data']['PointingDevice'])){

                                                            if (isset($asset[0]['data']['PointingDevice'][0])){

                                                                for ($x = 0; $x < sizeof($asset[0]['data']['PointingDevice']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Mouse <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/mouse.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['data']['PointingDevice'][$x]['Caption'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>
                                                                                <tr><td>Device ID</td><td><?php echo(isset($asset[0]['data']['PointingDevice'][$x]['DeviceID']) ? $asset[0]['data']['PointingDevice'][$x]['DeviceID'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Device Interface</td><td><?php echo(isset($asset[0]['data']['PointingDevice'][$x]['DeviceInterface']) ? $asset[0]['data']['PointingDevice'][$x]['DeviceInterface'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['PointingDevice'][$x]['Manufacturer']) ? $asset[0]['data']['PointingDevice'][$x]['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                                <tr><td># of Buttons</td><td><?php echo(isset($asset[0]['data']['PointingDevice'][$x]['NumberOfButtons']) ? $asset[0]['data']['PointingDevice'][$x]['NumberOfButtons'] : $no_data_message) ?></td></tr>                                                                            
                                                                                <tr><td>Pointing Type</td><td><?php echo(isset($asset[0]['data']['PointingDevice'][$x]['PointingType']) ? (isset($pointing_device_pointing_type[$asset[0]['data']['PointingDevice'][$x]['PointingType']]) ? $pointing_device_pointing_type[$asset[0]['data']['PointingDevice'][$x]['PointingType']] : $asset[0]['data']['PointingDevice'][$x]['PointingType']) : $no_data_message) ?></td></tr>                                                                                                                                                                                                                                    
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                            if ($col_cnt == 12){
                                                                echo  '</div>';
                                                                $col_cnt = 0;    
                                                            }

                                                        }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Mouse<img width="48" height="48" src="<?php echo base_url() . '/assets/img/mouse.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['data']['PointingDevice']['Caption'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>
                                                                                    <tr><td>Device ID</td><td><?php echo(isset($asset[0]['data']['PointingDevice']['DeviceID']) ? $asset[0]['data']['PointingDevice']['DeviceID'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Device Interface</td><td><?php echo(isset($asset[0]['data']['PointingDevice']['DeviceInterface']) ? $asset[0]['data']['PointingDevice']['DeviceInterface'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Manufacturer</td><td><?php echo(isset($asset[0]['data']['PointingDevice']['Manufacturer']) ? $asset[0]['data']['PointingDevice']['Manufacturer'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td># of Buttons</td><td><?php echo(isset($asset[0]['data']['PointingDevice']['NumberOfButtons']) ? $asset[0]['data']['PointingDevice']['NumberOfButtons'] : $no_data_message) ?></td></tr>                                                                            
                                                                                    <tr><td>Pointing Type</td><td><?php echo(isset($asset[0]['data']['PointingDevice']['PointingType']) ? (isset($pointing_device_pointing_type[$asset[0]['data']['PointingDevice']['PointingType']]) ? $pointing_device_pointing_type[$asset[0]['data']['PointingDevice']['PointingType']] : $asset[0]['data']['PointingDevice']['PointingType']) : $no_data_message) ?></td></tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="col-sm-3">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Mouse<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text">No information available</p>                                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                
                                                </div>

                                                <div id="printer" class="tab-pane fade">

                                                    <!-- Printer -->

                                                    <?php 

                                                        if (isset($asset[0]['data']['Printer'])){

                                                            if (isset($asset[0]['data']['Printer'][0])){

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Printers<img width="48" height="48" src="<?php echo base_url() . '/assets/img/printer.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['name'] ?></p>      
                                                                        <div class="table-responsive">                                                                      
                                                                            <table class="table-hover table-sm main-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Name</th>
                                                                                        <th>Port Name</th>
                                                                                        <th>Location</th>                                                                                           
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody> 
                                                                                    <?php for ($x = 0; $x < sizeof($asset[0]['data']['Printer']); $x++) { ?>                                                                                                                                                                                                                              
                                                                                        <tr>
                                                                                            <td><?php echo(isset($asset[0]['data']['Printer'][$x]['DriverName']) ? $asset[0]['data']['Printer'][$x]['DriverName'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['Printer'][$x]['PortName']) ? $asset[0]['data']['Printer'][$x]['PortName'] : $no_data_message) ?></td>
                                                                                            <td><?php echo(isset($asset[0]['data']['Printer'][$x]['Location']) ? $asset[0]['data']['Printer'][$x]['Location'] : $no_data_message) ?></td>                                                                                               
                                                                                        </tr>       
                                                                                    <?php } ?> 
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }else{ ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-12">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Printer<img width="48" height="48" src="<?php echo base_url() . '/assets/img/printer.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                        <div class="table-responsive">  
                                                                        <table class="table-hover table-sm main-table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Name</th>
                                                                                    <th>Port Name</th>
                                                                                    <th>Location</th>                                                                                           
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>                                                                                                                                                                                                                                                                                                             
                                                                                <tr>
                                                                                    <td><?php echo(isset($asset[0]['data']['Printer']['DriverName']) ? $asset[0]['data']['Printer']['DriverName'] : $no_data_message) ?></td>
                                                                                    <td><?php echo(isset($asset[0]['data']['Printer']['PortName']) ? $asset[0]['data']['Printer']['PortName'] : $no_data_message) ?></td>
                                                                                    <td><?php echo(isset($asset[0]['data']['Printer']['Location']) ? $asset[0]['data']['Printer']['Location'] : $no_data_message) ?></td>                                                                                               
                                                                                </tr>                                                                                       
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-3">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Printer<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text">No information available</p>                                                                           
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>

                                                </div>

                                                <div id="monitor" class="tab-pane fade">
                                                
                                                    <!-- Monitor -->

                                                    <?php 

                                                        $col_cnt=0;

                                                        if (isset($monitor[0]['data'][0]['Monitor'])){

                                                            if (isset($monitor[0]['data'][0]['Monitor'][0])){

                                                                for ($x = 0; $x < sizeof($monitor[0]['data'][0]['Monitor']); $x++) {

                                                    ?>

                                                    <?php 

                                                        if ($col_cnt == 0){
                                                            echo  '<div class="row row-buffer">';                                                      
                                                        }

                                                        $col_cnt += 4;  

                                                    ?>

                                                        <div class="col-sm-4">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Monitor <?php echo ($x+1) ?><img width="48" height="48" src="<?php echo base_url() . '/assets/img/monitor.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                    <div class="table-responsive">
                                                                        <table class="table-hover table-sm main-table">
                                                                            <tbody>
                                                                                <tr><td>Device ID</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor'][$x]['DeviceID']) ? $monitor[0]['data'][0]['Monitor'][$x]['DeviceID'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Manufacturer</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor'][$x]['MonitorManufacturer']) ? $monitor[0]['data'][0]['Monitor'][$x]['MonitorManufacturer'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Model</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor'][$x]['Model']) ? $monitor[0]['data'][0]['Monitor'][$x]['Model'] : $no_data_message) ?></td></tr>                                                                                    
                                                                                <tr><td>Monitor Type</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor'][$x]['MonitorType']) ? $monitor[0]['data'][0]['Monitor'][$x]['MonitorType'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Manufacturing Year</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor'][$x]['ManufacturingYear']) ? $monitor[0]['data'][0]['Monitor'][$x]['ManufacturingYear'] : $no_data_message) ?></td></tr>
                                                                                <tr><td>Serial #</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor'][$x]['SerialNumber']) ? $monitor[0]['data'][0]['Monitor'][$x]['SerialNumber'] : $no_data_message) ?></td></tr>                                                                                                                                                               
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 

                                                            if ($col_cnt == 12){
                                                                echo  '</div>';
                                                                $col_cnt = 0;    
                                                            }

                                                        }

                                                        if ($col_cnt <> 0){
                                                            echo  '</div>';
                                                            $col_cnt = 0;    
                                                        }
                                                                
                                                        }else{

                                                    ?>

                                                        <div class="row row-buffer">
                                                            <div class="col-sm-4">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <h6 class="card-title">Monitor<img width="48" height="48" src="<?php echo base_url() . '/assets/img/monitor.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                        <p class="card-text"><?php echo $asset[0]['name'] ?></p>
                                                                        <div class="table-responsive">
                                                                            <table class="table-hover table-sm main-table">
                                                                                <tbody>
                                                                                    <tr><td>Device ID</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor']['DeviceID']) ? $monitor[0]['data'][0]['Monitor']['DeviceID'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Manufacturer</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor']['MonitorManufacturer']) ? $monitor[0]['data'][0]['Monitor']['MonitorManufacturer'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Model</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor']['Model']) ? $monitor[0]['data'][0]['Monitor']['Model'] : $no_data_message) ?></td></tr>                                                                                        
                                                                                    <tr><td>Monitor Type</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor']['MonitorType']) ? $monitor[0]['data'][0]['Monitor']['MonitorType'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Manufacturing Year</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor']['ManufacturingYear']) ? $monitor[0]['data'][0]['Monitor']['ManufacturingYear'] : $no_data_message) ?></td></tr>
                                                                                    <tr><td>Serial #</td><td><?php echo(isset($monitor[0]['data'][0]['Monitor']['SerialNumber']) ? $monitor[0]['data'][0]['Monitor']['SerialNumber'] : $no_data_message) ?></td></tr>                                                                                                                                                               
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php }} else { ?>

                                                        <div class="col-sm-3">
                                                            <div class="card">
                                                                <div class="card-body">  
                                                                    <h6 class="card-title">Monitor<img width="48" height="48" src="<?php echo base_url() . '/assets/img/information.png' ?>" alt="" hspace="14" vspace="2" align="right"></h6>
                                                                    <p class="card-text">No information available</p>                                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php } ?>
                                                
                                                </div>

                                            </div>

                                        </div>
                                    
                                    </div>

                                    <div class="col-md-2 p-0 side-menu">

                                        <ul class="menu">
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/motherboard.png' ?>"><a href="#baseboard" class="menu-btn">Computer / Motherboard</a></li>
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/cpu.png' ?>"><a href="#processor" class="menu-btn">Processor Details</a></li>                                                
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/ram.png' ?>"><a href="#memory" class="menu-btn">System Memory</a></li>
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/storage.png' ?>"><a href="#storage" class="menu-btn">Storage Details</a></li>
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/scsicon.png' ?>"><a href="#scsi" class="menu-btn">SCSI Controllers</a></li>
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/network.png' ?>"><a href="#network" class="menu-btn">Network Adapters</a></li>
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/usbcon.png' ?>"><a href="#usbcon" class="menu-btn">USB Controllers</a></li>
                                            <li><img class="device-img" src="<?php echo base_url() . '/assets/img/keyboard.png' ?>"><a href="#peripheral" class="menu-btn">Peripheral Devices</a></li>
                                        </ul>

                                    </div>

                                </div>

                            </div>
                            
                        </div>

                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="software" aria-labelledby="software-tab">

                        <div class="software-tab">

                                <table class="table table-sm table-hover" id='tbl_softwares'>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Software</th>
                                            <th>Version</th>
                                            <th>Vendor</th>
                                            <th>Install Date</th>
                                        </tr>
                                    </thead>

                                    <?php

                                        foreach ($asset[0]['data']['Product'] as $key => $sw) {

                                    ?>

                                        <tr>
                                            <td width="2"><a target="_blank" href='<?php echo "http://www.google.com/search?q=".urlencode($sw['Name'])?>'><img class="device-img" src="<?php echo base_url() . '/assets/img/google.png' ?>"></a></td>
                                            <td><?php echo $sw['Name'] ?></td>
                                            <td><?php echo $sw['Version'] ?></td>
                                            <td><?php echo $sw['Vendor'] ?></td>
                                            <td><?php echo date("Y-m-d", strtotime($sw['InstallDate'])) ?></td>
                                        </tr>

                                    <?php } ?>
                                </table>

                        </div>

                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="location" aria-labelledby="location-tab">
                    </div>
                   
               </div>

           </div>

       </div>

    </div>

</div>

<script>

    $(document).ready(function() {

        var table = $('#tbl_softwares').DataTable({
			aLengthMenu: [
	 			[15, 25, 50, 100, 250, 500, -1],
	 			[15, 25, 50, 100, 250, 500, "All"]
	 		],
	 		iDisplayLength: -1,
			orderCellsTop: true,
		} );

    });

    var $content = $('.menu-content');

    function showContent(type) {
        $content.hide().filter('.' + type).show();
    }

    $('.menu').on('click', '.menu-btn', function(e) {
        showContent(e.currentTarget.hash.slice(1));
        e.preventDefault();
    }); 

    showContent('baseboard');

</script>
