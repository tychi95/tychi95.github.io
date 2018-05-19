<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

/* Array of room/bed types */
$a[]="Full";
$a[]="Queen";
$a[]="King";

$q=$_GET["room"];
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

if ($hint == ""){
	$suggestion="No rooms of that type";
} else{
	$suggestion=$hint;
}

echo $suggestion;
?>