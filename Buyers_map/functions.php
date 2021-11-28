<?php

function check_login($connection)
{
	if(isset($_SESSION['a_id']))
	{
		$id = $_SESSION['a_id'];
		$query = "select * from admin where a_id = '$id' limit 1";

		$result = mysqli_query($connection,$query);
		if ($result && mysqli_num_rows($result) > 0) 
		{
			$admin_data = mysqli_fetch_assoc($result);
			return $admin_data;
		}
	}


	header("Location: login.php");
	die;

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