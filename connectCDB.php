<?php
// Connects to the XE service (i.e. database) on the "localhost" machine
$cond = oci_connect('SYS', 'Abcdefg1', 'localhost:1521/orcl.home', 'UTF8', OCI_SYSDBA);

if (!$cond) {
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stidp = oci_parse($cond, 'ALTER PLUGGABLE DATABASE pdb1 OPEN read write force');
oci_execute($stidp);

?>