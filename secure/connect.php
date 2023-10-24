<?php

// Connects to the XE service (i.e. database) on the "localhost" machine
//$conn = oci_connect('system', 'systemuser', '172.16.56.172/XE');
//$conn = oci_connect('myuser', 'mypassword', '172.16.56.172/XE');


$conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

$query = 'select "name" from "testtable1"';
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);
if(!$r){

$err = oci_error();
        var_dump($err);
}


// Fetch the results in an associative array
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
   print '<tr>';
   foreach ($row as $item) {
      print '<td>'.($item?htmlentities($item):' ').'</td>';
   }
   print '</tr>';
}
print '</table>';

// Close the Oracle connection
oci_close($conn);
?>