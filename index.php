<?php
require_once 'class.user.php'; // require the class

$user = new User(); //define the class

if (isset($_REQUEST['submit'])) {
	extract($_REQUEST);
  
  if (preg_match("/([<%\$#|\*|>]+)/", $username)) {
	die('You are not allowed to use these characters');
	}
	
	$register = $user->add_user($username, $password, $email); //add the user if all checks are successful.

	if ($register) {
	echo 'Registration failed. Email or Username already exits please try again'; //it will only return this if a check fails.
	}
	else {
	echo 'Registration successful';
	}
}

?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<script type="text/javascript" language="javascript">
 function submitreg() {
 var form = document.reg;
 else if(form.username.value == ""){
 alert( "Enter username." );
 return false;
 }
 else if(form.password.value == ""){
 alert( "Enter password." );
 return false;
 }
 else if(form.email.value == ""){
 alert( "Enter email." );
 return false;
 }
 }
</script>
<div id="container">
<h1>Registration Here</h1>
<form action="" method="post" name="reg">
<table>
<tbody>
<tr>
<th>User Name:</th>
<td><input type="text" name="username" required="" /></td>
</tr>
<tr>
<th>Email:</th>
<td><input type="text" name="email" required="" /></td>
</tr>
<tr>
<th>Password:</th>
<td><input type="password" name="password" required="" /></td>
</tr>
<tr>
<td></td>
<td><input onclick="return(submitreg());" type="submit" name="submit" value="Register" /></td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>
</form></div>
