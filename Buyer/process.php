<?php
session_start();?>

<?php include('functions.php');?>

<?php
$mysqli=new mysqli('localhost','root','','dcms_db') or die(mysqli_error($mysqli));
$update=false;
$id=0;
$garbage=' ';
$price=0;
if(isset($_POST['save']))
{
    $garbage=$_POST['garbage'];
    $price=$_POST['price'];
    $b_nic_num=$_SESSION['b_nic_num'];

    $mysqli->query("insert into price1(garbage,price,b_nic_num) values('$garbage','$price','$b_nic_num')") or die($mysqli->error);


    $_SESSION['message']="Record has been saved";
    $_SESSION['msg_type']="success";

    header("location:cus.php");
}

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $mysqli->query("delete from price1 where id='$id'") or die($mysli->error());

    $_SESSION['message']="Record has been delete";
    $_SESSION['msg_type']="Danger";

    header('location:cus.php');

}
/*if(isset($_POST['garbage']))
{
    $garbage1=$_POST['garbage'];
}*/
if(isset($_GET['edit']))
{
    $id=$_GET['edit'];
    $update=true;
    $result=$mysqli->query("select * from price1 where id='$id'") or die($mysqli->error());

    if(count($result)==1)
    {
        $row=$result->fetch_array();
        $garbage=$row['garbage'];
        $price=$row['price'];
    }

}

if(isset($_POST['update']))
{
    $id=$_POST['id'];
    $garbage=$_POST['garbage'];
    $price=$_POST['price'];

    $mysqli->query("update price1 set garbage='$garbage',price='$price' where id='$id' ") or die($mysqli->error);

    $_SESSION['message']="Record has been updated";
    $_SESSION['msg_type']="Warning";
header('location:cus.php');
}
?>
