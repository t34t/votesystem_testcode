<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Electoral Role Search</title>
  <link rel="stylesheet" type="text/css" href="css/ballotpaper.css">
</head>

<body>


  <div class="speech-bubble">
    <div id="bubble-title">
      AU - Address Collection Form - Javascript
    </div>
    <div id="bubble-description">
      This example shows the AddressFinder widget being used to collect physical addresses - in Javascript.
    </div>
  </div>

  <form id="form-box" method="get">
    <div id="form-title">Shipping Address</div>

    <img src="image/ME.png" alt="MARRIAG EQUALITY" class="myimg">
    <input type="text" class="sort3" readonly></input>
    <input type="checkbox" name="checkwriter" value="西" style="width: 10px;" />
    <div class="rightbox1">
      <?php
      $conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

      $query = "select CANDIDATENAME from CANDIDATE where ELECTORATE_ELECTORATENAME = 'Hotham' AND POLITICALPARTY_PARTYCODE = 'LD'";
      $stid = oci_parse($conn, $query);
      $r = oci_execute($stid);

      if (!$r) {
        $err = oci_error();
        var_dump($err);
      }

      while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
        foreach ($row as $item) {

          print ($item ? htmlentities($item) : ' ') . '<br>' . 'Liberal Democrats';
        }
      }
      ?>

    </div> 
    <br><br>

    <img src="image/ME.png" alt="MARRIAG EQUALITY" class="myimg">
    <input type="text" class="sort3" readonly></input>
    <input type="checkbox" name="checkwriter" value="西" style="width: 10px;" />
    <div class="rightbox1">
      <?php
      $conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

      $query = "select CANDIDATENAME from CANDIDATE where ELECTORATE_ELECTORATENAME = 'Hotham' AND POLITICALPARTY_PARTYCODE = 'ALP'";
      $stid = oci_parse($conn, $query);
      $r = oci_execute($stid);

      if (!$r) {
        $err = oci_error();
        var_dump($err);
      }

      while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
        foreach ($row as $item) {

          print ($item ? htmlentities($item) : ' ') . '<br>' . 'Australian Labor Party';
        }
      }
      ?>
    </div> 

    <br><br>
    <img src="image/ME.png" alt="MARRIAG EQUALITY" class="myimg">
    <input type="text" class="sort3" readonly></input>
    <input type="checkbox" name="checkwriter" value="西" style="width: 10px;" />
    <div class="rightbox1">
      <?php
      $conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

      $query = "select CANDIDATENAME from CANDIDATE where ELECTORATE_ELECTORATENAME = 'Hotham' AND POLITICALPARTY_PARTYCODE = 'LTG'";
      $stid = oci_parse($conn, $query);
      $r = oci_execute($stid);

      if (!$r) {
        $err = oci_error();
        var_dump($err);
      }
      $flag = 0;
      while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
        foreach ($row as $item) {

          if($flag == 0){
            print ($item ? htmlentities($item) : ' ') . '<br>' . 'Louisa The Greens';
            $flag +=1;
            continue;
          }
          else{

          }
        }
      }
      ?>
    </div> 

    <br><br>
    <img src="image/ME.png" alt="MARRIAG EQUALITY" class="myimg">
    <input type="text" class="sort3" readonly></input>
    <input type="checkbox" name="checkwriter" value="西" style="width: 10px;" />
    <div class="rightbox1">
      <?php
      $conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

      $query = "select CANDIDATENAME from CANDIDATE where ELECTORATE_ELECTORATENAME = 'Hotham' AND POLITICALPARTY_PARTYCODE = 'LTG'";
      $stid = oci_parse($conn, $query);
      $r = oci_execute($stid);

      if (!$r) {
        $err = oci_error();
        var_dump($err);
      }
      $flag = 0;
      while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
        foreach ($row as $item) {
          if($flag == 0)
            {
              $flag += 1;
              continue;
            }
          else
            print ($item ? htmlentities($item) : ' ') . '<br>' . 'United Australia Party';
        }
      }
      ?>
    </div> 

    <br><br>
    <img src="image/ME.png" alt="MARRIAG EQUALITY" class="myimg">
    <input type="text" class="sort3" readonly></input>
    <input type="checkbox" name="checkwriter" value="西" style="width: 10px;" />
    <div class="rightbox1">
      <?php
      $conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

      $query = "select CANDIDATENAME from CANDIDATE where ELECTORATE_ELECTORATENAME = 'Hotham' AND POLITICALPARTY_PARTYCODE = 'PHON'";
      $stid = oci_parse($conn, $query);
      $r = oci_execute($stid);

      if (!$r) {
        $err = oci_error();
        var_dump($err);
      }

      while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
        foreach ($row as $item) {

          print ($item ? htmlentities($item) : ' ') . '<br>' . 'Pauline Hanson\'s One Nation';
        }
      }
      ?>
    </div> 

    <br><br>
    <img src="image/ME.png" alt="MARRIAG EQUALITY" class="myimg">
    <input type="text" class="sort3" readonly></input>
    <input type="checkbox" name="checkwriter" value="西" style="width: 10px;" />
    <div class="rightbox1">
      <?php
      $conn = oci_connect('myuser', 'mypassword', '172.16.56.172/xe');

      $query = "select CANDIDATENAME from CANDIDATE where ELECTORATE_ELECTORATENAME = 'Hotham' AND POLITICALPARTY_PARTYCODE = 'L'";
      $stid = oci_parse($conn, $query);
      $r = oci_execute($stid);

      if (!$r) {
        $err = oci_error();
        var_dump($err);
      }

      while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
        foreach ($row as $item) {

          print ($item ? htmlentities($item) : ' ') . '<br>' . 'Liberal';
        }
      }
      ?>
    </div> 

   
    <input class="btn" type="submit" name="next" value="NEXT">

  </form>
</body>

</html>