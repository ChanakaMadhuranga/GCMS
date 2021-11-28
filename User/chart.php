<?php session_start(); ?>
<?php include('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
    $u_nic_no = $_SESSION['u_nic_no'];
//$u_nic_no = '960331478v';
    $query = "SELECT * FROM update_bin WHERE u_nic_no = '{$u_nic_no}'";
    $result = mysqli_query($connection, $query);

    $chart_data ='';
    $quantites = array();
    $quantites1 = array();
    while($row = mysqli_fetch_array($result))
    {
      array_push($quantites, doubleval($row['plastic_not_sell']));
      array_push($quantites1, doubleval($row['plastic_sell']));

      array_push($quantites, doubleval($row['organic_not_sell']));
      array_push($quantites1, doubleval($row['organic_sell']));

      array_push($quantites, doubleval($row['polythene_not_sell']));
      array_push($quantites1, doubleval($row['polythene_sell']));

      array_push($quantites, doubleval($row['metal_not_sell']));
      array_push($quantites1, doubleval($row['metal_sell']));

      array_push($quantites, doubleval($row['paper_not_sell']));
      array_push($quantites1, doubleval($row['paper_sell']));

      array_push($quantites, doubleval($row['coconut_shell_not_sell']));
      array_push($quantites1, doubleval($row['coconut_shell_sell']));

      array_push($quantites, doubleval($row['glass_not_sell']));
      array_push($quantites1, doubleval($row['glass_sell']));

      array_push($quantites, doubleval($row['fabric_not_sell']));
      array_push($quantites1, doubleval($row['fabric_sell']));

      array_push($quantites, doubleval($row['e_waste_not_sell']));  
      array_push($quantites1, doubleval($row['e_waste_sell']));


    }

?>
<!DOCTYPE html>
<html>
<head>
     <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Chart</title>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style type="text/css">

         html {
  height: 100%;
  margin: 0;
            }

            #body {
              /* The image used */
               background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);

                height: 100%;
                margin: 0;
                background-repeat: no-repeat;
                background-attachment: fixed;


              /* Full height */


            }


        .card {
             z-index: 1;
            
              background-color: rgba(0, 0, 0, 0.5);
              border: 2px solid brown;
            }
        .highcharts-figure, .highcharts-data-table table {
            min-width: 310px; 
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }
        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }
        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }
        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }
        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }
        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
</head>
<body id="body">

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
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li>


        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="chart.php">Personal Bin</a>
        </li>

        <!-- <li class="nav-item">
          <a class="nav-link" aria-current="page" href="chart.php">View Bin</a>
        </li>
 -->

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="user_complain.php">Complain</a>
        </li>

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="allnotification.php">Notification</a>
          </li>


       <!--  <li class="nav-item">
          <a class="nav-link" aria-current="page" href="modify-user.php">Profile Details</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="change-password.php">Change Password</a>
        </li> -->




       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="modify-user.php">profile Details</a></li>
                  <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
            
          </ul>
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

<div class="">
<div class="row mt-3" align="center">
    <figure class="highcharts-figure">
    <div id="container"></div>

    <script type="text/javascript">
        var quantities = <?php echo json_encode($quantites); ?>;
        var quantities1 = <?php echo json_encode($quantites1); ?>;

        Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'My Bin'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Plastic',
                'Organic',
                'Ploythene',
                'Metal',
                'Paper',
                'Coconut shell',
                'Glass',
                'Fabric',
                'E-waste',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Quantites'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Buckets</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Not Sell',
            data: quantities

        }, {
            name: 'Sell',
            data: quantities1
        }, ]
    });
    </script>
