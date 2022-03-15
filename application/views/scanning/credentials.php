<style>

.form-control {
    font-size:12px;
}

label {
    font-size:12px;
    font-weight:bold;
}

</style>

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

                    <div class="page-header">Scanning Credentials</div>

                </div>

            </div> 

            <div class="row">

                <div class="col-md-12 pt-2">

                    <button type="button" class="btn-custom" data-toggle="modal" data-target="#addcredential"><img src="<?php echo base_url() . '/assets/img/plus.png' ?>">Add Credentials</button>
                                         
                    <div class="modal fade" id="addcredential" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="addcredentiallabel">Add new credential</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                  
                                <form class="form-horizontal" id="credential">

                                    <div class="modal-body">    
                                        
                                        <fieldset class="form-group">
                                            <label for="lbltype">Type</label>
                                            <select name="type" id="type" style="width:100%;font-size:12px;">
                                                <option value="windows" data-image="<?php echo base_url() . '/assets/img/types/windows.png' ?>">Windows</option>
                                                <option value="snmpv1v2" data-image="<?php echo base_url() . '/assets/img/types/ethernet.png' ?>">SNMP (V1/V2)</option>
                                                <option value="snmpv3" data-image="<?php echo base_url() . '/assets/img/types/ethernet.png' ?>">SNMP V3</option>
                                            </select>
                                            
                                        </fieldset>

                                        <fieldset class="form-group" id="groupname">
                                            <label id="lblname" for="name">Name</label>
                                            <input type="text" required class="form-control" id="name" name="name">
                                        </fieldset>  

                                        <fieldset class="form-group" id="grouplogin">
                                            <label id="lbllogin" for="login">Login</label>
                                            <input type="text" class="form-control" id="login" name="login">
                                        </fieldset> 

                                        <fieldset class="form-group" id="grouppassword">
                                            <label id="lblpassword" for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </fieldset> 

                                        <fieldset class="form-group" id="groupcommunity">
                                            <label  id="lblcommunity" for="community">Community</label>
                                            <input type="text" class="form-control" id="community" name="community">
                                        </fieldset> 

                                        <fieldset class="form-group" id="groupencryptionkey">
                                            <label  id="lblencryptionkey" for="encryptionkey">Encryption key</label>
                                            <input type="text" class="form-control" id="encryptionkey" name="encryptionkey">
                                        </fieldset> 

                                        <fieldset class="form-group" id="groupauthenticationtype">
                                            <label  id="lblauthenticationtype" for="authenticationtype">Authentication type</label>
                                            <select class="form-control" id="authenticationtype" name="authenticationtype">
                                                <option selected value="">None</option>
                                                <option value="1">MD5</option>
                                                <option value="2">SHA1</option>
                                            </select>                                            
                                        </fieldset> 

                                        <fieldset class="form-group" id="groupprivacytype">
                                            <label  id="lblprivacytype" for="privacytype">Privacy type</label>
                                            <select class="form-control" id="privacytype" name="privacytype">
                                                <option selected value="">None</option>
                                                <option value="1">DES</option>
                                                <option value="2">AES 128</option>
                                                <option value="3">AES 192</option>
                                                <option value="4">AES 256</option>
                                                <option value="5">Triple DES</option>
                                            </select> 
                                        </fieldset> 
                                                                                                                                    
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>

                                </form>    

                            </div>

                        </div>
                    </div>
                        
                    <table id="credential" cellspacing="0" cellpadding="0" class="scantable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Login</th>
                                <th>Mapping</th>       
                                <th></th> 
                                <th></th>                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="<?php echo base_url() . '/assets/img/windows.png' ?>"></td>   
                                <td>Windows</td>
                                <td>Global Windows</td>
                                <td>snmain\3100002</td>
                                <td style="text-align:center;"><img src="<?php echo base_url() . '/assets/img/checked.png' ?>"></td> 
                                <td><img src="<?php echo base_url() . '/assets/img/edit.png' ?>"></td>  
                                <td></td>                                  
                            </tr>
                            <tr>
                                <td><img src="<?php echo base_url() . '/assets/img/snmp.png' ?>"></td>   
                                <td>SNMP (V1/V2)</td>
                                <td>Global SNMP</td>
                                <td>snmain\3100002</td>
                                <td style="text-align:center;"><img src="<?php echo base_url() . '/assets/img/checked.png' ?>"></td> 
                                <td><img src="<?php echo base_url() . '/assets/img/edit.png' ?>"></td> 
                                <td><img src="<?php echo base_url() . '/assets/img/remove.png' ?>"></td>            
                            </tr>
                            <tr>
                                <td><img src="<?php echo base_url() . '/assets/img/snmp.png' ?>"></td>   
                                <td>SNMP V3</td>
                                <td>Global SNMP</td>
                                <td>snmain\3100002</td>
                                <td style="text-align:center;"><img src="<?php echo base_url() . '/assets/img/cancel.png' ?>"></td> 
                                <td><img src="<?php echo base_url() . '/assets/img/edit.png' ?>"></td>    
                                <td><img src="<?php echo base_url() . '/assets/img/remove.png' ?>"></td>            
                            </tr>
                        </tbody>
                    </table>
                                            
                </div>

                <div class="col-md-12 pt-4">

                    <div class="page-header"><img src="<?php echo base_url() . '/assets/img/credenmap.png' ?>" alt="" hspace="14" vspace="2">Credential Mapping</div>

                    <button type="button" class="btn-custom mt-2" data-toggle="modal" data-target="#mapcredential"><img src="<?php echo base_url() . '/assets/img/plus.png' ?>">Map Credentials</button>

                    <div class="modal fade" id="mapcredential" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="addcredentiallabel">Map credential</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                    <?php

                                        $attributes = array('id' => 'myform1','class' => 'form-horizontal');
                                        echo form_open('helpdesk/ticket/add', $attributes);

                                    ?>  

                                <div class="modal-body">    
                                       
                                    <fieldset class="form-group">
                                        <label for="lblmappingtype">Mapping Type</label>
                                        <select name="mappingtype" id="mappingtype" style="width:100%;font-size:12px;">
                                            <option value="iprange" data-image="<?php echo base_url() . '/assets/img/mappingtypes/iprange.png' ?>">IP Range</option>
                                            <option value="ipaddress" data-image="<?php echo base_url() . '/assets/img/mappingtypes/ipaddress.png' ?>">IP Address</option>                                            
                                            <option value="computername" data-image="<?php echo base_url() . '/assets/img/mappingtypes/computer.png' ?>">Computer Name</option>
                                        </select>
                                    </fieldset>

                                    <fieldset class="form-group">
                                        <label id="lblmappingtypeip" for="name">Name</label>
                                        <input type="text" required class="form-control" id="ip" name="name">
                                    </fieldset>  
                                                                                                                                
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>

                                <?php echo form_close(); ?>    

                            </div>

                        </div>
                    </div>

                    <table id="mapping" cellspacing="0" cellpadding="0" class="scantable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Mapping Type</th>
                                <th>Mapped to</th>
                                <th>Credentials</th>                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="<?php echo base_url() . '/assets/img/iprange.png' ?>"></td>   
                                <td>IP Range</td>
                                <td>172.20.0.1 - 172.20.15.254</td>
                                <td><img src="<?php echo base_url() . '/assets/img/edit.png' ?>"></td>   
                            </tr>
                            <tr>
                                <td><img src="<?php echo base_url() . '/assets/img/iprange.png' ?>"></td>   
                                <td>IP Range</td>
                                <td>192.168.137.1 - 192.168.137.254</td>
                                <td><img src="<?php echo base_url() . '/assets/img/edit.png' ?>"></td>   
                            </tr>
                            <tr>
                                <td><img src="<?php echo base_url() . '/assets/img/iprange.png' ?>"></td>   
                                <td>IP Range</td>
                                <td>192.168.65.1 - 192.168.65.254</td>
                                <td><img src="<?php echo base_url() . '/assets/img/edit.png' ?>"></td>   
                            </tr>
                        </tbody>
                    </table>


                </div>

                

            </div> 
            
        </div>

    </div>	

