<?php
ob_start();
session_start();
header("Content-type:text/html;charset=utf-8");

$link = mysqli_connect('localhost','root','','a');
mysqli_set_charset($link, "utf8");
if (!$link) {
  die("连接失败:".mysqli_connect_error());
}

?>
<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>投票系统</title>
  <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.12.4/jquery.js"></script>
  <style type="text/css">
    /*全局样式*/
    body { font-family: "宋体"; font-size: 12pt; color: #333333; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;background-color: #A6C7E1;}
    table { font-family: "宋体"; font-size: 9pt; line-height: 20px; color: #333333}
    a:link { font-size: 9pt; color: #333333; text-decoration: none}
    a:visited { font-size: 9pt; color: #333333; text-decoration: none}
    a:hover { font-size: 9pt; color: #E7005C; text-decoration: underline}
    a:active { font-size: 9pt; color: #333333; text-decoration: none}
    /*全局样式结束*/
  </style>
  <script language="javascript">
    function check()
    {
      node=frm.itm;
      flag=false;
      for(i=0;i<node.length;i++)
      {
        if(node[i].checked)
        {
          flag=true;
        }
      }
      if(!flag)
      {
        alert("您没有选择")
        return false;
      }
      return true;
    }
  </script>

  <?php

  if(isset($_POST["submit"])){

    if($_POST){
      $id = $_POST["selected_id"];
      $sql = "update voto set count = count+1 where id=$id";
      mysqli_query($link,$sql);

    }

    if($_SESSION["voto"]==session_id())
    {
      ?>
      <script language="javascript">
        alert("您已经投票了");
        location.href="index.php";
      </script>
    <?php
    exit();
    }
    $id=$_POST["itm"];
    $sql="update voto set count=count+1 where id=$id";
    if(mysqli_query($link,$sql))
    {
    $_SESSION["voto"]=session_id();
    ?>
      <script language="javascript">alert("投票成功,点确定查看结果");location.href="index.php?id=ck";</script>
    <?php
    }
    else
    {
    ?>
      <script language="javascript">alert("投票失败");location.href="index.php";</script>
      <?php
    }
  }
  ?>

</head>
<body>
<form name="frm" action="" method="post" onsubmit=return(check()) style="margin-bottom:5px;">
  <table width="365" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2">
    <tr>
      <th bgcolor="#FFFFCC">
        <?php
        $sql="select * from vototitle";
        $rs=mysqli_query($link,$sql);
        $row=mysqli_fetch_assoc($rs);
        echo $row["vototitle"];
        ?> </th>
    </tr>
    <?php
    $sql="select * from voto";
    $rs=mysqli_query($link,$sql);
    while($rows=mysqli_fetch_assoc($rs))
    {
      ?>
      <tr>
        <td bgcolor="#FFFFFF"><input type="radio" name="itm" value="<?php echo $rows["id"]?>" />  
          <?php echo $rows["item"]?></td>
      </tr>
      <?php
    }
    ?>
    <tr>
      <td align="center" bgcolor="#FFFFFF">
        <input type="submit" name="submit" value="投票"/>
        <input type="hidden" id="selected_id" name="selected_id" value="">
        <input type="button" value="查看结果" onClick="location.href='index.php?id=ck'"/>  
        <script type="text/javascript">
            $("[type='radio']").click(function(){
               $("#selected_id").val($(this).val());
            });
        </script></td>
    </tr>
  </table>
</form>
<?php

if(isset($_GET["id"])=="ck"){?>
  <?php

  $sql="select sum(count) as 'total' from voto";
  $rs=mysqli_query($link,$sql);
  $rows=mysqli_fetch_assoc($rs);
  $sum=$rows["total"];  //得出总票数

  $sql="select * from voto";
  $rs=mysqli_query($link,$sql);
  ?>
  <table id="click" width="365" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2" >
    <tr>
      <th bgcolor="#FFFFFF">项目</th>
      <th bgcolor="#FFFFFF">票数</th>
      <th bgcolor="#FFFFFF">百分比</th>
    </tr>
    <?php
    while($rows=mysqli_fetch_assoc($rs))
    {
      ?>
      <tr>
        <td bgcolor="#FFFFFF"><?php echo $rows["item"]?></td>
        <td bgcolor="#FFFFFF"><?php echo $rows["count"]?></td>
        <td bgcolor="#FFFFFF">
          <?php
          $per=$rows["count"]/$sum;
          $per=number_format($per,4);
          ?>
          <img src="" height="4" width="<?php echo $per*100?>" />
          <?php echo $per*100?>%      </td>
      </tr>
      <?php
    }
    ?>
  </table>
  <div align="center">
    <a href="index.php">隐藏结果</a>
  </div>
<?php } ?>
</body>
</html>