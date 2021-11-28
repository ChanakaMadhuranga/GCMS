<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<!DOCTYPE html>
<html>
<head>

	<title></title>
	<!-- <script type="text/javascript">
        function add_row()
        {
            $rowno=$("#employee_table tr").length;
            $rowno=$rowno+1;
            $("#employee_table tr:last").after("<tr id='row"+$rowno+"'><td><select class='form-select' aria-label='Default select example'><option selected>Open this select menu</option><option value='1'>One</option><option value='2'>Two</option><option value='3'>Three</option></select></td><td><input class='form-control' type='text' name='quantity[]' placeholder='Enter Quantity'></td><td><select class='form-select' aria-label='Default select example'><option selected>Open this select menu</option><option value='Yes'>Yes</option><option value='No'>No</option></select></td><td><button class='btn btn-xs btn-danger' type='button' onclick=delete_row('row"+$rowno+"')>-</button></td></tr>");
        }
     	function delete_row(rowno)
      	{
          $('#'+rowno).remove();
      	}
	</script>
 -->
    <style type="text/css">
      #body{
      background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
        }

        html{
          height: 100%;
        }
      body{
          min-height: 100%;
        }

    </style>

	<!-- Font Awesome -->
	<link
	  href="css/bootstrap.min.css"
	  rel="stylesheet"
	/>
</head>



<body id="body">

