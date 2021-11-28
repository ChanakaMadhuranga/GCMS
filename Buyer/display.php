<?php 

session_start();

include("connection.php");
include("functions.php");


$query = "SELECT paper_sell AS 'Paper',metal_sell AS 'Metal',polythene_sell AS 'Polythene',organic_sell AS 'Organic',plastic_sell AS 'Plastic',e_waste_sell AS  'E-waste',fabric_sell AS 'Fabric',glass_sell AS 'Glass',coconut_shell_sell AS 'Coconut_shell',u_nic_no FROM update_bin";




$result = mysqli_query($con, $query);
$queryb = mysqli_query($con,"SELECT b_garbage FROM buyers3 WHERE id =8");

$b=array();
 		

          		while($row_b = mysqli_fetch_assoc($queryb))
			{
				 $row1 = $row_b['b_garbage'];
				$row1 = trim($row1);
			    $b= explode(',', $row1);
			}
                echo "<form>";
                echo "<table>";
                echo "<tr>";
                echo "<th>";
                echo "NIC NUM.";
                echo "</th><th>";
                echo "Category";
                echo "</th><th>";
                echo "Quantity";
                echo "</th></tr>";

                   while($u_garbage=mysqli_fetch_assoc($result))
                 {
        
               
            if(isset($u_garbage['Plastic']) && isset($b['Plastic']))
            {

                echo "<tr>";
                echo "<td>";
                echo $u_garbage['u_nic_no'];
                echo "</td><td>";
                echo "Plastic";
                echo "</td><td>";
                echo $u_garbage['Plastic'];
                echo "</td>";
                echo "</tr>";
               
            }
        }

                echo "</table>";
                echo "</form>";
        
?>

