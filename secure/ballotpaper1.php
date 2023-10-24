<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Electoral Role Search</title>
  <link rel="stylesheet" type="text/css" href="css/ballotpaper.css">
</head>
<body>

<div class="speech-bubble">
     <!-- <div id="bubble-title">
    AU - Address Collection Form - Javascript
  </div>-->
  <div id="bubble-description">
    This example shows the AddressFinder widget being used to collect physical addresses - in Javascript.
  </div>
</div>

<form id="form-box" method="get">
  <div id="form-title">Victoria Electoral Division of Higgins</div>
  <label>Number the boxes from 1 to 8 in the order of your choice.</label>
   <div>
    <br>
  <img src="image/ME.png" class="MEimg" alt="MARRIAG EQUALITY" width="35" height="35">
  <input type="text" class="sort3"></input>
  <input type="checkbox" name="direction3" value="西" style="width: 0px;"/>  <?php 
  $conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

  $query = "select CANDIDATENAME from CANDIDATE where ELECTORATE_ELECTORATENAME = 'Hotham' AND POLITICALPARTY_PARTYCODE='LD'";
  $stid = oci_parse($conn, $query);
  $r = oci_execute($stid);

  if(!$r){

      $err = oci_error();
      var_dump($err);
  } 

  while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
   
      foreach ($row as $item) {
          print '<td>'.($item?htmlentities($item):' ').'</td>'.'<br>'.'test';
      }
  }
?>

</div>

  <div class="form-header">Address Line 1</div>
  <input type="search" class="form-input" id="addrs_1" placeholder="Search address here..."></input>
  
  <div class="form-header">Address Line 2</div>
  <input type="text" class="form-input" id="addrs_2"></input>
  
  <div class="form-header">Suburb</div>
  <input type="text" class="form-input" id="suburb"></input>
  
  <div class="form-header">State</div>
  <input class="form-input" id="state"></input>
  
  <div class="form-header">Postcode</div>
  <input class="form-input" id="postcode"></input>

  <input class="btn" type="submit" name="next" value="NEXT">
  
</form>
</body>
</html>