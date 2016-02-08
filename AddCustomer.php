<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<body style="font-family:tahoma; font-size:12px">


<?php

include "connectpdb.php";
include "catalog_cls.php";

if(isset ( $_POST ["BuildingNum"] ))
{
$phone = $_SESSION["phone"];
echo $phone;								
$buildNum = htmlspecialchars($_POST ['BuildingNum']);
$street = htmlspecialchars($_POST ['Street']);
$apartment = htmlspecialchars($_POST ['Apartment']);
$isql = "Insert into customer(phone,building_num,street,apartment) values (:phone,:building_num,:street,:apartment)";
$istid = oci_parse($conn, $isql);
oci_bind_by_name ( $istid, ':phone', $phone );
oci_bind_by_name ( $istid, ':building_num', $buildNum );
oci_bind_by_name ( $istid, ':street', $street );
oci_bind_by_name ( $istid, ':apartment', $apartment);
$r = oci_execute($istid);
if(!$r)
{
	$e = oci_error($istid);
	echo htmlentities($e['message']);
	exit();
}
oci_free_statement($istid);

header("Location: orders.php");
}

?>



</body>
</html>