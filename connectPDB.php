<?php

$conn = oci_connect('Appliance', 'Abcdefg', 'localhost:1521/pdb1.home');
if (!$conn) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	printf("Connection failed");
	exit();
 }

?>