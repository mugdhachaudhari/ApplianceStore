<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<body style="font-family:tahoma; font-size:12px">

<?php
include "connectpdb.php";
include "catalog_cls.php";

	echo "Thank you " . $_SESSION["phone"] . ".<br>";
	$order = $_SESSION["order"];
	$catalogObject = unserialize($order);	
	
	$phone = $_SESSION["phone"];
	$aname = $catalogObject->getAname();
	$config = $catalogObject->getConfig();
	$price = $catalogObject->getPrice();
	
	echo "Your Order is <br>  Appliance name :" . $aname . " Configuration : " . $config . " Price : " . $price . "<br>";
	
/* 	echo  $catalogObject->getAname();
	echo "<br>";
	echo $catalogObject->getConfig();
	echo "<br>";
	echo $catalogObject->getPrice();
	echo "<br>"; */
	
	
	
	
	
	
	$sql = "select phone, aname, config from orders where phone = :phone and aname = :aname and config = :config and upper(status) = 'PENDING'";
	$stid = oci_parse($conn, $sql);
	oci_bind_by_name($stid, ':phone', $phone);
	oci_bind_by_name($stid, ':aname', $aname);
	oci_bind_by_name($stid, ':config', $config);
	
	oci_execute ( $stid );
	
	if(oci_fetch($stid))
	{
		$usql = "Update orders set quantity = quantity + 1, price = price + :price, O_time = sysdate, status = 'pending' where phone = :phone and aname = :aname and config = :config and upper(status) = 'PENDING'";
		$ustid = oci_parse($conn, $usql);
		oci_bind_by_name($ustid, ':phone', $phone);
		oci_bind_by_name($ustid, ':aname', $aname);
		oci_bind_by_name($ustid, ':config', $config);
		oci_bind_by_name($ustid, ':price', $price);
		
		$r = oci_execute($ustid);
		if(!$r)
		{
			$e = oci_error($ustid);
			echo htmlentities($e['message']);
			exit();
		}
		oci_free_statement($ustid);
		
// 		$usql = "select phone, aname, config, quantity, price from orders where phone = :phone and aname = :aname and config = :config and upper(status) = 'PENDING'";
// 		$ustid = oci_parse($conn, $sql);
// 		oci_bind_by_name($ustid, ':phone', $phone);
// 		oci_bind_by_name($ustid, ':aname', $aname);
// 		oci_bind_by_name($ustid, ':config', $config);
		
		
		
// 		oci_execute ( $ustid );
		
	}
	
	else 
	{
		$isql = "Insert into orders(phone, aname, config, o_time, quantity, price, status) values (:phone, :aname, :config, sysdate, 1, :price, 'pending')";
		$istid = oci_parse($conn, $isql);
		oci_bind_by_name($istid, ':phone', $phone);
		oci_bind_by_name($istid, ':aname', $aname);
		oci_bind_by_name($istid, ':config', $config);
		oci_bind_by_name($istid, ':price', $price);
		
		$r = oci_execute($istid);
		if(!$r)
		{
			$e = oci_error($istid);
			echo htmlentities($e['message']);
			exit();
		}
		oci_free_statement($istid);
	}
	
	oci_free_statement($stid);
	oci_close($conn);

session_unset();

// destroy the session
session_destroy();

?>

<br>
<a href="http://localhost:8080/projects/inputForm.php">Back to Main Page</a>
</body>
</html>