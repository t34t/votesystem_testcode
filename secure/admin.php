<?php
ob_start(); //打开缓冲区 
session_start();
header("Content-type:text/html;charset=utf-8");

$link = mysqli_connect('localhost','root','','a');
mysqli_set_charset($link, "utf8");
if (!$link) {
  die("连接失败:".mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP+mysql开发的简单投票系统</title>
  <style type="text/css">
    /*全局样式*/
    body { font-family: "宋体"; font-size: 12pt; color: #333333; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;background-color: #d4d4d4;}
    table { font-family: "宋体"; font-size: 9pt; line-height: 20px; color: #333333}
    /*全局样式结束*/
  </style>
  <script language="javascript">
    function selectAll()
    {
      node=window.document.frm.itm;
      for(i=0;i<node.length;i++)
      {
        node[i].checked=true;//全选
      }
    }
    function cancelAll()
    {
      node=frm.itm;
      for(i=0;i<node.length;i++)
      {
        node[i].checked=false;//取消全部
      }
    }
    function del()
    {
      node=frm.itm;
      id="";
      for(i=0;i<node.length;i++)
      {
        if(node[i].checked)
        {
          if(id=="")//删除
          {
            id=node[i].value
          }
          else
          {
            id=id+","+node[i].value
          }
        }
      }
      if(id=="")
      {
        alert("您没有选择删除项");
      }
      else
      {
        location.href="?type=del&id="+id
      }
    }
  </script>
</head>
<body>

<?php
if(isset($_GET['tj']) == 'out'){
  session_destroy();//删除当前用户对应的session文件以及释放session
  echo "<script language=javascript>alert('退出成功！');window.location='index.php'</script>";
}
?>

<?php
if(isset($_POST['Submit10'])){
  if($_POST['pwd']=='admin'){

    $_SESSION['pwd']=2;

    echo "<script language=javascript>alert('登陆成功！');window.location='admin.php'</script>";
  }else{
    echo "<script language=javascript>alert('登陆失败,请检查您的密码！');window.location='admin.php'</script>";
  }
}
?>

<?php if($_SESSION['pwd']<>2){ ?>
  <form action="" method="post">
    <table width="365" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2">
      <tr>
        <td height="30" align="right" bgcolor="#FFFFFF"><label>输入密码：</label></td>
        <td align="left" bgcolor="#FFFFFF"><input name="pwd" type="text" id="pwd" /></td>
      </tr>
      <tr>
        <td height="30" colspan="2" align="center" bgcolor="#FFFFFF"><label>
            <input name="Submit10" type="submit" id="Submit10" value="登陆" />
          </label>
          <label>  
            <input type="reset" name="Submit5" value="重置" />
          </label></td>
      </tr>
      <tr>
        <td height="30" colspan="2" align="center" bgcolor="#FFFFFF">
          软件版本：<script type="text/javascript" src="http://www.04ie.com/net/phpvoto1_1.js"></script></td>
      </tr>
    </table>
  </form>
<?php }else{ ?>
<?php
if(isset($_POST["Submit"]))
{
$title=$_POST["title"];
$sql="update vototitle set vototitle='$title'";
mysqli_query($link,$sql);
?>
  <script language="javascript">
    alert("修改成功");
  </script>
<?php
}
if(isset($_POST["Submit2"]))
{
  $newitem=$_POST["newitem"];
  $sql="insert into voto (titleid,item,count) values (1,'$newitem',1)";
  mysqli_query($link,$sql);

}
?>
  <form id="frm" name="frm" method="post" action="" style="margin-bottom:3px;">
    <table width="365" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2">
      <tr>
        <td colspan="4" bgcolor="#FFFFFF"><label>
            <?php
            $sql="select * from vototitle";
            $rs=mysqli_query($link,$sql);
            $rows=mysqli_fetch_assoc($rs);
            ?>
            <input name="title" type="text" id="title" size="35" value="<?php echo $rows["vototitle"]?>" />
          </label></td>
        <td width="68" align="center" bgcolor="#FFFFFF"><label>
            <input type="submit" name="Submit" value="修改标题" />
          </label></td>
      </tr>
      <tr>
        <th width="30" bgcolor="#FFFFFF">编号</th>
        <th width="45" bgcolor="#FFFFFF">项目</th>
        <th width="52" bgcolor="#FFFFFF">票数</th>
        <th width="50" align="center" bgcolor="#FFFFFF">修改</th>
        <th align="center" bgcolor="#FFFFFF">删除</th>
      </tr>
      <?php
      $sql="select * from voto order by count desc";
      $rs=mysqli_query($link,$sql);
      while($rows=mysqli_fetch_assoc($rs))
      {
        ?>
        <tr>
          <td align="center" bgcolor="#FFFFFF"><input type="checkbox" name="itm" value="<?php echo $rows["id"]?>" /><?php echo $rows["id"]?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $rows["item"]?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $rows["count"]?></td>
          <td align="center" bgcolor="#FFFFFF"><input type="button" value="修改" onclick="location.href='?type=modify&id=<?php echo $rows["id"]?>'" /></td>
          <td align="center" bgcolor="#FFFFFF"><input type="button" value="删除" onclick="location.href='?type=del&id=<?php echo $rows["id"]?>'"  /></td>
        </tr>
        <?php
      }
      ?>
      <tr>
        <td colspan="5" align="center" bgcolor="#FFFFFF">
          <input type="button" value="选择全部" onclick="selectAll()" />
          <input type="button" value="取消全部" onclick="cancelAll()" />
          <input type="button" value="删除所选" onclick="del()" />   </td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#FFFFFF"><label>
            <input name="newitem" type="text" id="newitem" />
          </label></td>
        <td colspan="2" bgcolor="#FFFFFF"><label>
            <input type="submit" name="Submit2" value="添加新项" />
              </label>
          <a href="?tj=out">退出管理</a></td>
      </tr>
    </table>
  </form>

<?php
$type = isset($_GET["type"])?$_GET["type"]:"";
if($type =="modify"){

$id=$_GET["id"];
if(isset($_POST["Submit3"]))
{
  $item=$_POST["itm"];
  $count=$_POST["count"];
  $sql="update voto set item='$item',count=$count where id=$id";
  mysqli_query($link,$sql);
  echo "<script language=javascript>alert('修改成功！');window.location='admin.php'</script>";
}
$sql="select * from voto where id=$id";
$rs=mysqli_query($link,$sql);
$rows=mysqli_fetch_assoc($rs);
?>
  <form id="form1" name="form1" method="post" action="" style="margin-top:2px;">
    <table width="365" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2">
      <tr>
        <th colspan="2" bgcolor="#FFFFFF">修改投票项目</th>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">名称:</td>
        <td bgcolor="#FFFFFF"><label>
            <input name="itm" type="text" id="itm" value="<?php echo $rows["item"]?>" />
          </label></td>
      </tr>
      <tr>
        <td align="center" bgcolor="#FFFFFF">票数：</td>
        <td bgcolor="#FFFFFF"><label>
            <input name="count" type="text" id="count" value="<?php echo $rows["count"]?>" />
          </label></td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#FFFFFF"><label>
            <input type="submit" name="Submit3" value="修改" />
            <input type="reset" name="Submit" value="重置" />
          </label></td>
      </tr>
    </table>
  </form>

  <?php
}
  ?>
  <?php
  $type = isset($_GET["type"])?$_GET["type"]:"";
  if($type =="del"){
    $id=$_GET["id"];
    $sql="delete from voto where id in ($id)";
    mysqli_query($link,$sql);
    echo "<script language=javascript>alert('删除成功！');window.location='admin.php'</script>";
  }
  ?>
<?php } ?>
</body>
</html>
