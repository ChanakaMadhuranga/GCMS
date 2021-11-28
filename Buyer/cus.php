<?php 
require_once('process.php'); 
?>
<html>
<head>
<title></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


</head>
<body  style="background-repeat:no-repeat;background-attachment:fixed; background-image: linear-gradient(to right top, #f1b7cd, #e9a5bd, #e093ae, #d7809e, #ce6e8e, #ce6f8e, #cd6f8f, #cd708f, #d584a0, #dd98b1, #e5abc2, #ecbfd2);";
>
    <?php
     if(isset($_SESSION['message']));
     ?>

<div class="alert alert-<?php $_SESSION['msg_type'];?>">
<?php echo ($_SESSION['message']);
unset($_SESSION['message']); ?>
</div>
<?php ?>
  <div class="container">
  <?php
   $mysqli=new mysqli('localhost','root','','dcms_db') or die(mysqli_error($mysqli));
   $result=$mysqli->query("select * from price1") or die($mysqli->error);?>
      
      <div class="row justify-content-center">
      <table class="table">
        <thead>
            <tr>
                <th>garbage</th>
                <th>price</th>
                <th>Action</th>

            </tr>
        </thead>
    <?php  
        while($row=$result->fetch_array())
        {
    ?>
<tr>
    <td><?php  echo $row['garbage'];  ?></td>
    <td><?php  echo $row['price'];?></td>
    <td><a href="cus.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
        <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a></td>
</tr>
<?php 
}
?>

</table>
</div>
      <?php  function pre_r($array)
        {
            echo '<pre>';
                print_r($array);
                echo '</pre>';
        }
        ?>
  <form class="row gy-2 gx-3 align-items-center" action="process.php" method="POST">
    <div class="col-auto">
        <input type="hidden" name="id" class="form-control" value="<?php echo $id;?>">
      <label class="visually-hidden" for="autoSizingInput">Name</label>
      <input type="text" class="form-control" id="autoSizingInput" name="price" value="<?php echo $price;?>" placeholder="Add price for garbage">
    </div>

        <div class="col-auto">
          <label class="visually-hidden" for="autoSizingSelect">Preference</label>


          <select class="form-select" value="<?php echo $garbage;?>" id="autoSizingSelect" name="garbage">
            
            <option value="Plastic" >Plastic</option>
            <option value="Metal">Metal</option>
            <option value="Glass">Glass</option>
            <option value="Organic">Organic</option>
            <option value="Polythene">Polythene</option>
            <option value="Cardboard">Cardboard</option>
            <option value="Fabric">Fabric</option>
            <option value="E-Waste">E-Waste</option>
            <option value="Coconut Shell">Coconut Shell</option>

          </select>
        </div>
<div class="form-group">
    <?php if($update==true): ?>
        <button type="submit" class="btn btn-info" name="update">update</button>
<?php else: ?>
            <div class="col-auto">
          <button type="submit" class="btn btn-primary" name="save">Submit</button>
          <?php endif; ?>
          <button type="reset" class="btn btn-primary" name="Reset">Reset</button>
          <a class="btn btn-primary" href="h8.php" role="button">Back to page</a>
        </div>
    </div>
    </div>
      </form>
</body>
</html>
