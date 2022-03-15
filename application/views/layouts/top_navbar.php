<div class="fixed-top">

    <nav class="navbar navbar-expand-sm bg-nav">
                    
        <div class="logo">
            <a class="navbar-brand" href="#">
                <img src="<?php echo base_url() . '/assets/img/logo_web.png' ?>" width="30" height="30" alt="logo">
                <?php echo $project_title ?>
            </a>
        </div> 

   </nav>

    <nav class="main-menu navbar navbar-expand-sm bg-menu py-1 py-md-1 borbot-solid">
    
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link" href="#"><i class="fa fa-tachometer mr-1"></i>Dashboard</a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-align-justify mr-1"></i>Assets
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <div class="main-menu-dropdown">

                        <table border="0" cellspacing="0" cellpadding="0" style="background-color:#fff">

                            <tbody>                          
                                <tr>

                                    <td valign="top">
                                        
                                        <div class="main-menu-dropdown-heading">Assets</div>
                                        
                                        <table width="100%" border="0" cellpadding="2" cellspacing="0">

                                            <tbody>

                                                <tr>
                                                    <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/assets.png' ?>" width="16" height="16" alt=""></td>
                                                    <td align="left" class="stippel"><a href="<?php echo site_url() . '/assets' ?>">All Assets</a></td>
                                                </tr>

                                                <tr>
                                                    <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/add.png' ?>" width="16" height="16" alt=""></td>
                                                    <td align="left" class="stippel"><a href="/editasset.aspx?new=1">New Asset</a></td>
                                                </tr>
                        
                                                <tr>
                                                    <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/addloc.png' ?>" width="16" height="16" alt=""></td>
                                                    <td align="left" class="stippel"><a href="/Map.aspx?new=1">New Location</a></td>
                                                </tr>
                                                <tr>
                                                    <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/nolocation.png' ?>" width="16" height="16" alt=""></td>
                                                    <td align="left" class="stippel">
                                                        <a href="/Report/report.aspx?det=web50nolocation&amp;title=Assets%20without%20a%20location">Assets without a location</a>
                                                        <span class="lgr">(111)</span>
                                                    </td>
                                                </tr> 
                                                <tr>
                                                    <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/import.png' ?>" width="16" height="16" alt=""></td>
                                                    <td align="left" class="stippel"><a href="/AssetsImport.aspx">Import Assets</a></td>
                                                </tr>
                                            
                                            </tbody>
                                        </table>
                                        
                                        <div class="main-menu-dropdown-heading" style="border-top:1px solid #CCCCCC;">Domains &amp; Workgroups</div>
                            
                                        <div id="domainsMenu" class="assetMenuItem">
                                            <table width="100%" border="0" cellpadding="2" cellspacing="0" style="padding:4px;">                
                                                <tbody>
                                                    <tr>
                                                        <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/import.png' ?>" width="16" height="16" alt=""></td>
                                                        <td align="left" class="stippel"><a href="/Report/report.aspx?det=Web50getdomain&amp;@domain=snmain&amp;title=Computers+in+snmain">Snmain</a> <span class="lgr">(28)</span></td>
                                                    </tr>
                                
                                                </tbody>
                                            </table>
                                        </div>  
                        
                                    </td>

                                    <td valign="top" class="stipleft">
                        
                                        <div class="main-menu-dropdown-heading">Agent</div>

                                    
                                            <table width="100%" border="0" cellpadding="2" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td width="10"><img src="<?php echo base_url() . '/assets/img/add.png' ?>" width="16" height="16" alt=""></td>
                                                        <td class="stippel"><a href="/Assets/Echo/EchoAssets.aspx">Agent Assets</a></td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        
                                    </td>

                                </tr>
                            </tbody>

                        </table>

                    </div>

                </div>

            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-file-text mr-1"></i>Reports</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-cube mr-1"></i>Software</a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bullseye mr-1"></i>Scanning
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    <div class="main-menu-dropdown">

                        <table border="0" cellspacing="0" cellpadding="0" style="background-color:#fff">

                            <tbody>                          
                                <tr>

                                    <td valign="top">
                                        
                                        <div class="main-menu-dropdown-heading">Scanning Options</div>
                                        
                                        <table width="100%" border="0" cellpadding="2" cellspacing="0">

                                            <tbody>

                                                <tr>
                                                    <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/scanning.png' ?>" width="16" height="16" alt=""></td>
                                                    <td align="left" class="stippel"><a href="<?php echo site_url() . '/scanning/methods' ?>">Scanning Targets</a></td>
                                                </tr>

                                                <tr>
                                                    <td width="10" align="left"><img src="<?php echo base_url() . '/assets/img/credential.png' ?>" width="16" height="16" alt=""></td>
                                                    <td align="left" class="stippel"><a href="<?php echo site_url() . '/scanning/credentials' ?>">Scanning Credentials</a></td>
                                                </tr>                                                                            
                                            </tbody>
                                        </table>

                                    </td>
                                
                                </tr>
                                
                            </tbody>

                        </table>

                    </div>

                </div>

            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-cog mr-1"></i>Configuration</a>
            </li>

        </ul>
        
    </nav>

</div>




   