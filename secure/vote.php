<?php
$conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

$query = 'select ELECTORATENAME from ELECTORATE';
$stid = oci_parse($conn, $query);
$r = oci_execute($stid);
if(!$r){

$err = oci_error();
        var_dump($err);
}

// use php read electorate from oralce

// Fetch the results in an associative array
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
   print '<tr>';
   foreach ($row as $item) {
      print '<td>'.($item?htmlentities($item):' ').'</td>';
      get_candidate($conn,$item);
   }
   print '</tr>';
}
print '</table>';

//according electorate get candidate from candidate table 
function get_candidate($conn,$electorate_from_db){
    print "<tr>";
    echo "Current electorate is :".$electorate_from_db."<br>";
    
    $query1 = "select * from CANDIDATE where ELECTORATE_ELECTORATENAME = '".$electorate_from_db."'";

    $stid = oci_parse($conn, $query1);
    $r = oci_execute($stid);

    if(!$r){

    $err = oci_error();
        var_dump($err);
    }
    
    print '<table border="1">';
    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
       print '<tr>';
       foreach ($row as $item) {
          print '<td>'.($item?htmlentities($item):' ').'</td>';
       }
       print '</tr>';
    }
    print '</table>';

    print "</tr>";
}

//next create html temolate and picture 


//last add some logical operation


// Close the Oracle connection
oci_close($conn);

?>