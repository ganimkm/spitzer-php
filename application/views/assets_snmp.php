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

        <div class="page-header borbot-solid">All Assets</div>

        <table class="asset-table" id='tbl_assets'>

            <thead>
                <tr>							
                    <th>IP Address</th>		
                    <th>sysObjectID</th>		
                    <th>sysServices</th>		
                    <th>Manufacturer</th>		
                    <th>sysLocation</th>												
                    <th>sysName</th>
                    <th>Type</th>
                    <th>Model</th>				
                    <th>sysDescr</th>		
                    <th>sysUpTime</th>
                    <th>Error</th>			
                </tr>
            </thead>

            <tbody>

                <?php

                    $i =1; 
                    
                    foreach($assets as $asset) {

                        $snmp_asset = json_decode(json_encode($asset), TRUE);   
                   
                ?>	

                <tr>
                        
                    <td><?php echo (array_key_exists('ip_address', $snmp_asset) ? $snmp_asset['ip_address'] : "") ?></td>

                    <?php if (isset($snmp_asset['data']['sysObjectID'])){ ?>
                        <td><?php echo ($snmp_asset['data']['sysObjectID']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    <?php if (isset($snmp_asset['data']['sysServices'])){ ?>
                        <td><?php echo ($snmp_asset['data']['sysServices']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    <?php if (isset($snmp_asset['data']['Manufacturer'])){ ?>
                        <td><?php echo ($snmp_asset['data']['Manufacturer']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    <?php if (isset($snmp_asset['data']['sysLocation'])){ ?>
                        <td><?php echo ($snmp_asset['data']['sysLocation']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    <?php if (isset($snmp_asset['data']['sysName'])){ ?>
                        <td><?php echo ($snmp_asset['data']['sysName']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    <?php if (isset($snmp_asset['data']['Type'])){ ?>
                        <td><?php echo ($snmp_asset['data']['Type']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    
                    <?php if (isset($snmp_asset['data']['Model'])){ ?>
                        <td><?php echo ($snmp_asset['data']['Model']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    <?php if (isset($snmp_asset['data']['sysDescr'])){ ?>
                        <td><?php echo ($snmp_asset['data']['sysDescr']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>


                    <?php if (isset($snmp_asset['data']['sysUpTime'])){ ?>
                        <td><?php echo ($snmp_asset['data']['sysUpTime']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>

                    
                    <?php if (isset($snmp_asset['data']['Error'])){ ?>
                        <td><?php echo ($snmp_asset['data']['Error']) ?></td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>


          
                </tr>

                <?php

                        $i++;
                    }

                ?>

            </tbody>

        </table>

    </div>

</div>

<script>
    $(document).ready(function() {

        var table = $('#tbl_assets').DataTable({
			aLengthMenu: [
	 			[100, 250, 500, -1],
	 			[100, 250, 500, "All"]
             ],
	 		iDisplayLength: 250,
            orderCellsTop: true,
            fixedColumns: true,
            scrollY:        'calc(100vh - 250px)',
            scrollX:        '100vw',
            // scrollX: true,	
            scrollCollapse: true
        } );

    });
    
</script>
