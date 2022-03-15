<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>

<?php
 
//LDAP Bind paramters, need to be a normal AD User account.
$ldap_password = 'Mrbean@2020';
$ldap_username = '3100002@snmain.sankaranethralaya.org';
$ldap_connection = ldap_connect("snmain.sankaranethralaya.org");
 
if (FALSE === $ldap_connection){
    // Uh-oh, something is wrong...
	echo 'Unable to connect to the ldap server';
}
 
// We have to set this option for the version of Active Directory we are using.
ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
ldap_set_option($ldap_connection, LDAP_OPT_SIZELIMIT, 2000);

 
if (TRUE === ldap_bind($ldap_connection, $ldap_username, $ldap_password)){
 
	//Your domains DN to query
    $ldap_base_dn = 'DC=snmain,DC=sankaranethralaya,DC=org';
	
	//Get standard users and contacts
	$search_filter = '(|(objectCategory=computer))';
	//$search_filter = '(|(objectCategory=computer)(objectCategory=contact))';
	//$search_filter = 'CN=*';
	




	//Connect to LDAP
	$result = ldap_search($ldap_connection, $ldap_base_dn, $search_filter);
	
    if (FALSE !== $result){
		$entries = ldap_get_entries($ldap_connection, $result);
		
		// Uncomment the below if you want to write all entries to debug somethingthing 
		//var_dump($entries);
		
		//print_r($entries);

		echo $entries['count'];
		
		//Create a table to display the output 
		echo '<h2>AD User Results</h2></br>';
		echo '<table border = "1"><tr bgcolor="#cccccc"><td>Username</td><td>Last Name</td><td>First Name</td><td>Company</td><td>Department</td><td>Office Phone</td><td>Fax</td><td>Mobile</td><td>DDI</td><td>E-Mail Address</td><td>Home Phone</td></tr>';
		
		//For each account returned by the search
		for ($x=0; $x<$entries['count']; $x++){
			
			//
			//Retrieve values from Active Directory
			//
			
			//Windows Usernaame
			$LDAP_samaccountname = "";
			
			if (!empty($entries[$x]['cn'][0])) {
				$LDAP_samaccountname = $entries[$x]['cn'][0];
				if ($LDAP_samaccountname == "NULL"){
					$LDAP_samaccountname= "";
				}
			} else {
				//#There is no samaccountname s0 assume this is an AD contact record so generate a unique username
				
				$LDAP_uSNCreated = $entries[$x]['usncreated'][0];
				$LDAP_samaccountname= "CONTACT_" . $LDAP_uSNCreated;
			}
			
			//Last Name
			$LDAP_LastName = "";
			
			if (!empty($entries[$x]['sn'][0])) {
				$LDAP_LastName = $entries[$x]['sn'][0];
				if ($LDAP_LastName == "NULL"){
					$LDAP_LastName = "";
				}
			}
			
			//First Name
			$LDAP_FirstName = "";
			
			if (!empty($entries[$x]['givenname'][0])) {
				$LDAP_FirstName = $entries[$x]['givenname'][0];
				if ($LDAP_FirstName == "NULL"){
					$LDAP_FirstName = "";
				}
			}
			
			//Company
			$LDAP_CompanyName = "";
			
			if (!empty($entries[$x]['company'][0])) {
				$LDAP_CompanyName = $entries[$x]['company'][0];
				if ($LDAP_CompanyName == "NULL"){
					$LDAP_CompanyName = "";
				}
			}
			
			//Department
			$LDAP_Department = "";
			
			if (!empty($entries[$x]['department'][0])) {
				$LDAP_Department = $entries[$x]['department'][0];
				if ($LDAP_Department == "NULL"){
					$LDAP_Department = "";
				}
			}
			
			//Job Title
			$LDAP_JobTitle = "";
			
			if (!empty($entries[$x]['title'][0])) {
				$LDAP_JobTitle = $entries[$x]['title'][0];
				if ($LDAP_JobTitle == "NULL"){
					$LDAP_JobTitle = "";
				}
			}
			
			//IPPhone
			$LDAP_OfficePhone = "";
			
			if (!empty($entries[$x]['ipphone'][0])) {
				$LDAP_OfficePhone = $entries[$x]['ipphone'][0];
				if ($LDAP_OfficePhone == "NULL"){
					$LDAP_OfficePhone = "";
				}
			}
			
			//FAX Number
			$LDAP_OfficeFax = "";
			
			if (!empty($entries[$x]['facsimiletelephonenumber'][0])) {
				$LDAP_OfficeFax = $entries[$x]['facsimiletelephonenumber'][0];
				if ($LDAP_OfficeFax == "NULL"){
					$LDAP_OfficeFax = "";
				}
			}
			
			//Mobile Number
			$LDAP_CellPhone = "";
			
			if (!empty($entries[$x]['mobile'][0])) {
				$LDAP_CellPhone = $entries[$x]['mobile'][0];
				if ($LDAP_CellPhone == "NULL"){
					$LDAP_CellPhone = "";
				}
			}
			
			//Telephone Number
			$LDAP_DDI = "";
			
			if (!empty($entries[$x]['telephonenumber'][0])) {
				$LDAP_DDI = $entries[$x]['telephonenumber'][0];
				if ($LDAP_DDI == "NULL"){
					$LDAP_DDI = "";
				}
			}
			
			//Email address
			$LDAP_InternetAddress = "";
			
			if (!empty($entries[$x]['mail'][0])) {
				$LDAP_InternetAddress = $entries[$x]['mail'][0];	
				if ($LDAP_InternetAddress == "NULL"){
					$LDAP_InternetAddress = "";
				}
			}
			
			//Home phone
			$LDAP_HomePhone = "";
			
			if (!empty($entries[$x]['homephone'][0])) {
				$LDAP_HomePhone = $entries[$x]['homephone'][0];
				if ($LDAP_HomePhone == "NULL"){
					$LDAP_HomePhone = "";
				}
			}
			
			echo "<tr><td><strong>" . $LDAP_samaccountname ."</strong></td><td>" .$LDAP_LastName."</td><td>".$LDAP_FirstName."</td><td>".$LDAP_CompanyName."</td><td>".$LDAP_Department."</td><td>".$LDAP_OfficePhone."</td><td>".$LDAP_OfficeFax."</td><td>".$LDAP_CellPhone."</td><td>".$LDAP_DDI."</td><td>".$LDAP_InternetAddress."</td><td>".$LDAP_HomePhone."</td></tr>";
 
			
		} //END for loop
	} //END FALSE !== $result
	
	ldap_unbind($ldap_connection); // Clean up after ourselves.
	echo("</table>"); //close the table
 
} //END ldap_bind
 
?>