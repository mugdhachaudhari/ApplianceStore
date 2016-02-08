<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>"Appliance Store"</title>
</head>
<body style="font-family:tahoma; font-size:12px">
<form action="findAppliances.php" method = "POST">
<table border = '0'>
<tr><td>Phone No</td><td><input type="text" maxlength="10" name="phone" style="font-family:tahoma; font-size:12px"></td></tr>
<tr><td>Search for</td><td><input type="text" maxlength="20" name="search" style="font-family:tahoma; font-size:12px"></td></tr>
<tr><td></td><td><input type="submit" value="Find Appliances" style="font-family:tahoma; font-size:12px"></td></tr>
</table>

<?php
if(isset($_GET['error']) && $_GET['error'] == 1)
{
	echo "<font color='red'>Enter valid phone number</font>";
	$_GET['error'] = 0;
	
}
else if(isset($_GET['error']) && $_GET['error'] == 2)
{
	echo "<font color='red'>There are no products for given search.</font>";
	$_GET['error'] = 0;
}
?>

</form>

</body>
</html>