<?php
    if(isset($_POST['sasa'])){
      

      //  print_r($_POST);


      //  echo "".
       $plastic_not_sell    = $_POST['plastic_not_sell']; 
      //  echo "".
       $plastic_sell    = $_POST['plastic_sell'];
       
       $organic_not_sell    = $_POST['organic_not_sell'];
      //  echo "".
       $organic_sell    = $_POST['organic_sell'];
      //  echo "".
       $polythene_not_sell   = $_POST['polythene_not_sell'];
      //  echo "".
       $polythene_sell    = $_POST['polythene_sell'];
      //  echo "".
       $metal_not_sell    = $_POST['metal_not_sell'];
      //  echo "".
       $metal_sell    = $_POST['metal_sell'];
      //  echo "".
       $paper_not_sell    = $_POST['paper_not_sell'];
      //  echo "".
       $paper_sell    = $_POST['paper_sell'];
      //  echo "".
       $coconut_shell_not_sell    = $_POST['coconut_shell_not_sell'];
      //  echo "".
       $coconut_shell_sell    = $_POST['coconut_shell_sell'];
      //  echo "".
       $glass_not_sell    = $_POST['glass_not_sell'];
      //  echo "".
       $glass_sell    = $_POST['glass_sell'];
      //  echo "".
       $fabric_not_sell    = $_POST['fabric_not_sell'];
      //  echo "".
       $fabric_sell    = $_POST['fabric_sell'];
      //  echo "".
       $e_waste_not_sell    = $_POST['e_waste_not_sell'];
      //  echo "".
       $e_waste_sell    = $_POST['e_waste_sell'];
       $my_date = date("Y-m-d H:i:s"); 
      //  echo "".$my_date ."   ";
       $u_nic_no= $_SESSION['u_nic_no'];
      //  echo "".$u_nic_no."   ";


       $query="INSERT INTO `submit`( `u_nic_no`, `update_date`, `plastic_not_sell`, `plastic_sell`, `organic_not_sell`, `organic_sell`, `polythene_not_sell`, `polythene_sell`, `metal_not_sell`, `metal_sell`, `paper_not_sell`, `paper_sell`, `coconut_shell_not_sell`, `coconut_shell_sell`, `glass_not_sell`, `glass_sell`, `fabric_not_sell`, `fabric_sell`, `e_waste_not_sell`, `e_waste_sell`) VALUES 
       ('$u_nic_no', '$my_date' , '$plastic_not_sell','$plastic_sell','$organic_not_sell','$organic_sell' ,'$polythene_not_sell' ,'$polythene_sell','$metal_not_sell','$metal_sell','$paper_not_sell','$paper_sell' , '$coconut_shell_not_sell' , '$coconut_shell_sell'  ,'$glass_not_sell','$glass_sell' ,'$fabric_not_sell' ,'$fabric_sell' , '$e_waste_not_sell' ,'$e_waste_sell')";


       $query1="SELECT * FROM update_bin WHERE u_nic_no = '{$u_nic_no}'";

      $result = mysqli_query($connection, $query1);
      if(mysqli_num_rows($result) == 1){
          //valid user found
          $data = mysqli_fetch_assoc($result);
          //echo $data['id'];

          $newplastic_not_sell = doubleval($data['plastic_not_sell']) - doubleval($plastic_not_sell);
          $neworganic_not_sell = doubleval($data['organic_not_sell']) - doubleval($organic_not_sell);
          $newpolythene_not_sell = doubleval($data['polythene_not_sell']) - doubleval($polythene_not_sell);
          $newmetal_not_sell = doubleval($data['metal_not_sell']) - doubleval($metal_not_sell);
          $newpaper_not_sell = doubleval($data['paper_not_sell']) - doubleval($paper_not_sell);
          $newcoconut_shell_not_sell = doubleval($data['coconut_shell_not_sell']) - doubleval($coconut_shell_not_sell);
          $newglass_not_sell = doubleval($data['glass_not_sell']) - doubleval($glass_not_sell);
          $newfabric_not_sell = doubleval($data['fabric_not_sell']) - doubleval($fabric_not_sell);
          $newe_waste_not_sell = doubleval($data['e_waste_not_sell']) - doubleval($e_waste_not_sell);
          

          $newplastic_sell = doubleval($data['plastic_sell']) - doubleval($plastic_sell);
          $neworganic_sell = doubleval($data['organic_sell']) - doubleval($organic_sell);
          $newpolythene_sell = doubleval($data['polythene_sell']) - doubleval($polythene_sell);
          $newmetal_sell = doubleval($data['metal_sell']) - doubleval($metal_sell);
          $newpaper_sell = doubleval($data['paper_sell']) - doubleval($paper_sell);
          $newcoconut_shell_sell = doubleval($data['coconut_shell_sell']) - doubleval($coconut_shell_sell);
          $newglass_sell = doubleval($data['glass_sell']) - doubleval($glass_sell);
          $newfabric_sell = doubleval($data['fabric_sell']) - doubleval($fabric_sell);
          $newe_waste_sell = doubleval($data['e_waste_sell']) - doubleval($e_waste_sell);
          

        

           $query2="UPDATE update_bin
                   SET plastic_not_sell = '{$newplastic_not_sell}', plastic_sell= '{$newplastic_sell}', organic_not_sell = '{$neworganic_not_sell}', organic_sell = '{$neworganic_sell}',polythene_not_sell = '{$newpolythene_not_sell}',polythene_sell = '{$newpolythene_sell}',metal_not_sell = '{$newmetal_not_sell}',metal_sell = '{$newmetal_sell}',paper_not_sell = '{$newpaper_not_sell}',paper_sell = '{$newpaper_sell}',coconut_shell_not_sell = '{$newcoconut_shell_not_sell}',coconut_shell_sell = '{$newcoconut_shell_sell}',glass_not_sell = '{$newglass_not_sell}',glass_sell = '{$newglass_sell}',fabric_not_sell = '{$newfabric_not_sell}',fabric_sell = '{$newfabric_sell}',e_waste_not_sell = '{$newe_waste_not_sell}',e_waste_sell = '{$newe_waste_sell}'
                    WHERE u_nic_no = '{$u_nic_no}' ";

                     $result=mysqli_query($connection,$query2);



///////////////////////////////////////////////////////////////


 $val = 0;



      $cat = "SELECT * FROM bin_categories";
      $cat_data = mysqli_query($connection,$cat);
       if(!$cat_data){
        die("Error ".mysqli_error($connection));
      }
      else
      {
      while( $cat_res = mysqli_fetch_assoc($cat_data)){
       //echo $cat_res['category'];

     //  echo "\n<br>";

        if(($cat_res['category'] == 'plastic') && ($plastic_not_sell > 0) && ($plastic_sell > 0) )
        {
          $val+=(5*$plastic_sell) + (3*$plastic_not_sell);
        }
        elseif(($cat_res['category'] == 'plastic') && ($plastic_not_sell > 0) && ($plastic_sell < 0) ){
            $val+=3*$plastic_not_sell;
        }
        elseif(($cat_res['category'] == 'plastic') && ($plastic_not_sell < 0) && ($plastic_sell > 0) ){
            $val+=5*$plastic_sell;
        }



         if (($cat_res['category'] == 'organic') && ($organic_not_sell > 0) && ($organic_sell > 0 )) {
           $val +=(5*$organic_sell) + (3*$organic_not_sell);
         }
         elseif(($cat_res['category'] == 'organic') && ($organic_not_sell > 0) && ($organic_sell < 0 )){
           $val +=3*$organic_not_sell;
         }
         elseif(($cat_res['category'] == 'organic') && ($organic_not_sell < 0) && ($organic_sell > 0 )){
           $val +=5*$organic_sell;
         }


         if (($cat_res['category'] == 'polythene') && ($polythene_not_sell > 0) && ( $polythene_sell > 0)){
           $val +=(5*$polythene_sell) + (3*$polythene_sell);
         }
         elseif(($cat_res['category'] == 'polythene') && ($polythene_not_sell > 0) && ( $polythene_sell < 0)){
             $val +=3*$polythene_not_sell;
         }
         elseif(($cat_res['category'] == 'polythene') && ($polythene_not_sell < 0) && ( $polythene_sell > 0)){
             $val +=5*$polythene_sell;
         }


         if (($cat_res['category'] == 'metal') && ($metal_not_sell > 0) && ( $metal_sell > 0)) {
           $val +=(5*$metal_sell) + (3*$metal_not_sell);
         }
         elseif(($cat_res['category'] == 'metal') && ($metal_not_sell > 0) && ( $metal_sell < 0)){
             $val +=3*$metal_not_sell;
         }
         elseif(($cat_res['category'] == 'metal') && ($metal_not_sell < 0) && ( $metal_sell > 0)){
             $val +=5*$metal_sell;
         }


         if (($cat_res['category'] == 'paper') && ($paper_not_sell > 0) && ( $paper_sell > 0)) {
           $val +=(5*$paper_sell) + (3*$paper_not_sell);
         }
         elseif(($cat_res['category'] == 'paper') && ($paper_not_sell > 0) && ( $paper_sell < 0)){
           $val +=3*$paper_not_sell;
         }
         elseif(($cat_res['category'] == 'paper') && ($paper_not_sell < 0) && ( $paper_sell > 0)){
           $val +=5*$paper_sell;
         }



         if (($cat_res['category'] == 'coconut_shell') && ($coconut_shell_not_sell > 0) && ( $coconut_shell_sell > 0) ){
           $val +=(5*$coconut_shell_sell) + (3*$coconut_shell_not_sell);
         }
         elseif(($cat_res['category'] == 'coconut_shell') && ($coconut_shell_not_sell > 0) && ( $coconut_shell_sell < 0) ){
           $val +=3*$coconut_shell_not_sell;
         }
         elseif(($cat_res['category'] == 'coconut_shell') && ($coconut_shell_not_sell > 0) && ( $coconut_shell_sell < 0) ){
           $val +=5*$coconut_shell_sell;
         }


         if (($cat_res['category'] == 'glass') && ($glass_not_sell > 0) && ( $glass_sell > 0) ){
           $val +=(5*$glass_sell) + (3*$glass_not_sell);
         }
         elseif(($cat_res['category'] == 'glass') && ($glass_not_sell > 0) && ( $glass_sell < 0) ){
           $val +=3*$glass_not_sell;
         }
         elseif(($cat_res['category'] == 'glass') && ($glass_not_sell < 0) && ( $glass_sell > 0) ){
           $val +=5*$glass_sell;
         }



         if (($cat_res['category'] == 'fabric') && ($fabric_not_sell > 0) && ( $fabric_sell > 0)) {
           $val +=(5*$fabric_sell) + (3*$fabric_not_sell);
         }
         elseif(($cat_res['category'] == 'fabric') && ($fabric_sell > 0) && ( $fabric_sell < 0)){
            $val +=3*$fabric_not_sell;
         }
         elseif(($cat_res['category'] == 'fabric') && ($fabric_sell < 0) && ( $fabric_sell > 0)){
           $val +=5*$fabric_sell;
         }


         if (($cat_res['category'] == 'e_waste') && ($e_waste_not_sell > 0) && ( $e_waste_sell > 0)) {
           $val +=(5*$e_waste_sell) + (3*$e_waste_not_sell);
         }
         elseif(($cat_res['category'] == 'e_waste') && ($e_waste_not_sell > 0) && ( $e_waste_sell < 0)){
           $val +=3*$e_waste_not_sell;
         }
         elseif(($cat_res['category'] == 'e_waste') && ($e_waste_not_sell < 0) && ( $e_waste_sell > 0)){
          $val +=5*$e_waste_sell;
         }

        }
        //echo $val;
    }




                     /////////////////////////////////////////


          $que ="SELECT `points` FROM `rating` WHERE `u_nic_no`" ;
          $rew=mysqli_query($connection,$que);         

          $prearr = mysqli_fetch_assoc($rew);
        $pre = $prearr['points'];
        $rating = '';
          $realval = $pre + $val;
          if($realval >2200)
          {
              $rating = "PLATINUM NO1";
          }
          elseif($realval > 1750 && $realval < 2200)
          {
            $rating = "PLATINUM NO2";
          }
          elseif($realval > 1350 && $realval < 1750)
          {
            $rating = "PLATINUM NO3";
          }
          elseif($realval > 1000 && $realval < 1350)
          {
            $rating = "GOLD NO1";
          }
          elseif($realval > 700 && $realval < 1000)
          {
            $rating = "GOLD NO2";
          }
          elseif($realval > 450 && $realval < 700)
          {
            $rating = "GOLD NO3";
          }
          elseif($realval > 250 && $realval < 450)
          {
            $rating = "SILVER NO1";
          }
          elseif($realval > 100 && $realval < 250)
          {
            $rating = "SILVER NO2";
          }
          else
          {
            $rating = "SILVER NO3";
          }







          $query3 ="UPDATE `rating` SET  `points`='{$realval}',`rating`='{$rating}'  WHERE  `u_nic_no`='{$u_nic_no}'" ;
          $re=mysqli_query($connection,$query3);         

        }else{
          echo "Num row error!";
        }
      
      $result=mysqli_query($connection,$query);
      if(!$result)
        die ('data not inserted..!'.mysqli_error($connection));
      else
        //echo " Bin updated Successfully...!";


        

     echo '<script type="text/javascript">alert("Bin updated Successfully...!Congratulations.. You have earned ' . $val . ' \currently you have ' . $realval . ' points ");</script>';
    




    }


    ?>

        <div>
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                    <div class="container-fluid">
                      <a class="navbar-brand" href="#"> Welcome <?php echo $_SESSION['u_first_name']; ?>!</a>

                      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Home.php">Home</a>
                          </li>


                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="personalbin.php">Personal Bin</a>
                          </li>

                          <li class="nav-item">
                             <a class="nav-link" aria-current="page" href="chart.php">View Bin</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Complain</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="modify-user.php">Profile Details</a>
                          </li>

                        </ul>
                        
                      
                      <ul class="navbar-nav m-2">
                        
                        <li class="'nav-item">
                          <a class="nav-link bg-primary rounded text-light" aria-current="page" href="logout.php">Log Out</a>
                        </li>
                      </ul> 


              </div>
            </div>
          </nav>
        </div>

        <div  style="margin-top: 30px;" >
              <center><h1> The Personal Bin Entry </h1></center>
        </div>


