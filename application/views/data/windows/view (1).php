<style>
.sidebar-container {
	height: auto;
	overflow: hidden;
 }
 
 .sidebar-container .right-panel {
    min-height: calc(100vh - 85px);
    /*width: 45px;*/
    float: right;
    color: #abb;
    width: auto;
    /*overflow: hidden;*/
 }
 
 .sidebar-container .left-panel {
    min-height: calc(100vh - 85px);
    float: none;
    width: 145px;
    background: #fff;
    border-right: 1px #D5D5D5 solid;
 }
 
 </style>

<div class="sidebar-container">

    <div class="right-panel"> 
    
        <?php
           
            $asset = json_decode(json_encode($assets), TRUE);                
            $monitor = json_decode(json_encode($monitor), TRUE);

            //popen('start cmd.exe @cmd /k"ping 172.20.9.50"', 'r');

        ?>

        <!-- <div class="row">

            <div class="col-md-12 pr-0"> -->

                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td width="52">
                                <img width="48" height="48" style="margin-top: 5px; margin-bottom: 5px;" src="<?php echo base_url() . '/assets/img/desktop.png' ?>" alt="" hspace="14" vspace="2">
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
                                    <td align="right">
                                        <img src="<?php echo(isset($asset[0]['manufacturer']) ? (isset($vendor_logo[strtolower($asset[0]['manufacturer'])]) ? base_url() . '/assets/img/vendors/'. $vendor_logo[strtolower($asset[0]['manufacturer'])] : strtolower($asset[0]['manufacturer'])) : $no_data_message) ?>" alt="" hspace="4" border="0" align="middle">
                                    </td>
                            <?php }} ?>
                        </tr>
                    </tbody>
                </table>
                
            <!-- </div>

        </div>  -->
           
    </div>

    <div class="left-panel">

        <div class="page-header">Asset Actions</div>
            
        <nav class="navbar page-side-nav">

            <ul class="navbar-nav">
                
                <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/add.png' ?>" class="device-img" alt="">New asset</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/addloc.png' ?>" class="device-img" alt="">New location</a> </li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/edit.png' ?>" class="device-img" alt="">Edit asset</a></li>
                <li class="nav-item"> <a class="nav-link" href="#"><img src="<?php echo base_url() . '/assets/img/rescan.png' ?>" class="device-img" alt="">Rescan asset</a></li>
            </ul>

        </nav>

    </div>
</div>