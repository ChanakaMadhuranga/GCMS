<?php //session_start(); 

if(session_status() === PHP_SESSION_NONE)
{
  session_start();
}

?>

<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<!DOCTYPE html>
<html>
<head>
     <!-- Required meta tags -->
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">

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

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


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

        .card{
        z-index: 1;
        background-color: rgba(0, 0, 0, 0.5);
      border: 2px solid brown;
      }
    </style>

	<!-- Font Awesome -->
	<!-- <link
	  href="css/bootstrap.min.css"
	  rel="stylesheet"
	/> -->
</head>



<body id="body">




<?php
    if(isset($_POST['sasa'])){
      
      // print_r($_POST);

    if($_POST['plastic_not_sell'] <= 0){
          $plastic_not_sell = 0;
      }else{
          $plastic_not_sell    = $_POST['plastic_not_sell'];
      }

      if($_POST['plastic_sell'] <= 0){
          $plastic_sell = 0;
      }else{
          $plastic_sell    = $_POST['plastic_sell'];
      }

      if($_POST['organic_not_sell'] <= 0){
          $organic_not_sell = 0;
      }else{
          $organic_not_sell    = $_POST['organic_not_sell'];
      }

      if($_POST['organic_sell'] <= 0){
          $organic_sell = 0;
      }else{
          $organic_sell    = $_POST['organic_sell'];
      }

      if($_POST['polythene_not_sell'] <= 0){
          $polythene_not_sell = 0;
      }else{
          $polythene_not_sell    = $_POST['polythene_not_sell'];
      }

      if($_POST['polythene_sell'] <= 0){
          $polythene_sell = 0;
      }else{
          $polythene_sell    = $_POST['polythene_sell'];
      }

      if($_POST['metal_not_sell'] <= 0){
          $metal_not_sell = 0;
      }else{
          $metal_not_sell    = $_POST['metal_not_sell'];
      }

      if($_POST['metal_sell'] <= 0){
          $metal_sell = 0;
      }else{
          $metal_sell    = $_POST['metal_sell'];
      }

      if($_POST['paper_not_sell'] <= 0){
          $paper_not_sell = 0;
      }else{
          $paper_not_sell    = $_POST['paper_not_sell'];
      }

      if($_POST['paper_sell'] <= 0){
          $paper_sell = 0;
      }else{
          $paper_sell    = $_POST['paper_sell'];
      }

      if($_POST['coconut_shell_not_sell'] <= 0){
          $coconut_shell_not_sell = 0;
      }else{
          $coconut_shell_not_sell    = $_POST['coconut_shell_not_sell'];
      }

      if($_POST['coconut_shell_sell'] <= 0){
          $coconut_shell_sell = 0;
      }else{
          $coconut_shell_sell    = $_POST['coconut_shell_sell'];
      }

      if($_POST['glass_not_sell'] <= 0){
          $glass_not_sell = 0;
      }else{
          $glass_not_sell   = $_POST['glass_not_sell'];
      }

       if($_POST['glass_sell'] <= 0){
          $glass_sell = 0;
      }else{
          $glass_sell   = $_POST['glass_sell'];
      }

       if($_POST['fabric_not_sell'] <= 0){
          $fabric_not_sell = 0;
      }else{
          $fabric_not_sell    = $_POST['fabric_not_sell'];
      }

       if($_POST['fabric_sell'] <= 0){
          $fabric_sell = 0;
      }else{
          $fabric_sell    = $_POST['fabric_sell'];
      }

      if($_POST['e_waste_not_sell'] <= 0){
          $e_waste_not_sell = 0;
      }else{
          $e_waste_not_sell   = $_POST['e_waste_not_sell'];
      }

      if($_POST['e_waste_sell'] <= 0){
          $e_waste_sell = 0;
      }else{
          $e_waste_sell    = $_POST['e_waste_sell'];
      }


    
    
       $my_date = date("Y-m-d H:i:s"); 
      //  echo "".$my_date ."   ";
       $u_nic_no= $_SESSION['u_nic_no'];
      //  echo "".$u_nic_no."   ";


      $query="INSERT INTO `personal_bin`( `u_nic_no`, `update_date`, `plastic_not_sell`, `plastic_sell`, `organic_not_sell`, `organic_sell`, `polythene_not_sell`, `polythene_sell`, `metal_not_sell`, `metal_sell`, `paper_not_sell`, `paper_sell`, `coconut_shell_not_sell`, `coconut_shell_sell`, `glass_not_sell`, `glass_sell`, `fabric_not_sell`, `fabric_sell`, `e_waste_not_sell`, `e_waste_sell`) VALUES 
      ('$u_nic_no', '$my_date' , '$plastic_not_sell','$plastic_sell','$organic_not_sell','$organic_sell' ,'$polythene_not_sell' ,'$polythene_sell','$metal_not_sell','$metal_sell','$paper_not_sell','$paper_sell' , '$coconut_shell_not_sell' , '$coconut_shell_sell'  ,'$glass_not_sell','$glass_sell' ,'$fabric_not_sell' ,'$fabric_sell' , '$e_waste_not_sell' ,'$e_waste_sell')";


       $query1="SELECT * FROM update_bin WHERE u_nic_no = '{$u_nic_no}'";

      $result = mysqli_query($connection, $query1);
      if(mysqli_num_rows($result) == 1){
          //valid user found
          $data = mysqli_fetch_assoc($result);
          //echo $data['id'];

          $newplastic_not_sell = doubleval($data['plastic_not_sell']) + doubleval($plastic_not_sell);
          $neworganic_not_sell = doubleval($data['organic_not_sell']) + doubleval($organic_not_sell);
          $newpolythene_not_sell = doubleval($data['polythene_not_sell']) + doubleval($polythene_not_sell);
          $newmetal_not_sell = doubleval($data['metal_not_sell']) + doubleval($metal_not_sell);
          $newpaper_not_sell = doubleval($data['paper_not_sell']) + doubleval($paper_not_sell);
          $newcoconut_shell_not_sell = doubleval($data['coconut_shell_not_sell']) + doubleval($coconut_shell_not_sell);
          $newglass_not_sell = doubleval($data['glass_not_sell']) + doubleval($glass_not_sell);
          $newfabric_not_sell = doubleval($data['fabric_not_sell']) + doubleval($fabric_not_sell);
          $newe_waste_not_sell = doubleval($data['e_waste_not_sell']) + doubleval($e_waste_not_sell);
          

          $newplastic_sell = doubleval($data['plastic_sell']) + doubleval($plastic_sell);
          $neworganic_sell = doubleval($data['organic_sell']) + doubleval($organic_sell);
          $newpolythene_sell = doubleval($data['polythene_sell']) + doubleval($polythene_sell);
          $newmetal_sell = doubleval($data['metal_sell']) + doubleval($metal_sell);
          $newpaper_sell = doubleval($data['paper_sell']) + doubleval($paper_sell);
          $newcoconut_shell_sell = doubleval($data['coconut_shell_sell']) + doubleval($coconut_shell_sell);
          $newglass_sell = doubleval($data['glass_sell']) + doubleval($glass_sell);
          $newfabric_sell = doubleval($data['fabric_sell']) + doubleval($fabric_sell);
          $newe_waste_sell = doubleval($data['e_waste_sell']) + doubleval($e_waste_sell);
          

        

           $query2="UPDATE update_bin
                   SET plastic_not_sell = '{$newplastic_not_sell}', plastic_sell= '{$newplastic_sell}', organic_not_sell = '{$neworganic_not_sell}', organic_sell = '{$neworganic_sell}',polythene_not_sell = '{$newpolythene_not_sell}',polythene_sell = '{$newpolythene_sell}',metal_not_sell = '{$newmetal_not_sell}',metal_sell = '{$newmetal_sell}',paper_not_sell = '{$newpaper_not_sell}',paper_sell = '{$newpaper_sell}',coconut_shell_not_sell = '{$newcoconut_shell_not_sell}',coconut_shell_sell = '{$newcoconut_shell_sell}',glass_not_sell = '{$newglass_not_sell}',glass_sell = '{$newglass_sell}',fabric_not_sell = '{$newfabric_not_sell}',fabric_sell = '{$newfabric_sell}',e_waste_not_sell = '{$newe_waste_not_sell}',e_waste_sell = '{$newe_waste_sell}'
                    WHERE u_nic_no = '{$u_nic_no}' ";

                     $result=mysqli_query($connection,$query2);
                      echo "<meta http-equiv='refresh' content='0'>";
                     

///////////////////////////////////////////////////////////////


 // $val = 0;



 //      $cat = "SELECT * FROM bin_categories";
 //      $cat_data = mysqli_query($connection,$cat);
 //       if(!$cat_data){
 //        die("Error ".mysqli_error($connection));
 //      }
 //      else
 //      {
 //      while( $cat_res = mysqli_fetch_assoc($cat_data)){
 //       //echo $cat_res['category'];

 //     //  echo "\n<br>";

 //        if(($cat_res['category'] == 'plastic') && ($plastic_sell == 'Sell') && ($plastic_q > 0) )
 //        {
 //          $val+=5*$plastic_q;
 //        }
 //        elseif(($cat_res['category'] == 'plastic') && ($plastic_sell == 'Not Sell') && ($plastic_q > 0) ){
 //            $val+=3*$plastic_q;
 //        }

 //        if (($cat_res['category'] == 'organic') && ($organic_sell == 'Sell') && ($organic_q > 0 )) {
 //          $val +=5*$organic_q;
 //        }elseif(($cat_res['category'] == 'organic') && ($organic_sell == 'Not Sell') && ($organic_q > 0 )){
 //          $val +=3*$organic_q;
 //        }

 //        if (($cat_res['category'] == 'polythene') && ($polythene_sell == 'Sell') && ( $polythene_q > 0)){
 //          $val +=5*$polythene_q;
 //        }elseif(($cat_res['category'] == 'polythene') && ($polythene_sell == 'Not Sell') && ( $polythene_q > 0)){
 //            $val +=3*$polythene_q;
 //        }

 //        if (($cat_res['category'] == 'metal') && ($metal_sell == 'Sell') && ( $metal_q > 0)) {
 //          $val +=5*$metal_q;
 //        }elseif(($cat_res['category'] == 'metal') && ($metal_sell == 'Not Sell') && ( $metal_q > 0)){
 //            $val +=3*$metal_q;
 //        }

 //        if (($cat_res['category'] == 'paper') && ($paper_sell == 'Sell') && ( $paper_q > 0)) {
 //          $val +=5*$paper_q ;
 //        }elseif(($cat_res['category'] == 'paper') && ($paper_sell == 'Not Sell') && ( $paper_q > 0)){
 //          $val +=3*$paper_q ;
 //        }

 //        if (($cat_res['category'] == 'coconut_shell') && ($coconut_shell_sell == 'Sell') && ( $coconut_shell_q > 0) ){
 //          $val +=5*$coconut_shell_q;
 //        }elseif(($cat_res['category'] == 'coconut_shell') && ($coconut_shell_sell == 'Not Sell') && ( $coconut_shell_q > 0) ){
 //          $val +=3*$coconut_shell_q;
 //        }

 //        if (($cat_res['category'] == 'glass') && ($glass_sell == 'Sell') && ( $glass_q > 0) ){
 //          $val +=5* $glass_q;
 //        }elseif(($cat_res['category'] == 'glass') && ($glass_sell == 'Not Sell') && ( $glass_q > 0) ){
 //          $val +=3*$glass_q;
 //        }

 //        if (($cat_res['category'] == 'fabric') && ($fabric_sell == 'Sell') && ( $fabric_q > 0)) {
 //          $val +=5*$fabric_q;
 //        }elseif(($cat_res['category'] == 'fabric') && ($fabric_sell == 'Not Sell') && ( $fabric_q > 0)){
 //           $val +=3*$fabric_q;
 //        }

 //        if (($cat_res['category'] == 'e_waste') && ($e_waste_sell == 'Sell') && ( $e_waste_q > 0)) {
 //          $val +=5*$e_waste_q;
 //        }elseif(($cat_res['category'] == 'e_waste') && ($e_waste_sell == 'Not Sell') && ( $e_waste_q > 0)){
 //          $val +=3*$e_waste_q;
 //        }

        //}
        //echo $val;
    //}




                     /////////////////////////////////////////


        //   $que ="SELECT `points` FROM `rating` WHERE `u_nic_no`" ;
        //   $rew=mysqli_query($connection,$que);         

        //   $prearr = mysqli_fetch_assoc($rew);
        // $pre = $prearr['points'];
        // $rating = '';
        //   $realval = $pre + $val;
        //   if($realval >2200)
        //   {
        //       $rating = "PLATINUM NO1";
        //   }
        //   elseif($realval > 1750 && $realval < 2200)
        //   {
        //     $rating = "PLATINUM NO2";
        //   }
        //   elseif($realval > 1350 && $realval < 1750)
        //   {
        //     $rating = "PLATINUM NO3";
        //   }
        //   elseif($realval > 1000 && $realval < 1350)
        //   {
        //     $rating = "GOLD NO1";
        //   }
        //   elseif($realval > 700 && $realval < 1000)
        //   {
        //     $rating = "GOLD NO2";
        //   }
        //   elseif($realval > 450 && $realval < 700)
        //   {
        //     $rating = "GOLD NO3";
        //   }
        //   elseif($realval > 250 && $realval < 450)
        //   {
        //     $rating = "SILVER NO1";
        //   }
        //   elseif($realval > 100 && $realval < 250)
        //   {
        //     $rating = "SILVER NO2";
        //   }
        //   else
        //   {
        //     $rating = "SILVER NO3";
        //   }







          // $query3 ="UPDATE `rating` SET  `points`='{$realval}',`rating`='{$rating}'  WHERE  `u_nic_no`='{$u_nic_no}'" ;
          // $re=mysqli_query($connection,$query3);         

        }else{
          echo "Num row error!";
        }
      
      $result=mysqli_query($connection,$query);
      if(!$result)
        die ('data not inserted..!'.mysqli_error($connection));
      else
        //echo " Bin updated Successfully...!";



        

     echo '<script type="text/javascript">alert("Bin updated Successfully...!");
   </script>';
    
    



    }


    ?>

       <!--  <div>
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

                    <div class="container-fluid">
                      <a class="navbar-brand" href="#"> Welcome <?php //echo $_SESSION['u_first_name']; ?>!</a>

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
                               <a class="nav-link" aria-current="page" href="notification.php">Notification</a>
                          </li>


                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="modify-user.php">Profile Details</a>
                          </li>

                          <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="change-password.php">Change Password</a>
                           </li>


                            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                              <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                  <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Profile</a>
                                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="modify-user.php">profile Details</a></li>
                                    <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                                  </ul>
                                </li>
                              </ul>
                            </div>

                            
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
 -->

<center>
 <div class="card col-lg-10 col-sm-12" style="">
        <div class="card border">
        <div class="card-body text-light">
          please enter your separated garbage as saleable and disposable
        </div>
        </div>
    </div>
</center>


        <div  style="margin-top: 30px;" >
              <div class="text-warning"><center><h1> The Personal Bin Entry </h1></center></div>
        </div>


<form action="chart.php" method="post">

		<table id="employee_table" align="center">
            <tr>
              <td>
                <label class="form-control-lg text-light">CATEGORY</label>
              </td>
              <td>
                <label class="form-control-lg text-light">DISPOSE</label>
              </td>
              <td>
                <label class="form-control-lg text-light">SELL</label>
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




 
</body>
</html>
<?php mysqli_close($connection); ?>