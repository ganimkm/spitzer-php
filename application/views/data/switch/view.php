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

       ?>

        <div class="asset-header">

            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td width="52" style="padding-right:12px;">
                            <img width="42" height="42" style="margin-top: 5px; margin-bottom: 5px;" src="<?php echo base_url() . '/assets/img/switch.png' ?>" alt="" hspace="14" vspace="2">
                        </td>
                        <td>
                            <table border="0" cellspacing="2" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td class="headbot"><span class="ptitle">
                                            <?php echo $asset[0]['name'] ?>                                                    
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

           <div class="col-md-12 pr-0">

               <!-- Main Tab -->
               <div class="main-tab">
               
                <ul class="nav nav-pills" role="tablist">
            
                    <li class="nav-item">
                        <a class="nav-link active" href="#summary" id="summary-tab" role="tab" data-toggle="tab" aria-controls="summary" aria-expanded="true"><img class="main-tab-img" src="<?php echo base_url() . '/assets/img/switch.png' ?>">Summary</a>
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
                                                            <td><img class="device-img" src="<?php echo base_url() . '/assets/img/switch.png' ?>"></td>
                                                            <td><?php echo $asset[0]['type'] ?></td>
                                                        </tr>
                                                                                                                                                                    
                                                        <!------------------------------------------------------------------------------------------------------------------------------->
                                                                                                            
                                                        <?php if (array_key_exists('manufacturer',$asset[0])){

                                                            if(!empty($asset[0]['manufacturer'])){ ?>

                                                                <tr>
                                                                    <td>Manufacturer:</td>                                                                        
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/manufactor.png' ?>"></td>
                                                                    <td><?php echo $asset[0]['manufacturer'] ?></td>
                                                                </tr>

                                                        <?php }} ?>

                                                        <?php if (array_key_exists('model',$asset[0])){

                                                            if(!empty($asset[0]['model'])){ ?>

                                                                <tr>
                                                                    <td>Model:</td>                                                                        
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/model.png' ?>"></td>
                                                                    <td><?php echo $asset[0]['model'] ?></td>
                                                                </tr>

                                                        <?php }} ?>

                                                        <?php if (array_key_exists('description',$asset[0])){

                                                            if(!empty($asset[0]['description'])){ ?>

                                                                <tr>
                                                                    <td>Description:</td>                                                                        
                                                                    <td><img class="device-img" src="<?php echo base_url() . '/assets/img/description.png' ?>"></td>
                                                                    <td><?php echo str_replace('\r\n', '<br>', $asset[0]['description']) ?></td>                                                                    
                                                                </tr>

                                                        <?php }} ?>
                                                                                                        
                                                        <!------------------------------------------------------------------------------------------------------------------------------->

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
                                                            <td></td>
                                                        </tr>

                                                        <?php if (!empty($asset[0]['scan_server'])){ ?>

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

                                                        <?php if (!empty($asset[0]['serial'])){ ?>
                                                            <tr>
                                                                <td>Serial</td>               
                                                                <td><img class="device-img" src="<?php echo base_url() . '/assets/img/steps.png' ?>"></td>
                                                                <td><?php echo  $asset[0]['serial'] ?></td>
                                                            </tr>

                                                        <?php } ?>

                                                        <tr>
                                                            <td>Uptime:</td>
                                                            <td><img class="device-img" src="<?php echo base_url() . '/assets/img/uptime.png' ?>"></td>                                                                
                                                            <td></td>
                                                        </tr>


                                                        <?php if (!empty($asset[0]['first_seen'])){ ?>
                                                            <tr>
                                                                <td>First seen:</td>
                                                                <td><img class="device-img" src="<?php echo base_url() . '/assets/img/calendar.png' ?>"></td>
                                                                <td><?php echo  date("Y-m-d H:i:s", $asset[0]['first_seen']['$date']['$numberLong'] / 1000) ?></td>
                                                            </tr>

                                                        <?php } ?>

                                                        <?php if (!empty($asset[0]['last_seen'])){ ?>
                                                            <tr>
                                                                <td>Last seen:</td>
                                                                <td><img class="device-img" src="<?php echo base_url() . '/assets/img/calendar.png' ?>"></td>
                                                                <td><?php echo  date("Y-m-d H:i:s", $asset[0]['last_seen']['$date']['$numberLong'] / 1000) ?></td>
                                                            </tr>

                                                        <?php } ?>

                                                        <tr>
                                                            <td>Purchased:</td>
                                                            <td><img class="device-img" src="<?php echo base_url() . '/assets/img/purchase.png' ?>"></td>                                                                
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <td>Warranty:</td>
                                                            <td><img class="device-img" src="<?php echo base_url() . '/assets/img/waranty.png' ?>"></td>                                                                
                                                            <td></td>
                                                        </tr>
                                                    
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

                        <div class="page-div-header"><img src="<?php echo base_url() . '/assets/img/tag.png' ?>" alt="" hspace="14" vspace="2">Asset Groups</div>

                        <div class="asset-group">

                            <span>
                                <img src="<?php echo base_url() . '/assets/img/tag_blue.png' ?>" alt="" width="10" height="10"> 
                                <a href="#">Default group</a>
                            </span>

                            <span>
                                <img src="<?php echo base_url() . '/assets/img/tag_blue.png' ?>" alt="" width="10" height="10"> 
                                <a href="#">Default group</a>
                            </span>

                        </div>

                        <div class="page-div-header"><img src="<?php echo base_url() . '/assets/img/interface.png' ?>" alt="" hspace="14" vspace="2">Network interfaces</div>

                        <table class="table table-sm table-hover" id='tbl_network_interface'>
                            <thead>
                                <tr>
                                    <th width="2"></th>
                                    <th>If</th>
                                    <th>Name</th>
                                    <th>Alias</th>
                                    <th>Description</th>
                                    <th>Type</th>
                                    <th>Admin</th> 
                                    <th>MTU</th>                                   
                                    <th>Speed</th>
                                    <th>High Speed</th>     
                                    <th>IP Address</th>
                                    <th>Mask</th>                                                                   
                                    <th>MAC Address</th>                                                                        
                                </tr>
                            </thead>

                            <?php foreach ($asset[0]['data'][0]['Switch']['Port'] as $key => $port) { ?>

                                <tr>       
                                    <td><img src="<?php echo(isset($port['OperateStatus']) ? (isset($if_oper_status[$port['OperateStatus']]) ? base_url() . '/assets/img/'. $if_oper_status[$port['OperateStatus']] : $port['OperateStatus']) : $no_data_message) ?>" alt="" width="10" height="10" align="middle"></td>                         
                                    <td><?php echo $port['Index'] ?></td>
                                    <td><?php echo $port['Name'] ?></td>
                                    <td><?php echo $port['Alias'] ?></td>
                                    <td><?php echo $port['Description'] ?></td>
                                    <td><?php echo(isset($port['Type']) ? (isset($if_type[$port['Type']]) ? $if_type[$port['Type']] : $port['Type']) : $no_data_message) ?></td>                                    
                                    <td><?php echo(isset($port['AdminStatus']) ? (isset($if_admin_status[$port['AdminStatus']]) ? $if_admin_status[$port['AdminStatus']] : $port['AdminStatus']) : $no_data_message) ?></td>  
                                    <td><?php echo $port['MTU'] ?></td>
                                    <td><?php echo $this->utility->format_bits_Mbits($port['Speed']) ?></td>
                                    <td><?php echo $this->utility->format_Mbit($port['HighSpeed']) ?></td>   
                                    <td></td>   
                                    <td></td>                                                                       
                                    <td><?php echo $port['PhysicalAddress'] ?></td>                                                                      
                                </tr>

                            <?php } ?>

                        </table>

                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="location" aria-labelledby="location-tab">

                    </div>

               </div>

           </div>

       </div>

    </div>

</div>
