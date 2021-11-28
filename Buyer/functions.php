<?php

include("connection.php");

function check_login($con)
{
	if(isset($_SESSION['user_id']))
	{
		$b_id = $_SESSION['user_id'];
		$query = "select * from buyers3 where user_id = '$b_id' limit 1";

		$result = mysqli_query($con,$query);
		if ($result && mysqli_num_rows($result) > 0) 
		{
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//header("Location: login.php");
	//die;

}

function random_num($length)
{
	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		
		$text .= rand(0,9);
	}

	return $text;
}
?>