</div>

    <?php
    $status ='';
    if(isset($_POST['disposed'])){
      

      //  print_r($_POST);


      if($_POST['plastic_not_sell'] <= 0){
          $plastic_not_sell = 0;
      }else{
          $plastic_not_sell    = $_POST['plastic_not_sell'];
      }

      
          $plastic_sell    = 0;
      

      if($_POST['organic_not_sell'] <= 0){
          $organic_not_sell = 0;
      }else{
          $organic_not_sell    = $_POST['organic_not_sell'];
      }

      
          $organic_sell    = 0;
      

      if($_POST['polythene_not_sell'] <= 0){
          $polythene_not_sell = 0;
      }else{
          $polythene_not_sell    = $_POST['polythene_not_sell'];
      }

      
          $polythene_sell    = 0;
      

      if($_POST['metal_not_sell'] <= 0){
          $metal_not_sell = 0;
      }else{
          $metal_not_sell    = $_POST['metal_not_sell'];
      }

      
          $metal_sell    = 0;
      

      if($_POST['paper_not_sell'] <= 0){
          $paper_not_sell = 0;
      }else{
          $paper_not_sell    = $_POST['paper_not_sell'];
      }

      
          $paper_sell    = 0;
      

      if($_POST['coconut_shell_not_sell'] <= 0){
          $coconut_shell_not_sell = 0;
      }else{
          $coconut_shell_not_sell    = $_POST['coconut_shell_not_sell'];
      }

      
          $coconut_shell_sell    = 0;
      

      if($_POST['glass_not_sell'] <= 0){
          $glass_not_sell = 0;
      }else{
          $glass_not_sell   = $_POST['glass_not_sell'];
      }

       
          $glass_sell   = 0;
      

       if($_POST['fabric_not_sell'] <= 0){
          $fabric_not_sell = 0;
      }else{
          $fabric_not_sell    = $_POST['fabric_not_sell'];
      }

       
          $fabric_sell    = 0;
      

      if($_POST['e_waste_not_sell'] <= 0){
          $e_waste_not_sell = 0;
      }else{
          $e_waste_not_sell   = $_POST['e_waste_not_sell'];
      }

      
          $e_waste_sell    = 0;
      
       $my_date = date("Y-m-d H:i:s"); 
      //  echo "".$my_date ."   ";
       $u_nic_no= $_SESSION['u_nic_no'];
      //  echo "".$u_nic_no."   ";


       $query="INSERT INTO `collected_bin`( `u_nic_no`, `update_date`, `plastic_not_sell`, `plastic_sell`, `organic_not_sell`, `organic_sell`, `polythene_not_sell`, `polythene_sell`, `metal_not_sell`, `metal_sell`, `paper_not_sell`, `paper_sell`, `coconut_shell_not_sell`, `coconut_shell_sell`, `glass_not_sell`, `glass_sell`, `fabric_not_sell`, `fabric_sell`, `e_waste_not_sell`, `e_waste_sell`) VALUES 
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
                   SET `dispose_status` = '0', plastic_not_sell = '{$newplastic_not_sell}', plastic_sell= '{$newplastic_sell}', organic_not_sell = '{$neworganic_not_sell}', organic_sell = '{$neworganic_sell}',polythene_not_sell = '{$newpolythene_not_sell}',polythene_sell = '{$newpolythene_sell}',metal_not_sell = '{$newmetal_not_sell}',metal_sell = '{$newmetal_sell}',paper_not_sell = '{$newpaper_not_sell}',paper_sell = '{$newpaper_sell}',coconut_shell_not_sell = '{$newcoconut_shell_not_sell}',coconut_shell_sell = '{$newcoconut_shell_sell}',glass_not_sell = '{$newglass_not_sell}',glass_sell = '{$newglass_sell}',fabric_not_sell = '{$newfabric_not_sell}',fabric_sell = '{$newfabric_sell}',e_waste_not_sell = '{$newe_waste_not_sell}',e_waste_sell = '{$newe_waste_sell}'
                    WHERE u_nic_no = '{$u_nic_no}' ";

                     $result=mysqli_query($connection,$query2);
                     echo "<meta http-equiv='refresh' content='0'>";

                      // if($result){
                      //   header('Location:chart.php');
                      // }

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

        if(($cat_res['category'] == 'plastic') && ($plastic_not_sell > 0) && ($plastic_sell >= 0) )
        {
          $val+=(5*$plastic_sell) + (3*$plastic_not_sell);
        }
        // elseif(($cat_res['category'] == 'plastic') && ($plastic_not_sell > 0) && ($plastic_sell < 0) ){
        //     $val+=3*$plastic_not_sell;
        // }
        // elseif(($cat_res['category'] == 'plastic') && ($plastic_not_sell < 0) && ($plastic_sell > 0) ){
        //     $val+=5*$plastic_sell;
        // }



         if (($cat_res['category'] == 'organic') && ($organic_not_sell > 0) && ($organic_sell >= 0 )) {
           $val +=(5*$organic_sell) + (3*$organic_not_sell);
         }
         // elseif(($cat_res['category'] == 'organic') && ($organic_not_sell > 0) && ($organic_sell < 0 )){
         //   $val +=3*$organic_not_sell;
         // }
         // elseif(($cat_res['category'] == 'organic') && ($organic_not_sell < 0) && ($organic_sell > 0 )){
         //   $val +=5*$organic_sell;
         // }


         if (($cat_res['category'] == 'polythene') && ($polythene_not_sell > 0) && ( $polythene_sell >= 0)){
           $val +=(5*$polythene_sell) + (3*$polythene_not_sell);
         }
         // elseif(($cat_res['category'] == 'polythene') && ($polythene_not_sell > 0) && ( $polythene_sell < 0)){
         //     $val +=3*$polythene_not_sell;
         // }
         // elseif(($cat_res['category'] == 'polythene') && ($polythene_not_sell < 0) && ( $polythene_sell > 0)){
         //     $val +=5*$polythene_sell;
         // }


         if (($cat_res['category'] == 'metal') && ($metal_not_sell > 0) && ( $metal_sell >= 0)) {
           $val +=(5*$metal_sell) + (3*$metal_not_sell);
         }
         // elseif(($cat_res['category'] == 'metal') && ($metal_not_sell > 0) && ( $metal_sell < 0)){
         //     $val +=3*$metal_not_sell;
         // }
         // elseif(($cat_res['category'] == 'metal') && ($metal_not_sell < 0) && ( $metal_sell > 0)){
         //     $val +=5*$metal_sell;
         // }


         if (($cat_res['category'] == 'paper') && ($paper_not_sell > 0) && ( $paper_sell >= 0)) {
           $val +=(5*$paper_sell) + (3*$paper_not_sell);
         }
         // elseif(($cat_res['category'] == 'paper') && ($paper_not_sell > 0) && ( $paper_sell < 0)){
         //   $val +=3*$paper_not_sell;
         // }
         // elseif(($cat_res['category'] == 'paper') && ($paper_not_sell < 0) && ( $paper_sell > 0)){
         //   $val +=5*$paper_sell;
         // }



         if (($cat_res['category'] == 'coconut_shell') && ($coconut_shell_not_sell > 0) && ( $coconut_shell_sell >= 0) ){
           $val +=(5*$coconut_shell_sell) + (3*$coconut_shell_not_sell);
         }
         // elseif(($cat_res['category'] == 'coconut_shell') && ($coconut_shell_not_sell > 0) && ( $coconut_shell_sell < 0) ){
         //   $val +=3*$coconut_shell_not_sell;
         // }
         // elseif(($cat_res['category'] == 'coconut_shell') && ($coconut_shell_not_sell > 0) && ( $coconut_shell_sell < 0) ){
         //   $val +=5*$coconut_shell_sell;
         // }


         if (($cat_res['category'] == 'glass') && ($glass_not_sell > 0) && ( $glass_sell >= 0) ){
           $val +=(5*$glass_sell) + (3*$glass_not_sell);
         }
         // elseif(($cat_res['category'] == 'glass') && ($glass_not_sell > 0) && ( $glass_sell <0) ){
         //   $val +=3*$glass_not_sell;
         // }
         // elseif(($cat_res['category'] == 'glass') && ($glass_not_sell < 0) && ( $glass_sell > 0) ){
         //   $val +=5*$glass_sell;
         // }



         if (($cat_res['category'] == 'fabric') && ($fabric_not_sell > 0) && ( $fabric_sell >= 0)) {
           $val +=(5*$fabric_sell) + (3*$fabric_not_sell);
         }
         // elseif(($cat_res['category'] == 'fabric') && ($fabric_sell > 0) && ( $fabric_sell < 0)){
         //    $val +=3*$fabric_not_sell;
         // }
         // elseif(($cat_res['category'] == 'fabric') && ($fabric_sell < 0) && ( $fabric_sell > 0)){
         //   $val +=5*$fabric_sell;
         // }


         if (($cat_res['category'] == 'e_waste') && ($e_waste_not_sell > 0) && ( $e_waste_sell >= 0)) {
           $val +=(5*$e_waste_sell) + (3*$e_waste_not_sell);
         }
         // elseif(($cat_res['category'] == 'e_waste') && ($e_waste_not_sell > 0) && ( $e_waste_sell < 0)){
         //   $val +=3*$e_waste_not_sell;
         // }
         // elseif(($cat_res['category'] == 'e_waste') && ($e_waste_not_sell < 0) && ( $e_waste_sell > 0)){
         //  $val +=5*$e_waste_sell;
         // }

        }
        //echo $val;
    }




                     /////////////////////////////////////////


          $que ="SELECT `points` FROM `points` WHERE `u_nic_no`" ;
          $rew=mysqli_query($connection,$que);         

          $prearr = mysqli_fetch_assoc($rew);
        $pre = $prearr['points'];
        $rating = '';
          $realval = $pre + $val;
          if($realval >2200)
          {
              $rating = "GOLD I";
          }
          elseif($realval > 1750 && $realval < 2200)
          {
            $rating = "GOLD II";
          }
          elseif($realval > 1350 && $realval < 1750)
          {
            $rating = "GOLD III";
          }
          elseif($realval > 1000 && $realval < 1350)
          {
            $rating = "SILVER I";
          }
          elseif($realval > 700 && $realval < 1000)
          {
            $rating = "SILVER II";
          }
          elseif($realval > 450 && $realval < 700)
          {
            $rating = "SILVER III";
          }
          elseif($realval > 250 && $realval < 450)
          {
            $rating = "BRONZ I";
          }
          elseif($realval > 100 && $realval < 250)
          {
            $rating = "BRONZ II";
          }
          else
          {
            $rating = "BRONZ III";
          }







          $query3 ="UPDATE `points` SET  `points`='{$realval}',`rating`='{$rating}'  WHERE  `u_nic_no`='{$u_nic_no}'" ;
          $re=mysqli_query($connection,$query3);         

        }else{
          echo "Num row error!";
        }
      
      $result=mysqli_query($connection,$query);
      if(!$result)
        die ('data not inserted..!'.mysqli_error($connection));
      else
        //echo " Bin updated Successfully...!";


        

      echo '<script type="text/javascript">alert("Bin updated Successfully...!Congratulations.. You have earned ' . $val . ' \currently you have ' . $realval . ' points ");
    </script>';
    
   //  echo 'Bin updated Successfully...!Congratulations.. You have earned ' . $val . ' \currently you have ' . $realval . ' points
   // ';