</div>		


<script language="javascript">

    $(document).ready(function(e) {
        $("#type").msDropdown({visibleRows:4});
        $("#mappingtype").msDropdown({visibleRows:4});

        $('#credential').submit(function(e) {

            var title = $("input[name='title']").val();
            var description = $("textarea[name='description']").val();


            $.ajax({
            url: '/ajax-requestPost',
            type: 'POST',
            data: {title: title, description: description},
            error: function() {
                alert('Something is wrong');
            },
            success: function(data) {
                    $("tbody").append("<tr><td>"+title+"</td><td>"+description+"</td></tr>");
                    alert("Record added successfully");  
            }
            });

        });

    });

    $("#type").change(function() {

        if ($(this).val() == "windows") {

            $('#groupname').show();

            $('#grouplogin').show();
            $('#login').attr('required', '');

            $('#grouppassword').show();
            $('#password').attr('required', '');
  
            $('#groupcommunity').hide();
            $('#community').removeAttr('required');

            $('#groupencryptionkey').hide();
            $('#encryptionkey').removeAttr('required');

            $('#groupauthenticationtype').hide();
            $('#authenticationtype').removeAttr('required');

            $('#groupprivacytype').hide();
            $('#privacytype').removeAttr('required');

        } else if ($(this).val() == "snmpv1v2") {   
            
            $('#groupname').show();

            $('#groupcommunity').show();
            $('#community').attr('required', '');

            $('#grouplogin').hide();
            $('#login').removeAttr('required');

            $('#grouppassword').hide();    
            $('#password').removeAttr('required');

            $('#groupencryptionkey').hide();
            $('#encryptionkey').removeAttr('required');

            $('#groupauthenticationtype').hide();
            $('#authenticationtype').removeAttr('required');

            $('#groupprivacytype').hide();
            $('#privacytype').removeAttr('required');

        } else if ($(this).val() == "snmpv3") {

            $('#groupname').show();
            $('#name').attr('required', '');

            $('#grouplogin').show();
            $('#login').attr('required', '');

            $('#grouppassword').show();  
            $('#password').attr('required', '');

            $('#groupencryptionkey').show();
            $('#encryptionkey').attr('required', '');

            $('#groupauthenticationtype').show();
            $('#authenticationtype').attr('required', '');

            $('#groupprivacytype').show();
            $('#privacytype').attr('required', '');

            $('#groupcommunity').hide();
            $('#community').removeAttr('required');

        } else {
           
            $('#groupname').hide();
            $('#groupcommunity').hide();
            $('#grouplogin').hide();
            $('#grouppassword').hide();             
            $('#groupencryptionkey').hide();
            $('#groupauthenticationtype').hide();
            $('#groupprivacytype').hide();

        }

    });

    $("#type").trigger("change");

</script>

