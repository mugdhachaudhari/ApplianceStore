<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<body style="font-family:tahoma; font-size:12px">
<?php
include "connectpdb.php";
include "catalog_cls.php";
if (isset($_POST ["selectedApp"])) 
{
	$_SESSION ["order"] = $_POST ["selectedApp"]; 
	$phone = $_SESSION["phone"];
			
	$sql = "SELECT phone FROM customer where phone = :phone";
	$stid = oci_parse ( $conn, $sql );
	oci_bind_by_name ( $stid, ':phone', $phone );
	oci_execute ( $stid );
	
	if(!oci_fetch($stid))
	{
		echo "<form action='AddCustomer.php' method='POST'>";
		echo "<table border = '0'>\n";
		echo "<tr><td>BuildingNum </td><td><input type='text' maxlength='38' name='BuildingNum' style='font-family:tahoma; font-size:12px'></td></tr>";
		echo "<tr><td>Street </td><td><input type='text' maxlength='20' name='Street' style='font-family:tahoma; font-size:12px'></td></tr>";
		echo "<tr><td>Apartment </td><td><input type='text' maxlength='20' name='Apartment' style='font-family:tahoma; font-size:12px'></td></tr>";
		echo "<tr><td></td><td><input type='submit' value='Add Customer Details' style='font-family:tahoma; font-size:12px'></td></tr>";
		echo "</table>\n";
		echo "</form>";
		
	}
	
	else
	{
		
		header("Location: orders.php");
		
	}
	oci_free_statement($stid);
	oci_close($conn);
	
}
else
{
	echo "No order was placed<br>";
	session_unset();
	
	// destroy the session
	session_destroy();
	
}


?>


</body>
</html>
