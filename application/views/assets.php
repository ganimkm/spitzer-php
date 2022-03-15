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

        <div class="row pr-1">
            <div class="col-12">
                <table class="asset-table" id='tbl_assets'>

                    <thead>
                        <tr>							
                            <th>Name</th>
                            <th>Type</th>
                            <th>Domain</th>
                            <th>User</th>
                            <th>OS</th>
                            <th>Model</th>
                            <th>Manufacturer</th>
                            <th>Serial #</th>
                            <th>IP Address</th>
                            <th>Location</th>
                            <th>MAC Address</th>
                            <th>OU</th>
                            <th>Description</th>												
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                            $i =1; 
                            
                            foreach($assets as $asset) {
                                
                        ?>	

                        <tr>
                        
                            <?php foreach ($asset['_id'] as $key => $value) { ?>

                                <td><a href="<?php echo site_url() .'/assets/' . strtolower($asset['type']) . '/' . $value ?>"><img width="12" height="12" style="margin-top: 4px; margin-bottom: 4px; margin-right: 12px;" src="<?php echo base_url() . '/assets/img/'  . $asset['type'] . '.png' ?>"><?php echo $asset['name'] ?></a></td>
                                    
                            <?php } ?>
                                                
                            <td><a href="<?php echo site_url() .'/reports/type/' . strtolower($asset['type']) ?>"><?php echo $asset['type'] ?></a></td>
                            <td><?php echo (array_key_exists('domain', $asset) ? $asset['domain'] : "") ?></td>
                            <td><?php echo (array_key_exists('user_name', $asset) ? $asset['user_name'] : "") ?></td>
                            <td><?php echo (array_key_exists('os_name', $asset) ? $asset['os_name'] : "") ?></td>
                            <td><?php echo (array_key_exists('model', $asset) ? $asset['model'] : "") ?></td>
                            <td><?php echo (array_key_exists('manufacturer', $asset) ? $asset['manufacturer'] : "") ?></td>
                            <td><?php echo (array_key_exists('serial', $asset) ? $asset['serial'] : "") ?></td>
                            <td><?php echo (array_key_exists('ip_address', $asset) ? $asset['ip_address'] : "") ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?php echo (array_key_exists('description', $asset) ? $asset['description'] : "") ?></td>
                                
                        </tr>

                        <?php

                                $i++;
                            }

                        ?>

                    </tbody>

                </table>
            </div>
        </div>

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
