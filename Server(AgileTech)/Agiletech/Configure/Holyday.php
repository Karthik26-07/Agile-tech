<?php include('../Admin/Admin_Homepage.php'); ?>

<?php
$dateErr = $nameErr = $desErr = $Date = $Name = $Description = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["date"])) {
        $dateErr = "Date is required";
    } else if (empty($_POST["name"])) {
        $nameErr = "Holyday name is required";
    } else if (empty($_POST["description"])) {
        $desErr = "Description name is required";
    } else {
        $Date = $_POST["date"];
        $Name = $_POST["name"];
        $Description = $_POST["description"];
    }
}
?>
<?php
$m_timeErr = $e_timeErr = $morning_time = $evening_time = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST['m_time'])) {
    $m_timeErr = "Morning time is required";
} elseif (empty($_POST['E_time'])) {
    $e_timeErr = "Evening timeis required";
} else {
    $morning_time = $_POST['m_time'];
    $evening_time = $_POST['E_time'];
}
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <!--<script src= "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->  
        <script type="text/javascript" src= "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!--<link href= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">-->
        <script src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

        <style>
            .stud{
                width: 70%;
                left: 20%;
            }
            .stud1{
                width: 70%;
                left: 20%;
            }
            body {
                background-image: url("Home.webp");
                background-size: cover;
                background-repeat: no-repeat;
                /*background-position: center;*/
                position: relative;
                /*z-index: 2;*/
                /*overflow: hidden;*/


            }
            .error {color: #FF0001;}
        </style>
        <title></title>
    </head>
    <body>
         <div class="col text-right">
        <a class="btn  my-2 btn-1g text-white" style="background-color: #8f02fa" style="float: left;" href="../Configure/InsertRow.php">Monthly Attendance</a>
         </div>
        <div class="form-row">
            <div class="form-group  col-md-6 ">

                <form class=" card  my-5  stud1 shadow-lg p-3 mb-5 bg-white rounded body" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <div class="row justify-content-center align-items-center my-2">
                        <h1>Time</h1>
                    </div><br><br>

                    <div class="form-group">
                        <label for="name"><b>Morning Time</b></label>
                        <input type="text" class="form-control" id="time" name="m_time">
                        <span class="error"><?php echo $m_timeErr; ?> </span>

                    </div>
                    <div class="form-group">
                        <label for="time"><b>Evening Time</b></label>
                        <input type="subcode" class="form-control" id="etime" name="E_time">
                        <span class="error"><?php echo $e_timeErr; ?> </span>

                    </div>            
                    <button class="btn  my-2 btn-1g text-white" style="background-color: #8f02fa" name="update" type="submit">Update</button>
                </form>
            </div>





            <div class="form-group  col-md-6 ">
                <form class=" card  my-5 stud  shadow-lg p-3 mb-5 bg-white rounded body" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <div class="row justify-content-center align-items-center my-2">
                        <h1>Holy Days</h1>
                    </div><br><br>

                    <div class="form-group">
                        <label for="name"><b>Date</b></label>
                        <input type="date" class="form-control" id="date" name="date">
                        <span class="error"><?php echo $dateErr; ?> </span>

                    </div>
                    <div class="form-group">
                        <label for="subcode"><b>Holyday Name</b></label>
                        <input type="subcode" class="form-control" id="name" name="name">
                        <span class="error"><?php echo $nameErr; ?> </span>

                    </div>            <div class="col-14">
                        <div class="form-group">
                            <label   for="name"><b>Description</b></label>
                            <textarea class="form-control " id="description" name="description"rows="3"></textarea>
                            <span class="error"><?php echo $desErr; ?> </span>
                        </div>
                    </div>
                    <button class="btn  my-2 btn-1g text-white" style="background-color: #8f02fa" name="submit" type="submit">Add</button>        </form>
                </form>
            </div>
        </div>

        <script>
            $('#time').datetimepicker({
                format: 'HH:mm:ss'
            });
        </script>
        <script>
            $('#etime').datetimepicker({
                format: 'HH:mm:ss'
            });
        </script> 

    </body>


</html>
<?php
include('../Database_Connection/Dbconnect.php');
if (isset($_POST['submit'])) {
    if ($nameErr == "" && $dateErr == "" && $desErr == "") {
        echo "<h2>Your Password:</h2>";
        echo "Name: " . $subname;
        $sql = "insert into holyday(Date,Name,Description)"
                . "values ('$Date','$Name','$Description')";

        if ($con->query($sql) === TRUE) {

            echo "<script>alert('Succesfullly Added');</script>";
            echo "<script>window.location.href='../Configure/Holyday.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    } else {
        
    }
}
?>
<?php
include('../Database_Connection/Dbconnect.php');
error_reporting(0);
$morning_time = $_POST['m_time'];
$evening_time = $_POST['E_time'];
if (isset($_POST['update'])) {
    if ($m_timeErr == "" && $e_timeErr == "" ) {
        echo "<h2>Your Password:</h2>";

        $update = "update time_management set morning_time='$morning_time',evening_time='$evening_time' where ID=1";
        if ($con->query($update) === TRUE) {
            echo "<script>alert('Succesfully Updated');</script>";
            echo "<script>window.location.href='../Configure/Holyday.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}
?>