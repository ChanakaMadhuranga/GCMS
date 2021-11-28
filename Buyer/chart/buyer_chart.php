<?php
    session_start();

    include("connection.php");
    include("functions.php");

    $query_bin = "SELECT SUM(plastic_sell) AS 'Plastic', SUM(organic_sell) AS 'Organic', SUM(polythene_sell) AS 'Polythene', SUM(metal_sell) AS 'Metal', SUM(paper_sell) AS 'Paper', SUM(coconut_shell_sell) AS 'Coconut_shell', SUM(glass_sell) AS 'Glass', SUM(fabric_sell) AS 'Fabric', SUM(e_waste_sell) AS 'E-waste' FROM update_bin";
    
    $result_bin = mysqli_query($connection, $query_bin);
    $row_bin = mysqli_fetch_assoc($result_bin);

    $query_category = "SELECT b_garbage FROM buyers3 where id= 8";
    $result_category = mysqli_query($connection, $query_category);

    while($row_category = mysqli_fetch_assoc($result_category)) {
            $row1 = $row_category['b_garbage'];
            $row1 = trim($row1);

            $category= explode(',', $row1);

        }

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>
    <div class="row">
        <div class="col-lg-6 col-md-10">
            <canvas id="myChart"></canvas>
        </div>
    </div>

<script>
    var row_bin = <?php echo json_encode($row_bin); ?>;
    //console.log(row_bin);

    var category = <?php echo json_encode($category); ?>;
    //console.log(category);

    var chart_keys = [];
    var chart_values = [];
    //console.log(Object.keys(row_bin)[3]);
    //console.log(JSON.stringify(Object.keys(row_bin)[3]));

    //console.log(Object.values(row_bin)[3]);

    for (var i =  0; i <9; i++) {

        var key = Object.keys(row_bin)[i];
        var value = Object.values(row_bin)[i];
        
        if (category.includes(key)) {

            chart_keys.push(key);
            chart_values.push(parseFloat(value));
        }
    }
    //console.log(chart_keys);
    //console.log(chart_values);


var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: chart_keys,
        datasets: [{
            label: '# of Buckets',
            data: chart_values,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>