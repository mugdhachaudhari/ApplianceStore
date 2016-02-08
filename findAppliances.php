	<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<body style="font-family:tahoma; font-size:12px">

<?php
include "connectcdb.php";
include "connectpdb.php";
include "catalog_cls.php";

if (isset ( $_POST ["phone"] )) {
	$phone = trim ( $_POST ["phone"] );
	
	if (is_numeric ( $phone ) && strlen ( $phone ) == 10) {
		$_SESSION ["phone"] = $phone;
		echo "Welcome $phone<br>";
		echo "You searched for " . $_POST ['search'] . "<br>";
		$search_cd = "%" . strtoupper(htmlspecialchars(trim ($_POST ['search']), ENT_QUOTES)) . "%";
		
		$sql = "SELECT aname, config, price FROM catalog where UPPER(aname) like :aname and upper(status) =  'AVAILABLE' order by aname, config";
		$stid = oci_parse ( $conn, $sql );
		oci_bind_by_name ( $stid, ':aname', $search_cd );
		
		oci_define_by_name ( $stid, 'ANAME', $aname );
		oci_define_by_name ( $stid, 'CONFIG', $config );
		oci_define_by_name ( $stid, 'PRICE', $price );
				
		oci_execute ( $stid );
		
	
		//$checkboxes = "<input type='checkbox' name='selected[$cakename]' value= '$cakename' />";
		// Printing results in HTML


echo "<form action='CustomerDetails.php' method='POST'>";

echo "<br><table border = '1'>\n";
$i =0;
while (oci_fetch($stid))
{
	if ($i == 0)
	{
		echo "<tr>";
		echo "<th>Select</th><th>Appliance</th><th>Config</th><th>Price</th>";
		echo "</tr>\n";
	}
	
	$catalogObject = new catalog_cls();
	$catalogObject->setAname($aname);
	$catalogObject->setConfig($config);
	$catalogObject->setPrice($price);
	
	$serialized = htmlspecialchars(serialize($catalogObject), ENT_QUOTES);
	
	echo "<tr>";
	echo "<td><input type='radio' name='selectedApp' value='$serialized'/></td><td>$aname</td><td>$config</td><td>$price</td>";
	echo "</tr>\n";
	$i++;
	
}

if($i == 0)
{
	$message = "There is no product for given search " .$search_cd;
	header("Location: inputForm.php?error=2");
}
	
echo "</table>\n";		
	echo "<br><input type='submit' value='Submit Orders' style='font-family:tahoma; font-size:12px'>";
echo "</form>";	
	

		oci_free_statement($stid);
		oci_close($conn); 
	}
	
	
	else 
	{
		session_unset();
		session_destroy();
		$message = 'Enter Phone number';
		header("Location: inputForm.php?error=1");
		
	}

	
}
?>


</body>
</html>