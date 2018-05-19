<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

/* Array of states types */
$a[]="New York";
$a[]="Illinois";
$a[]="Maryland";
$a[]="Florida";
$a[]="Washington D.C.";


$q=$_GET["state"];
if (strlen($q) > 0) {
	$hint="";
	for($i=0; $i<count($a); $i++) {
	if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q)))) {
		if ($hint=="") {
			$hint=$a[$i];
		} else {
			$hint=$hint.", ".$a[$i];
		}
	}
	}
}

if ($hint == "") {
	$suggestion="";
} else {
	$suggestion=$hint;
}

echo $suggestion;
?>