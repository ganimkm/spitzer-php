<div class="container-fluid">

    <div class="row">

        <div class="col-md-2">

            <div class="row">

                <div class="col-md-12 p-0">

                    <div class="page-header">Scanning Options</div>

                    <nav class="navbar page-side-nav">

                        <ul class="navbar-nav">
                            
                            <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/scanning.png' ?>" class="device-img" alt="">Scanning Targets</a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/credential.png' ?>" class="device-img" alt="">Scanning Credentials</a> </li>                           
                        </ul>

                    </nav>

                    <div class="page-header">Basic Actions</div>

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

            </div> 

        </div>
        
        <div class="col-md-10">

            <div class="row">

                <div class="col-md-12 p-0">

                    <div class="page-header">Scanning Targets</div>

                </div>

            </div> 

            <div class="row">

                <div class="col-md-12 pt-2">

                    <button type="button" class="btn-custom"><img src="<?php echo base_url() . '/assets/img/plus.png' ?>">Add Scanning Targets</button>
                    <button type="button" class="btn-custom"><img src="<?php echo base_url() . '/assets/img/flash.png' ?>">Scan now</button>
                    <button type="button" class="btn-custom"><img src="<?php echo base_url() . '/assets/img/cancel.png' ?>">Disable All</button>
                   
                    <table id="scantarget" cellspacing="0" cellpadding="0" class="scantable">
                        <thead>
                            <tr>
                                <th>Quick Scan</th>
                                <th>Enabled</th>
                                <th></th>
                                <th>Scan type</th>
                                <th>Target</th>
                                <th>Description</th>
                                <th>Schedule</th>
                                <th>Last scan</th>
                                <th>Error</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><button type="button" class="btn-custom"><img src="<?php echo base_url() . '/assets/img/flash.png' ?>">Scan now</button></td>
                                <td>Enabled</td>
                                <td><img src="<?php echo base_url() . '/assets/img/iprange.png' ?>"></td>
                                <td>IP Range</td>
                                <td>172.20.0.1 - 172.20.15.254</td>
                                <td>Description</td>
                                <td>Schedule</td>
                                <td>Last scan</td>
                                <td>Error</td>
                            </tr>
                        </tbody>
                    </table>                 
                    
                </div>

            </div> 
            
        </div>

    </div>	

</div>		
