<?php 
    include("nav.html");
?>

<?php
include("connection.php");
$query = "SELECT * FROM schedule ORDER BY s_id DESC";
$result = mysqli_query($connection, $query);
?>

<?php
$array_v_no = array();
$query1 = "SELECT v_no FROM vehicle";
$result1 = mysqli_query($connection, $query1);
while ($row1=mysqli_fetch_assoc($result1)) {
    $array_v_no[$row1["v_no"]] = $row1["v_no"];
}
?>

<?php
$array_driver = array();
$query2 = "SELECT * FROM worker WHERE w_post='Driver'";
$result2 = mysqli_query($connection, $query2);
while ($row2=mysqli_fetch_assoc($result2)) {
    $array_driver[$row2["w_fname"]." ".$row2["w_lname"]] = $row2["w_fname"]." ".$row2["w_lname"];
}
?>

<?php
$array_helper = array();
$query3 = "SELECT * FROM worker WHERE w_post='Helper'";
$result3 = mysqli_query($connection, $query3);
while ($row3=mysqli_fetch_assoc($result3)) {
    $array_helper[$row3["w_fname"]." ".$row3["w_lname"]] = $row3["w_fname"]." ".$row3["w_lname"];
}
?>

<?php
$array_route = array();
$query4 = "SELECT * FROM routes";
$result4 = mysqli_query($connection, $query4);
while ($row4=mysqli_fetch_assoc($result4)) {
    $array_route[$row4["route_name"]] = $row4["route_name"];
}
?>

<html>  
 <head>  
    <title>GCMS Job Schedule</title>  

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>

 <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->

   <style type="text/css">
   
  </style>
    </head> 

    <body id="">  
  <div class="container-fluid">    
   <div class="table-responsive">  
    <h2 class="shadow p-2 mb-3 card alert-primary" align="center"><b>GCMS Job Schedule</b></h2><br />  
    <table id="editable_table" class="table table-striped alert-danger table-bordered">
     <thead>
      <tr>
       <th>s_id</th>
       <th>Date</th>
       <th>Vehicle Number</th>
       <th>Driver</th>
       <th>Worker1</th>
       <th>Worker2</th>
       <th>Worker3</th>
       <th>Worker4</th>
       <th>Route</th>
       <th>Garbage</th>
      </tr>
     </thead>
     <tbody>
     <?php
     while($row = mysqli_fetch_array($result))
     {
      echo '
      <tr>
       <td>'.$row["s_id"].'</td>
       <td>'.$row["date"].'</td>
       <td>'.$row["v_no"].'</td>
       <td>'.$row["driver"].'</td>
       <td>'.$row["worker1"].'</td>
       <td>'.$row["worker2"].'</td>
       <td>'.$row["worker3"].'</td>
       <td>'.$row["worker4"].'</td>
       <td>'.$row["route_name"].'</td>
       <td>'.$row["garbage"].'</td>
      </tr>
      ';
     }
     ?>
     </tbody>
    </table>
   </div>  
  </div>  
 </body>  
</html>  
<script> 
var arrayVNo = <?php echo json_encode($array_v_no); ?>;
 var objectVNo = Object.assign({}, arrayVNo);
 objectVNo = JSON.stringify(objectVNo);

 var arrayDriver = <?php echo json_encode($array_driver); ?>;
 var objectDriver = Object.assign({}, arrayDriver);
 objectDriver = JSON.stringify(objectDriver);

 var arrayHelper = <?php echo json_encode($array_helper); ?>;
 var objectHelper = Object.assign({}, arrayHelper);
 objectHelper = JSON.stringify(objectHelper);

 var arrayRoute = <?php echo json_encode($array_route); ?>;
 var objectRoute = Object.assign({}, arrayRoute);
 objectRoute = JSON.stringify(objectRoute);

$(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'action.php',
      columns:{
       identifier:[0, "s_id"],
       editable:[[1, 'date'], [2, 'v_no',objectVNo], [3, 'driver',objectDriver], [4, 'helper1',objectHelper], [5, 'helper2',objectHelper], [6, 'helper3',objectHelper], [7, 'helper4',objectHelper], [8, 'route_name',objectRoute], [9, 'garbage']]
      },
      restoreButton:false,
      onSuccess:function(data, textStatus, jqXHR)
      {
       if(data.action == 'delete')
       {
        $('#'+data.s_id).remove();
       }
      }
     });
 
});  
//,'{"1":"Male","2":"Female"}'
 </script>