//header('Location: chart.php');
    }


    ?>
<!-- <div class="col-lg-6 col-md-6 col-sm-12"> -->


<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12" >
    
   <div class="card col-lg-12 col-sm-12 m-1" style="">
      
        <div class="card-body text-light">
           Please enter the amounts you disposed to the garbage truck.
        </div>
      
    </div>

 <div>
<div  style="margin-top: 30px;" >
              <div class="text-warning text-center"><h1>Disposed</h1></div>
        </div>

<?php
  // echo $u_nic_no;
  // $sql = "SELECT * FROM update_bin WHERE u_nic_no = '{u_nic_no}'";

  // $result = mysqli_query($connection,$sql);
  // $row = mysqli_fetch_assoc($result);
  // //print_r($result);
  // $count = mysqli_num_rows($result);
  // echo $count;
  // $status = $row['dispose_status'];
  // echo $status;
  // //$status = $row['plastic_sell'];
  //  //echo $status;
  //   if ($status == false) {
  //       $status = 'disabled';
  //   }
  //   elseif ($status == true) {
  //       $status = 'enabled';
  //   }
?>
 <?php
   //  $sql = "SELECT * FROM update_bin WHERE u_nic_no = '{$u_nic_no}'";
   //  $result = mysqli_query($connection,$sql);
   //  $row = mysqli_fetch_assoc($result);
   // $status =$row['dispose_status'];
    
    $sql="SELECT * FROM update_bin WHERE u_nic_no = '$u_nic_no'";

    $result = mysqli_query($connection,$sql);
    $data = mysqli_fetch_assoc($result);
   //print_r($result); 
    $status = $data['dispose_status'];

     if ($status == false) {
         $status = 'disabled';
     }
     elseif ($status == true) {
         $status = 'enabled';
     }

   ?>
