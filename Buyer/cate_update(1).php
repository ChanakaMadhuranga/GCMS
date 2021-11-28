 
  <?php
   session_start();
include("connection.php");
include("functions.php");

$user_data=check_login($con);

$user_id=$user_data['user_id'];



	if(isset($_POST['Submit']))
	{    
	
	   $garbage=$_POST['b_garbage'];
	
	if(!empty($_POST['b_garbage']))
        {
            $garbage1=" ";
            foreach($_POST['b_garbage']as $gar)
            {
                    $garbage1 .=$gar.",";
            }
        }
	
	
	
	
	
	
	
	
	
	
	$query="update buyers3 set b_garbage='$garbage1' where user_id='$user_id'";
	
	
	mysqli_query($con,$query);

    echo "Successfully Updated!";
}
 
 ?>
 <html>
 
 <body id="body">
 	<div class="container-fluid col-lg-4 col-md-8 col-sm-12 align-content-center shadow p-3 mb-5 bg-dark rounded" style="opacity: 0.8" >

 		<form class="form-conatiner text-light" method="post" >
 			<div class="fs-2 fw-bold text-center m-3">Buyer Category Update</div>


              <p>Now you are registered in:-<?php   $user_data['b_garbage'];  ?> categories.</p>
 
                <fieldset class="form-group">
                   
                        <legend class="col-form-label col-sm-5 pt-0"><b>Type of Garbage</b></legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Organic">
                                <label class="form-check-label">Organic</label>
                           
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Polythene">
                                <label class="form-check-label">Polythene</label><br>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Plastic">
                                <label class="form-check-label">Plastic</label>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Metal">
                                <label class="form-check-label">Metals</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Glass">
                                <label class="form-check-label">Glass</label>
                            </div>
                           
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Coconut_shell">
                                <label class="form-check-label">Coconut Shells</label><br>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Fabric">
                                <label class="form-check-label">Fabric</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Paper">
                                <label class="form-check-label">Paper</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="b_garbage[]" value="Ewaste">
                                <label class="form-check-label">E-waste</label>
                            </div>
                        
                        </div>
                    </fieldset>

                    <input type="submit" name="Submit" value="Submit">
 </form>
 </body>
 </html>
