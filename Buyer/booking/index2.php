<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shopping Cart System</title>
 <!--  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' /> -->
</head>

<body>
  <!-- Navbar start -->
 
  <!-- Navbar end -->

  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    
      <?php

require 'config.php';
$user_id=$_SESSION['user_id'];
/*$query="select 'paper_sell' as 'Paper','plastic_sell' as 'Plastic',u_nic_no from  update_bin "; */
 //$query="select * from update_bin";
$query = "SELECT * FROM update_bin INNER JOIN user ON update_bin.u_nic_no = user.u_nic_no ";
$result = mysqli_query($conn, $query);


$queryA="select * from g_prices";
$resultA=mysqli_query($conn,$queryA);


$queryb = mysqli_query($conn,"SELECT b_garbage FROM buyers3 WHERE  user_id='$user_id'"); 

while($row_b = mysqli_fetch_assoc($queryb))
			{
       
				$row1 = $row_b['b_garbage'];
				$row1 = trim($row1);
			    $b= explode(',', $row1);
			}
      ?>
 


 
                            <?php
                            /*
                            echo '<table>';
                            echo "<tr>";
                            echo "<th>"."NIC No"."</th>";
                            echo "<th>"."Garbage"."</th>";
                            echo "<th>"."Quantity"."</th>";
                            echo "<th>"."Action"."</th>";
                            echo "</tr>";
                            echo "<tr>";*/


                            while($rowA=mysqli_fetch_assoc($resultA)):
                              while($u_garbage=mysqli_fetch_assoc($result))
                                                    
                            {
                              ?>
                             <?php
                            echo '<form action="" class="form-submit">';
            $date=date("Y-m-d");
                      ?>


<?php
                            if(isset($u_garbage['e_waste_sell']) && in_array('Ewaste',$b))
                            {   
                              if($u_garbage['e_waste_sell']!== '0')   {              
                            ?>
<tr>

                        <div class="row">
                    <td>   <div class="col"> <?= $u_garbage['u_nic_no']?></div></td> 
                       <td>    <div class="col"> Ewaste</div></td> 
                      <td>     <div class="col"> <input type="number" class="form-control pqty" value="<?= $u_garbage['e_waste_sell'] ?>"></div></td> 
                       <td>     <div class="col"> <input type="text" class="form-control route" value="<?php echo $u_garbage['route'];?>" readonly></div></td> 
                       <td>    <div class="col"> <input type="date" class="form-control date" value="<?php  echo date('Y-m-d',strtotime($date.' + 3 days'));?>"></div></td> 
                        <!-- <div class="col"> <input type="time" class="form-control time"></div> -->
                        <input type="hidden" class="form-control time">

                    <td>       <div class="col">  <button class="btn btn-info btn-block text-light addItemBtn2"><i class="fas fa-truck"></i>&nbsp;&nbsp;Add to
                                            List</button></div>
                                            </td> 
                                            </div>


                            <input type="hidden" class="u_nic_no" value="<?=$u_garbage['u_nic_no']?>">
                            <input type="hidden" class="pname" value="Ewaste">
                            <input type="hidden" class="pprice" value="<?=$rowA['Ewaste']?>">
                     
                            <input type="hidden" class="pcode" value="<?= $u_garbage['u_nic_no']."Ewaste".$u_garbage['e_waste_sell'] ?>">
                            <input type="hidden" class="b_nic_num" value='<?php echo $b11?>'>
               
               
                            <?php }} ?>







</tr>








                          









                                                    

                                                    <?php echo "</form>"?>
                                                   
                                                     <?php }endwhile; ?>
  </div>
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">

 
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn2").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
    
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();

      var pcode = $form.find(".pcode").val();
      var route = $form.find(".route").val();
      var pqty = $form.find(".pqty").val();
      var u_nic_no=$form.find(".u_nic_no").val();
      var b_nic_num= $form.find(".b_nic_num").val();
      var date = $form.find(".date").val();

       var time = $form.find(".time").val();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
        
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          u_nic_no: u_nic_no,
          pcode: pcode,
          date:date,
          time:time,
          route:route,
          b_nic_num:b_nic_num
        },
        success: function(response) {
          $("#message").html(response);
          window.scrollTo(0, 0);


        }
      });
    });




    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });

























  
  </script>
</body>

</html>