<form action="chart.php" method="post">
 
<fieldset <?php echo $status; ?>>
    <table id="employee_table" align="center">

            <tr>
              <td>
                <label class="form-control-lg text-light">CATEGERY</label>
              </td>
              <td>
                <label class="form-control-lg text-light">UNITS</label>
              </td>
             <!--  <td>
                <label class="form-control-lg text-light">SELL</label>
              </td> -->

            </tr>

          <?php
            
      $query  = " SELECT * FROM `bin_categories`";

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
                 <!--  <input type="text" class="form-control bg-dark text-light border-primary" name='<?php   //echo "". $res['category']."_not_sell"; ?>' placeholder="Enter Quantity"> -->
                  
                  <select name='<?php echo "". $res['category']."_not_sell"; ?>' class="form-control bg-dark text-light border-primary" >
                    <?php

                    $queryN = "SELECT " . $res['category']."_not_sell"." FROM `update_bin` WHERE `u_nic_no` = '$u_nic_no'";
                      $resultN = mysqli_query($connection, $queryN);
                      $resN = mysqli_fetch_assoc($resultN);

                    ?>
                    <option value="" selected>Select Quantity</option>
                    <!-- <?php echo $resN[$res['category']."_not_sell"]; ?> -->
                  

                    <?php

                    $count_ns = intval($resN[$res['category']."_not_sell"]);
                            for ( $x =$count_ns; $x >0 ; $x--) {
                             ?>
                              <option value="<?php echo "".$x ?>"><?php echo "".$x ; ?></option>
                             <?php
                            }
                    ?>
                     
                    
                  </select> 

              </td>

             <!--  <td>
                  
                  <input type="text" class="form-control bg-dark text-light border-primary" name='<?php   //echo "". $res['category']."_sell"; ?>' placeholder="Enter Quantity">

              </td>
 -->

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
             <!--  <td></td> -->
              <td></td>
              <td><input type="submit" name="disposed" class="form-control bg-danger text-light mb-1 border-0 p-1" value="submit"/> </td>
            </tr>
            
        </table>
        </fieldset>
        </form>
      </div>
        <!--  </div>  -->
         
      </div>

     <div class="col-lg-3 col-md-3 col-sm-12">
        <table style="height: 100%;"  class="col-12 mt-4 mb-5">
         <td class="align-middle"  >
            <center><?php echo '<img src="images/20.png"/>';  ?></center>
            <center class="fs-5 fw-bold text-warning">1 Unit = Full of 10 Liter Bucket</center> 
         </td>
        </table>
     </div>

        <div class="col-lg-5 col-md-5 col-sm-12 mb-5"> 
      


        
                <?php 
                    include('personalbin.php');
                  ?>
          
     

        </div>

</div>
</div>
         
</body>
</html>