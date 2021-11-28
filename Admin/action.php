<?php  
//action.php
    include("connection.php");

    $input = filter_input_array(INPUT_POST);

    $date = mysqli_real_escape_string($connection, $input["date"]);
    $v_no = mysqli_real_escape_string($connection, $input["v_no"]);
    $driver = mysqli_real_escape_string($connection, $input["driver"]);
    $helper1 = mysqli_real_escape_string($connection, $input["helper1"]);
    $helper2 = mysqli_real_escape_string($connection, $input["helper2"]);
    $helper3 = mysqli_real_escape_string($connection, $input["helper3"]);
    $helper4 = mysqli_real_escape_string($connection, $input["helper4"]);
    $route_name = mysqli_real_escape_string($connection, $input["route_name"]);
    $garbage = mysqli_real_escape_string($connection, $input["garbage"]);

    if($input["action"] === 'edit')
    {
     $query = "
     UPDATE schedule 
     SET date = '".$date."', 
     v_no = '".$v_no."',
     driver = '".$driver."',
     worker1 = '".$helper1."',
     worker2 = '".$helper2."',
     worker3 = '".$helper3."',
     worker4 = '".$helper4."',
     route_name = '".$route_name."',
     garbage = '".$garbage."'
     WHERE s_id = '".$input["s_id"]."'
     ";

     mysqli_query($connection, $query);

    }
    if($input["action"] === 'delete')
    {
     $query = "
     DELETE FROM schedule 
     WHERE s_id = '".$input["s_id"]."'
     ";
     mysqli_query($connection, $query);
    }

    echo json_encode($input);

?>