<form action="garbage.php" method="post">

		<table id="employee_table" align="center">
            <tr>
              <td>
                <label class="form-control-lg">CATEGERY</label>
              </td>
              <td>
                <label class="form-control-lg">NOT SELL</label>
              </td>
              <td>
                <label class="form-control-lg">SELL</label>
              </td>

            </tr>

          <?php
            
			$query	= " SELECT * FROM `bin_categories`";

			$result_set = mysqli_query($connection, $query);
        
      if(!$result_set){
        die("Error in image".mysqli_error($conn));
      }
      echo "\n<br>";
       
       

      while($res = mysqli_fetch_assoc($result_set)){
        ?>
          
          
       

        
        
        

            <tr>
            	<td>
 					      <label  class="form-control bg-dark text-light border-primary"   aria-label="Default select example">
					         <option selected>  <?php   echo "". $res['category']; ?>  </option>					          
					     </label>
            	</td>
            	<td>
                	<!-- <input type="text" class="form-control" name='quantity[]' placeholder="Enter Quantity"> -->
                	<input type="text" class="form-control bg-dark text-light border-primary" name='<?php   echo "". $res['category']."_not_sell"; ?>' placeholder="Enter Quantity">

            	</td>

              <td>
                  <!-- <input type="text" class="form-control" name='quantity[]' placeholder="Enter Quantity"> -->
                  <input type="text" class="form-control bg-dark text-light border-primary" name='<?php   echo "". $res['category']."_sell"; ?>' placeholder="Enter Quantity">

              </td>


<!-- 
            	<td>
					
                 <select  name='<?php  // echo "". $res['category']."_sell"; ?>' class="form-select bg-dark text-light border-primary" aria-label="Default select example">
                   <option  disabled hidden >Set Sale State</option>
                   <option >Sell</option>
                   <option selected>Not Sell</option>
                  
               </select>
            	</td> -->
            	<!-- <td>
            		<button class="btn btn-sm btn-danger text-white" type="button" onclick="add_row();">+</button>
            	</td>                   -->
            </tr>
 
            <?php
        }
          ?>

                   
           <!--  <tr id="row1">

            </tr> -->
            
            <tr style="margin-top:40px;" > 
              <td></td>
              <td></td>
              <td><input type="submit" name="sasa" class="form-control bg-danger text-light mb-1 border-0 p-1" value="submit"/> </td>
            </tr>
            
        </table>
        
        </form>
            

     

            <script src="js/jquery.js"></script>

<!-- MDB -->
<script
  type="text/javascript"
  src="js/bootstrap.bundle.min.js"
></script>
</body>
</html>
<?php mysqli_close($connection); ?>