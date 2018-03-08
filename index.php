<?php
/**
 * Created by PhpStorm.
 * User: Hitesh
 * Date: 24-Feb-18
 * Time: 6:19 AM
 */
include 'db.php';
$sql="SELECT * FROM appointments";
if ($result=mysqli_query($connection,$sql))
    $rowcount=mysqli_num_rows($result);
$sql="SELECT * FROM users";
if ($result=mysqli_query($connection,$sql))
    $rowcount1=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE doctor_id='1'";
if ($result=mysqli_query($connection,$sql))
    $one=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE doctor_id='2'";
if ($result=mysqli_query($connection,$sql))
    $two=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE doctor_id='3'";
if ($result=mysqli_query($connection,$sql))
    $three=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE doctor_id='4'";
if ($result=mysqli_query($connection,$sql))
    $four=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE appointment_time='10AM-12PM'";
if ($result=mysqli_query($connection,$sql))
    $time1=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE appointment_time='12PM-02PM'";
if ($result=mysqli_query($connection,$sql))
    $time2=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE appointment_time='04PM-06PM'";
if ($result=mysqli_query($connection,$sql))
    $time3=mysqli_num_rows($result);
$sql="SELECT * FROM appointments WHERE appointment_time='06PM-08PM'";
if ($result=mysqli_query($connection,$sql))
    $time4=mysqli_num_rows($result);
$date=date("Y-m-d");
?>

<html>
<head>
    <title>MyDoctor Administrator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body style="background-color: beige">
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">MyDoctor Administrator</a>
        </div>
    </div>
</nav>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3 style="text-align: center;">Appointments : </h3>
            <?php
            $query=mysqli_query($connection,"SELECT * FROM appointments ORDER BY appointment_id DESC");
            while($row = mysqli_fetch_array($query)) {
                $name = $row['patient_name'];
                $number = $row['patient_number'];
                $time = $row['appointment_time'];
                echo " <div class=\"alert alert-info\">
                <strong>$name</strong> : $number<br>$time
            </div>";
            }
            ?>

        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-8">
            <br>
            <div class="alert alert-success">
                <strong><?php echo $rowcount; ?></strong> :Total number of appointments
            </div>
            <div class="alert alert-success">
                <strong><?php echo $rowcount1; ?></strong> :Total number of Users
            </div>
            <div id="chartContainer1" style="width: 80%; margin-left: 10%; height: 400px;display: inline-block;"></div>
            <br/>
            <div id="chartContainer2" style="width: 80%;margin-left: 10%; height: 400px;display: inline-block;"></div>
        </div>
    </div>
</div>
<script>
    var chart = new CanvasJS.Chart("chartContainer2",
        {
            animationEnabled: true,
            title: {
                text: "Time Slots Preferences",
            },
            data: [
                {
                    type: "pie",
                    dataPoints: [
                        { y: <?php echo $time1;?>, indexLabel: "10AM-12PM" },
                        { y: <?php echo $time2;?>, indexLabel: "12PM-2PM" },
                        { y: <?php echo $time3;?>, indexLabel: "4PM-6PM" },
                        { y: <?php echo $time4;?>, indexLabel: "6PM-8PM" }
                    ]
                },
            ]
        });
    chart.render();

    var chart = new CanvasJS.Chart("chartContainer1",
        {
            animationEnabled: true,
            title: {
                text: "Number of Appointments"
            },
            axisX: {
                interval: 10,
            },
            data: [
                {
                    type: "column",
                    legendMarkerType: "triangle",
                    legendMarkerColor: "green",
                    showInLegend: true,
                    legendText: "Doctor wise appoinments",
                    dataPoints: [
                        { x: 10, y: <?php echo $one;?>, label: "Vijay Ahuja" },
                        { x: 20, y: <?php echo $two;?>, label: "Rajeev Agarwal" },
                        { x: 30, y: <?php echo $three;?>, label: "Ashok Masand" },
                        { x: 40, y: <?php echo $four;?>, label: "B.K.Bansal" }
                    ]
                },
            ]
        });
    chart.render();
</script>
</body>
</html>
